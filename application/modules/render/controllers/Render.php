<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Render extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}	

	public function index()
	{
		$data = [
			'title' => 'Render',
			'js' => 'render'
		];
		$this->template->load('templates','view_index',$data);
	}

	public function getRender()
	{
		$list = $this->M_render->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->name;
			$row[] = $field->template;
			$row[] = $field->nama_video;
			$row[] = $field->tgl_rendering;
			if ($field->status_video == 1) {
				$status = '<span class="badge badge-success badge-pill">Terkirim</span>';
			}else{
				$status = '<span class="badge badge-danger badge-pill">Belum dikirim</span>';
			}
			$row[] = $status;
			$data[] = $row;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal"		=> $this->M_render->count_all(),
			"recordsFiltered" 	=> $this->M_render->count_filtered(),
			"data" 				=> $data
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function send()
	{
		$id = $this->input->post('id');

		$data = ['status_video' => 1];
		$success = $this->M_global->update('t_render', $data, array('id_render' => $id));
        if ($success) {
        	echo $this->session->set_flashdata('msg','send');
			redirect('render');
        }else{
			echo $this->session->set_flashdata('msg','gagal');
			redirect('render');
        }
	}


}

/* End of file Audio.php */
/* Location: ./application/controllers/Audio.php */