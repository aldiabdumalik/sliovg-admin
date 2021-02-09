<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Audio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'title' => 'Audio',
			'js' => 'audio',
			'all' => $this->M_audio->countAllKategori(),
			'total' => $this->M_audio->countPerKategori(),
			'kategori' => $this->M_audio->getKategoriAudio()
		];

		$this->template->load('templates','view_index',$data);
	}

	public function getAudio()
	{
		$list = $this->M_audio->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama_musik;
			$row[] = $field->kategori_musik;
			$row[] = '<a href="javascript:;" class="mr-1 text-danger btn-hapus" data-id="'.$field->id_musik.'"">
  			          	<i class="fa fa-trash" style="font-size: 18px;"></i>
  				        <label for="trash" class="text-danger" style="cursor: pointer;">Trash</label>
  			          </a>
  			          <a href="'.base_url("audio/view_edit/".$field->id_musik).'" class="text-success">
  			            <i class="fa fa-edit" style="font-size: 18px;"></i>
  				        <label for="trash" class="text-success" style="cursor: pointer;">Edit</label>
  			          </a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_audio->count_all(),
			"recordsFiltered" => $this->M_audio->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function view_edit($id)
	{
		$data = [
			'title' => 'Update Audio',
			'js' => 'audio',
			'kategori' => $this->M_audio->getKategoriAudio(),
			'audio' => $this->M_audio->getAudioWhere($id)
		];
		$this->template->load('templates','view_edit',$data);
	}


	public function simpan()
	{
		$folder = $this->input->post('kategori');
		$config['upload_path'] = './file/musik/'.$folder;
	    $config['allowed_types'] = 'mp3';
	    $this->upload->initialize($config);
	    if(!empty($_FILES['musik']['name'])){
	        if ($this->upload->do_upload('musik')){

	    		$img = $this->upload->data();

	            $musik = $img['file_name'];

	            $data = [
	            	"nama_musik" => $musik,
	            	"kategori_musik" => $this->input->post('kategori')
	            ];
	            
	            $success = $this->M_global->insert('tbl_musik',$data);
	            if ($success) {
	            	echo $this->session->set_flashdata('msg','simpan');
					redirect('audio');
	            }else{
					echo $this->session->set_flashdata('msg','gagal');
					redirect('audio');
	            }
	        }
	    }else{
	    	echo $this->session->set_flashdata('msg','musikNull');
			redirect('audio');
	    }

	}

	public function update()
	{
		$folder = $this->input->post('kategori');
		$config['upload_path'] = './file/musik/'.$folder;
	    $config['allowed_types'] = 'mp3';
	    $this->upload->initialize($config);
	    if(!empty($_FILES['musik']['name'])){
	        if ($this->upload->do_upload('musik')){

	            $id = $this->input->post('id');

				$file = $this->M_global->getOneSpesificWhere('nama_musik,kategori_musik', array('id_musik' => $id), 'tbl_musik');
					if (file_exists('file/musik/'.$file->kategori_musik.'/' . $file->nama_musik))
					unlink('file/musik/'.$file->kategori_musik.'/' . $file->nama_musik);

	    		$img = $this->upload->data();
	            $musik = $img['file_name'];


	            $data = [
	            	"nama_musik" => $musik,
	            	"kategori_musik" => $this->input->post('kategori')
	            ];
	            
	            $success = $this->M_global->update('tbl_musik', $data, array('id_musik' => $id));
	            if ($success) {
	            	echo $this->session->set_flashdata('msg','update');
					redirect('audio');
	            }else{
					echo $this->session->set_flashdata('msg','gagal');
					redirect('audio');
	            }
	        }
	    }else{
	    	$id = $this->input->post('id');
	    	$data = [
            	"kategori_musik" => $this->input->post('kategori')
            ];
            
            $success = $this->M_global->update('tbl_musik', $data, array('id_musik' => $id));
            if ($success) {
            	echo $this->session->set_flashdata('msg','update');
				redirect('audio');
            }else{
				echo $this->session->set_flashdata('msg','gagal');
				redirect('audio');
            }
	    }
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$file = $this->M_global->getOneSpesificWhere('nama_musik,kategori_musik', array('id_musik' => $id), 'tbl_musik');
		if (file_exists('file/musik/'.$file->kategori_musik.'/' . $file->nama_musik))
		unlink('file/musik/'.$file->kategori_musik.'/' . $file->nama_musik);

		$success = $this->M_global->delete('tbl_musik','id_musik',$id);
		if ($success) {
			echo $this->session->set_flashdata('msg','delete');
			redirect('audio');
		}else{
			echo $this->session->set_flashdata('msg','gagal');
			redirect('audio');
		
		}
	}

}

/* End of file Audio.php */
/* Location: ./application/controllers/Audio.php */