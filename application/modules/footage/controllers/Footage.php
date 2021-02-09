<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'title' => 'Footage',
			'js' => 'footage',
			'all' => $this->M_footage->countAllKategori(),
			'total' => $this->M_footage->countPerKategori(),
			'kategori' => $this->db->get_where('t_kategori', ['template' => 'footage'])->result_array()
		];
		$this->template->load('templates','view_index',$data);
	}

	public function getFootage()
	{
		$list = $this->M_footage->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = '<img src="'.base_url('assets/images/footage/thumb/'.$field->thumb).'" alt="contact-img" width="200" class="thumb-sm"/>';
			$row[] = $field->nama_footage;
			$row[] = $field->deskripsi_footage;
			$row[] = '<a href="javascript:;" class="mr-1 text-danger btn-hapus" data-id="'.$field->id_footage.'"">
  			          	<i class="fa fa-trash" style="font-size: 18px;"></i>
  				        <label for="trash" class="text-danger" style="cursor: pointer;">Trash</label>
  			          </a>
  			          <a href="'.base_url("footage/view_edit/".$field->id_footage).'" class="text-success">
  			            <i class="fa fa-edit" style="font-size: 18px;"></i>
  				        <label for="trash" class="text-success" style="cursor: pointer;">Edit</label>
  			          </a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_footage->count_all(),
			"recordsFiltered" => $this->M_footage->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function view_edit($id)
	{
		$data = [
			'title' => 'Update Footage',
			'js' => 'footage',
			'kategori' => $this->db->get_where('t_kategori', ['template' => 'footage'])->result_array(),
			'footage' => $this->M_footage->getFootageWhere($id)
		];
		$this->template->load('templates','view_edit',$data);
	}

	public function simpan()
	{
		$config['upload_path'] = './assets/images/footage';
	    $config['allowed_types'] = 'mp4';
	    $this->upload->initialize($config);
	    if(!empty($_FILES['video']['name'])){
	        if ($this->upload->do_upload('video')){

	        	// ambil data file
				$thumb = $_FILES['thumb']['name'];
				$namaSementara = $_FILES['thumb']['tmp_name'];


				// tentukan lokasi file akan dipindahkan
				$dirUpload = "assets/images/footage/thumb/";

				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $dirUpload.$thumb);

	    		$img = $this->upload->data();

	            $footage = $img['file_name'];

	            $data = [
	            	"id_kategori" => $this->input->post('kategori'),
	            	"footage" => $footage,
	            	"thumb" => $thumb,
	            	"nama_footage" => $footage,
	            	"deskripsi_footage" => $this->input->post('deskripsi')
	            ];
	            
	            $success = $this->M_global->insert('t_footage',$data);
	            if ($success) {
	            	echo $this->session->set_flashdata('msg','simpan');
					redirect('footage');
	            }else{
					echo $this->session->set_flashdata('msg','gagal');
					redirect('footage');
	            }
	        }
	    }else{
	    	echo $this->session->set_flashdata('msg','gambarNull');
			redirect('footage');
	    }

	}

	public function update()
	{
		$config['upload_path'] = './assets/images/footage';
	    $config['allowed_types'] = 'mp4';
	    $this->upload->initialize($config);
	    if(!empty($_FILES['video']['name'])){
	        if ($this->upload->do_upload('video')){

	        	// ambil data file
				$thumb = $_FILES['thumb']['name'];
				$namaSementara = $_FILES['thumb']['tmp_name'];
				// tentukan lokasi file akan dipindahkan
				$dirUpload = "assets/images/footage/thumb/";
				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $dirUpload.$thumb);
	            $id = $this->input->post('id');

				if ($thumb) {
					$file = $this->M_global->getOneSpesificWhere('thumb', array('id_footage' => $id), 't_footage');
						if (file_exists('assets/images/footage/thumb/' . $file->thumb))
						unlink('assets/images/footage/thumb/' . $file->thumb);
				}
				$file2 = $this->M_global->getOneSpesificWhere('footage', array('id_footage' => $id), 't_footage');
					if (file_exists('assets/images/footage/' . $file2->footage))
					unlink('assets/images/footage/' . $file2->footage);

	    		$img = $this->upload->data();
	            $footage = $img['file_name'];


	            $data = [
	            	"id_kategori" => $this->input->post('kategori'),
	            	"footage" => $footage,
	            	"thumb" => $thumb,
	            	"nama_footage" => $footage,
	            	"deskripsi_footage" => $this->input->post('deskripsi')
	            ];
	            
	            $success = $this->M_global->update('t_footage', $data, array('id_footage' => $id));
	            if ($success) {
	            	echo $this->session->set_flashdata('msg','update');
					redirect('footage');
	            }else{
					echo $this->session->set_flashdata('msg','gagal');
					redirect('footage');
	            }
	        }
	    }else{
	    	$id = $this->input->post('id');
	    	$data = [
	            	"id_kategori" => $this->input->post('kategori'),
	            	"deskripsi_footage" => $this->input->post('deskripsi')
	            ];
	            
	            $success = $this->M_global->update('t_footage', $data, array('id_footage' => $id));
	            if ($success) {
	            	echo $this->session->set_flashdata('msg','update');
					redirect('footage');
	            }else{
					echo $this->session->set_flashdata('msg','gagal');
					redirect('footage');
	            }
	    }
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$file = $this->M_global->getOneSpesificWhere('thumb', array('id_footage' => $id), 't_footage');
		if (file_exists('assets/images/footage/thumb/' . $file->thumb))
				unlink('assets/images/footage/thumb/' . $file->thumb);

		$file2 = $this->M_global->getOneSpesificWhere('footage', array('id_footage' => $id), 't_footage');
		if (file_exists('assets/images/footage/' . $file2->footage))
				unlink('assets/images/footage/' . $file2->footage);

		$success = $this->M_global->delete('t_footage','id_footage',$id);
		if ($success) {
			echo $this->session->set_flashdata('msg','delete');
			redirect('footage');
		}else{
			echo $this->session->set_flashdata('msg','gagal');
			redirect('footage');
		
		}
	}

}

/* End of file Footage.php */
/* Location: ./application/controllers/Footage.php */