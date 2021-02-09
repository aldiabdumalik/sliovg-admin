<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 public function index()
    {
        // if ($this->session->userdata('username')) {
        //     redirect('dashboard','refresh');
        // }
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false ) {
            $data['title'] = "Login Page";
            $this->load->view('view_index', $data);
        }else{
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('t_admin', ['username'=> $username])->row_array();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id_admin'  => $user['id_admin'],
                    'username'  => $user['username'],
                    'foto'      => $user['foto'],
                    'level'     => $user['level'],
                    'facebook'  => $user['facebook'],
                    'twitter'   => $user['twitter'],
                    'linkedin'  => $user['linkendin']
                ];
                $this->session->set_userdata($data);
                redirect('dashboard');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang anda masukkan salah!!</div>');
                redirect('login');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username yang anda masukkan salah!!!</div>');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_admin');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('level');;

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Terimakasih. anda berhasil logout.</div>');
        redirect('login');
    }

}
