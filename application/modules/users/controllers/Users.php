<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('excel');
	}

	public function index()
	{
		$data = [
			'title' => 'User',
			'js' => 'user'
		];
		$this->template->load('templates','view_index',$data);
	}
	
	public function getUser()
	{
		$list = $this->M_user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->name;
			$row[] = $field->username;
			$row[] = $field->serial_number;
			if ($field->status == 1) {
				$status = '<span class="badge badge-success badge-pill">Active</span>';
			}else{
				$status = '<span class="badge badge-danger badge-pill">Inactive</span>';
			}
			$row[] = $status;
			$row[] = '<a href="'.base_url('users/view_edit/'.$field->id_user).'" class="text-success"><i class="fa fa-edit" style="font-size: 18px;"></i><label for="trash" class="text-success" style="cursor: pointer;">Edit</label></a>';
			

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_user->count_all(),
			"recordsFiltered" => $this->M_user->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function view_edit($id)
	{
		$data = [
			'title' => 'Update User',
			'user' => $this->M_user->getUserById($id),
			'js' => 'user'
		];

		$this->template->load('templates','view_edit',$data);
	}

	public function add()
	{
		$post = $this->input->post();
		$data = [
			'username' => $post['username'],
			'password' => $post['kode'],
			'name' => $post['name'],
			'serial_number' => $post['kode'],
			'status' => $post['status']
		];

		$success = $this->M_global->insert('t_user',$data);
		if ($success) {
			echo $this->session->set_flashdata('msg','simpan');
			redirect('users');
		}else{
			echo $this->session->set_flashdata('msg','gagal');
			redirect('users');
		}
	}

	public function edit()
	{
		$post = $this->input->post();

		$data = [
			'username' => $post['username'],
			'password' => $post['kode'],
			'name' => $post['name'],
			'serial_number' => $post['kode'],
			'status' => $post['status']
		];

		$id = $post['id'];
		$success = $this->M_global->update('t_user',$data, ['id_user' => $id]);
		if ($success) {
			echo $this->session->set_flashdata('msg','update');
			redirect('users');
		}else{
			echo $this->session->set_flashdata('msg','gagal');
			redirect('users');
		}
	}

	public function import()
	{
		if(isset($_FILES["excel"]["name"]))
		  {
		   $path = $_FILES["excel"]["tmp_name"];
		   $object = PHPExcel_IOFactory::load($path);
		   foreach($object->getWorksheetIterator() as $worksheet)
		   {
		    $highestRow = $worksheet->getHighestRow();
		    $highestColumn = $worksheet->getHighestColumn();
		    for($row=2; $row<=$highestRow; $row++)
		    	{
			    $username = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
			    $password = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
			    $name = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			    $serial_number = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			    $distribution = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
			    $status = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
		     	$data[] = array(
				    	'username'  => $username,
				      	'password'   => $password,
				      	'name'    => $name,
				      	'serial_number'  => $serial_number,
				      	'distribution'  => $distribution,
				      	'status'   => $status
		     		);	     	
		    	}
		   	}
		   	$cari = $this->db->get_where('t_user', ['serial_number' => $serial_number])->num_rows();
	     	if (empty($serial_number)){
	     		echo $this->session->set_flashdata('msg','serial_number_null');
	     		redirect('users');
	     	}else{
	     		// $this->db->truncate('t_user');
	     		$this->db->delete('t_user', ['serial_number !=' => 'bynd123']);
	     		$success = $this->M_user->insert_excel($data);
			   	if ($success) {
					echo $this->session->set_flashdata('msg','import_excel');
					redirect('users');
				}else{
					echo $this->session->set_flashdata('msg','gagal');
					redirect('users');
				}
		    }
		 }
	}
	
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */