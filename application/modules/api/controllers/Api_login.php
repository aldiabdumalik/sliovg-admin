<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
class Api_login extends RestController {

	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		$this->load->model('M_api', 'api');
		$this->load->library('tools');
	}

	public function index_get()
	{
		$this->response([
            'status' => false,
            'message' => 'Maaf halaman ini tidak dapat diakses'
        ], 404 );
	}

	public function login_post()
	{
		$data = array(
			'serial_number' => $this->post('email'),
			'password' => $this->post('password')
		);
		$query = $this->api->login($data);
		$notif = $this->api->get_notif();
		if (empty($query)) {
			$this->response([
	            'status' => false,
	            'message' => 'Maaf username atau password salah, silahkan masukan data dengan benar'
	        ], 200 );
		}else{
			if ($query->status == 1) {
				$this->response([
		            'status' => true,
		            'data' => $query,
		            'notif' => $notif
		        ], 200 );
			}else{
				$this->response([
		            'status' => false,
		            'message' => 'Maaf status Anda inactive, silahkan minta Admin untuk men-activekan status Anda'
		        ], 200 );
			}
		}
	}

	public function register_post()
	{
		$data = array(
			'username' => $this->post('name'),
			'password' => $this->post('password'),
			'name' => $this->post('name'),
			'serial_number' => $this->post('serial_number'),
			'email' => $this->post('email'),
			'wa_number' => $this->post('whatsapp'),
			'status' => 1,
			'foto_profil' => $this->post('photo')
		);
		$cek = $this->api->get_email($data['email']);
		if (empty($cek)) {
			$query = $this->api->insert('t_user', $data);
			if (isset($query)) {
				$this->response([
		            'status' => true,
		            'message' => 'Pendaftaran berhasil, silahkan hubungi Admin untuk mengaktifkan akun Anda'
		        ], 201 );
			}else{
				$this->response([
		            'status' => false,
		            'message' => 'Pendaftaran gagal, silahkan ulangi beberapa saat lagi'
		        ], 200 );
			}
		}else{
			$this->response([
	            'status' => false,
	            'message' => 'Pendaftaran gagal, email sudah digunakan'
	        ], 200 );
		}
	}

	public function uploadphoto_post()
	{
		$config['upload_path'] = './assets/images/users/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('photo')){
			$error = array('error' => $this->upload->display_errors());
			$this->response( [
	            'status' => false,
	            'data' => $error
	        ], 200 );
		}else{
			$data = array('upload_data' => $this->upload->data());
			$this->response( [
	            'status' => true,
	            'data' => $data
	        ], 201 );
		}
	}

}

/* End of file Api_login.php */
/* Location: ./application/modules/api/controllers/Api_login.php */