<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
class Api_video extends RestController {

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

	public function myvideo_get()
	{
		$page = $this->get('page');
		$where = array(
			'id_user' => $this->get('myid'),
		);
		$where2 = array(
			'id_user' => $this->get('myid'),
			'status_video' => 0
		);
		$query = $this->api->get_myvideo($where, $page);
		$query2 = $this->api->count_video($where);
		$query3 = $this->api->get_myvideo($where2, $page);
		$this->__myvideoconfirm($query3);
		if (!empty($query)) {
			$this->response([
	            'status' => true,
	            'data' => $query,
	            'jml_data' => count($query2)
	        ], 200 );
		}else{
		    $this->response([
	            'status' => false,
	            'message' => 'null'
	        ], 200 );
		}
	}

	public function myvideo_post()
	{
		$input = file_get_contents("php://input");
		$input = json_decode($input);
		$data = [
			'nama_sementara' => $input->nama
		];
		$this->db->update('t_render', $data, ['nama_video' => $input->id]);
		$this->response([
            'status' => true,
            'message' => 'Berhasil merubah nama video'
        ], 200 );
	}

	function __myvideoconfirm($data)
	{
		$headers = array(
			'Authorization: Bearer rmp1LdZRb_EAAAAAAAAgRXRiuVZOsdCQb8u8t_LxKdrOXr6m5f-0Wiehmc9aCzL2',
			'Content-Type: application/json'
		);
		foreach ($data as $key => $vid) {
			$file = $vid->nama_video;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/files/search_v2');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"query\": \"$file\",\"include_highlights\": false}");
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			curl_close($ch);
			$myresult = json_decode($result);
			if (!empty($myresult->matches)) {
				$this->db->update('t_render', 
					array('status_video' => 1), 
					array('nama_video' => $myresult->matches[0]->metadata->metadata->name)
				);
			}
		}
		return true;
	}

	public function myvideolink_get()
	{
		$file = '/SUNLIFE/'.$this->get('file');
		$headers = array(
			'Authorization: Bearer rmp1LdZRb_EAAAAAAAAgRXRiuVZOsdCQb8u8t_LxKdrOXr6m5f-0Wiehmc9aCzL2',
			'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/files/get_temporary_link');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"path\": \"$file\"}");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		curl_close($ch);
		$myresult = json_decode($result);
		if (!empty($myresult->link)) {
			$this->response([
	            'status' => true,
	            'data' =>  $this->api->share_myvideobyid($this->get('file')),
	            'url' => urldecode($myresult->link)
	        ], 200 );
		}else{
			$this->response([
	            'status' => false,
	            'message' => 'Maaf video ini belum dirender atau sudah di hapus'
	        ], 200 );
		}

	}

	public function myvideobyid_get()
	{
		$data = array(
			'id_user' => $this->get('myid'),
			'id_render' => $this->get('videoid')
		);
		$query = $this->api->get_myvideobyid($data);
		if (!empty($query)) {
			$this->response([
	            'status' => true,
	            'data' => $query,
	        ], 200 );
		}
	}

	public function reportingbyid_get()
	{
		$data = array(
			't_render.id_user' => $this->get('myid'),
			't_render.id_render' => $this->get('videoid')
		);
		$query = $this->api->get_reportingbyid($data);
		if (!empty($query)) {
			$this->response([
	            'status' => true,
	            'data' => $query,
	        ], 200 );
		}
	}

	public function inputreport_post()
	{
		$data = array(
			'id_render' => $this->post('videoid'),
			'fb_share' => $this->post('fb'),
			'ig_share' => $this->post('ig'),
			'yt_share' => $this->post('yt'),
			'twitter_share' => $this->post('twitter'),
			'wa_share' => $this->post('wa'),
			'linkedin_share' => $this->post('linkedin')
		);
		$cek = $this->api->cek_report(array('id_render' => $this->post('videoid')));
		if (empty($cek)) {
			$this->api->insert('t_share', $data);
		}else{
			$this->api->update('t_share', $data, array('id_render' => $this->post('videoid')));
		}
		$this->response([
            'status' => true,
            'message' => 'Report berhasil diperbaharui',
        ], 201 );
	}
	
	function template_get()
	{
		$page = $this->get('page');
		$where = array(
			'id_kategori' => $this->get('kategori'),
		);
		if ($this->get('kategori') != 4) {
			$query = $this->api->template($where, $page);
			$query2 = $this->api->count_template($where);
		}else{
			$query = $this->api->template($where, $page, $this->get('distribution'));
			$query2 = $this->api->count_template($where, $this->get('distribution'));
		}
		if (!empty($query)) {
			$this->response([
	            'status' => true,
	            'data' => $query,
	            'jml_data' => count($query2)
	        ], 200 );
		}
	}
	
	public function deletevideo_get()
	{
		if (!empty($this->get('myid'))) {
			$this->db->delete('t_render', array('nama_video' => $this->get('videoid')));
			$this->response([
	            'status' => true,
	            'message' => 'Video berhasil dihapus...'
	        ], 200 );
		}else{
			$this->response([
	            'status' => false,
	            'message' => 'Maaf video gagal dihapus. Silahkan coba beberapa saat lagi...'
	        ], 200 );
		}
	}

	public function download_get()
	{
		require_once(APPPATH.'libraries/Requests/library/Requests.php');
		$this->load->helper('download');
		$file = $this->get('file');
		Requests::register_autoloader();
        $token="rmp1LdZRb_EAAAAAAAAgRXRiuVZOsdCQb8u8t_LxKdrOXr6m5f-0Wiehmc9aCzL2";
        $response = Requests::post("https://content.dropboxapi.com/2/files/download", array(
        	'Authorization' => "Bearer ".$token,
        	'Dropbox-Api-Arg' => json_encode(array('path' => '/SUNLIFE/'.$file)),
        ));
        $fileContent = $response->body;
        force_download($file, $fileContent);
        $metadata = json_decode($response->headers['Dropbox-Api-Result'], true);
	}

}

/* End of file Api_login.php */
/* Location: ./application/modules/api/controllers/Api_login.php */