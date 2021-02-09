<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'title' => 'Template Video',
			'js' => 'video',
			'all' => $this->M_video->countAllKategori(),
			'total' => $this->M_video->countPerKategori(),
			'kategori' => $this->db->get_where('t_kategori', ['template' => 'video'])->result_array()
		];
		$this->template->load('templates','view_index',$data);
	}

	public function getVideo()
	{
		$list = $this->M_video->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			if ($field->id_kategori == 4) {
				$folder = "Product Template";
			}elseif($field->id_kategori == 5){
				$folder = "Video Greeting Template";
			}elseif($field->id_kategori == 6) {
				$folder = "Video Quotes Template";
			}elseif($field->id_kategori == 7){
				$folder = "Special Event Template";
			}elseif($field->id_kategori == 11) {
    			$folder = "Promosi Terbatas Template";
    		}
			$row[] = '<img src="'.base_url('file/video/'.$folder.'/Thumb/'.$field->thumb).'" alt="contact-img" width="200" class="thumb-sm"/>';
			$row[] = $field->nama_video;
			$row[] = $field->nama_kategori;
			$row[] = '<a href="javascript:;" class="mr-1 text-danger btn-hapus" data-id="'.$field->id_video.'" data-idkategori="'.$field->id_kategori.'"">
  			          	<i class="fa fa-trash" style="font-size: 18px;"></i>
  				        <label for="trash" class="text-danger" style="cursor: pointer;">Trash</label>
  			          </a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_video->count_all(),
			"recordsFiltered" => $this->M_video->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function view_edit($id)
	{
		$data = [
			'title' => 'Update Template Video',
			'js' => 'video',
			'kategori' => $this->db->get_where('t_kategori', ['template' => 'video'])->result_array(),
			'video' => $this->M_video->getVideoWhere($id)
		];
		$this->template->load('templates','view_edit',$data);
	}

	public function simpan()
	{
		$post = $this->input->post();
		if ($post['kategori'] == 4) {
			$folder = "Product Template";
		}elseif ($post['kategori'] == 5) {
			$folder = "Video Greeting Template";
		}elseif($post['kategori'] == 6){
			$folder = "Video Quotes Template";
		}elseif($post['kategori'] == 7) {
			$folder = "Special Event Template";
		}elseif($post['kategori'] == 11) {
			$folder = "Promosi Terbatas Template";
		}
		$config['upload_path'] = './file/video/'.$folder;
	    $config['allowed_types'] = 'mp4';
	    $this->upload->initialize($config);
	    if(!empty($_FILES['video']['name'])){
	        if ($this->upload->do_upload('video')){

	        	// ambil data file
				$thumb = $_FILES['thumb']['name'];
				$namaSementara = $_FILES['thumb']['tmp_name'];
				
				$thumb2 = $_FILES['closing']['name'];
				$namaSementara2 = $_FILES['closing']['tmp_name'];


				// tentukan lokasi file akan dipindahkan
				$dirUpload = "file/video/".$folder."/Thumb/";

				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $dirUpload.$thumb);
				
				$dirUpload2 = "file/video/".$folder."/Closing/";
				$terupload2 = move_uploaded_file($namaSementara2, $dirUpload2.$thumb2);

	    		$img = $this->upload->data();

	            $video = $img['file_name'];

	            $data = [
	            	"id_kategori" => $this->input->post('kategori'),
	            	"video" => $video,
	            	"thumb" => $thumb,
	            	"nama_video" => $video,
	            	"deskripsi_video" => $this->input->post('deskripsi')
	            ];
	            
	            $success = $this->M_global->insert('t_video',$data);
	            if ($success) {
	            	echo $this->session->set_flashdata('msg','simpan');
					redirect('video');
	            }else{
					echo $this->session->set_flashdata('msg','gagal');
					redirect('video');
	            }
	        }
	    }else{
	    	echo $this->session->set_flashdata('msg','gambarNull');
			redirect('video');
	    }

	}

	public function update()
	{
		$post = $this->input->post();
		if ($post['kategori'] == 4) {
			$folder = "Product Template";
		}elseif ($post['kategori'] == 5) {
			$folder = "Video Greeting Template";
		}elseif($post['kategori'] == 6){
			$folder = "Video Quotes Template";
		}elseif($post['kategori'] == 7) {
			$folder = "Special Event Template";
		}
		$config['upload_path'] = './file/video/'.$folder;
	    $config['allowed_types'] = 'mp4';
	    $this->upload->initialize($config);
	    if(!empty($_FILES['video']['name'])){
	        if ($this->upload->do_upload('video')){

	        	// ambil data file
				$thumb = $_FILES['thumb']['name'];
				$namaSementara = $_FILES['thumb']['tmp_name'];
				// tentukan lokasi file akan dipindahkan
				$dirUpload = "file/video/".$folder."/Thumb/";
				// pindahkan file
				$terupload = move_uploaded_file($namaSementara, $dirUpload.$thumb);
	            $id = $this->input->post('id');

				if ($thumb) {
					$file = $this->M_global->getOneSpesificWhere('thumb', array('id_video' => $id), 't_video');
						if (file_exists('file/video/'.$folder.'/Thumb/'.$file->thumb))
						unlink('file/video/'.$folder.'/Thumb/'.$file->thumb);
				}
				$file2 = $this->M_global->getOneSpesificWhere('video', array('id_video' => $id), 't_video');
					if (file_exists('file/video/'.$folder.'/'.$file->thumb))
					unlink('file/video/'.$folder.'/'.$file2->video);

	    		$img = $this->upload->data();
	            $video = $img['file_name'];


	            $data = [
	            	"id_kategori" => $this->input->post('kategori'),
	            	"video" => $video,
	            	"thumb" => $thumb,
	            	"nama_video" => $video,
	            	"deskripsi_video" => $this->input->post('deskripsi')
	            ];
	            
	            $success = $this->M_global->update('t_video', $data, array('id_video' => $id));
	            if ($success) {
	            	echo $this->session->set_flashdata('msg','update');
					redirect('video');
	            }else{
					echo $this->session->set_flashdata('msg','gagal');
					redirect('video');
	            }
	        }
	    }else{
	    	$id = $this->input->post('id');
	    	$data = [
	            	"id_kategori" => $this->input->post('kategori'),
	            	"deskripsi_video" => $this->input->post('deskripsi')
	            ];
	            
	            $success = $this->M_global->update('t_video', $data, array('id_video' => $id));
	            if ($success) {
	            	echo $this->session->set_flashdata('msg','update');
					redirect('video');
	            }else{
					echo $this->session->set_flashdata('msg','gagal');
					redirect('video');
	            }
	    }
	}

	public function delete()
	{
		$post = $this->input->post();
		if ($post['kategori'] == 4) {
			$folder = "Product Template";
		}elseif ($post['kategori'] == 5) {
			$folder = "Video Greeting Template";
		}elseif($post['kategori'] == 6){
			$folder = "Video Quotes Template";
		}elseif($post['kategori'] == 7) {
			$folder = "Special Event Template";
		}
		$id = $this->input->post('id');
		$file = $this->M_global->getOneSpesificWhere('thumb', array('id_video' => $id), 't_video');
		if (file_exists('file/video/'.$folder.'/Thumb'. $file->thumb))
				unlink('file/video/'.$folder.'/Thumb'. $file->thumb);

		$file2 = $this->M_global->getOneSpesificWhere('video', array('id_video' => $id), 't_video');
		if (file_exists('file/video/'.$folder.'/'. $file2->video))
				unlink('file/video/'.$folder.'/'. $file2->video);

		$success = $this->M_global->delete('t_video','id_video',$id);
		if ($success) {
			echo $this->session->set_flashdata('msg','delete');
			redirect('video');
		}else{
			echo $this->session->set_flashdata('msg','gagal');
			redirect('video');
		
		}
	}
}

/* End of file Video.php */
/* Location: ./application/controllers/Video.php */