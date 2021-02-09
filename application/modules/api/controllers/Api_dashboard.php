<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

class Api_dashboard extends RestController {

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

	public function notif_get()
	{
		$notif = $this->api->get_notif();
		$this->response([
            'status' => true,
            'notif' => $notif
        ], 200 );
	}

	public function sound_get()
	{
		$data = array(
			'kategori' => $this->get('kategori'),
			'page' => $this->get('page')
		);
		$query = $this->api->music($data);
		$this->response( [
            'status' => true,
            'data' => $query
        ], 200 );
	}

	public function uploadphoto_post()
	{
		$config['upload_path'] = './file/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		// $config['remove_spaces'] = TRUE;
		// $config['encrypt_name'] = TRUE;
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

	public function rendering_post()
	{
		$uniq = date('ymd').$this->tools->str_random_abj(4).'-'.$this->post('myid');
		$data = array(
			'id_user' => $this->post('myid'),
			'template' => $this->post('template'),
			'thumb' => $this->post('thumb'),
			'nama_video' => $uniq.'.mp4',
			'tgl_rendering' => date('Y-m-d H:i:s'), 
			'status_video' => 0
		);
		putenv('GOOGLE_APPLICATION_CREDENTIALS=' . 'assets/sheet.json');
		$client = new Google_Client;
		try{
		    $client->useApplicationDefaultCredentials();
		    $client->setApplicationName("Something to do with my representatives");
		    $client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
		    if ($client->isAccessTokenExpired()) {
		        $client->refreshTokenWithAssertion();
		    }

		    $accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
		    ServiceRequestFactory::setInstance(new DefaultServiceRequest($accessToken));
		    
		    // Get our spreadsheet
		    $spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
		        ->getSpreadsheetFeed()
		        ->getByTitle('sunlife-lebaran');

		    // Get the first worksheet (tab)
		    $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
		    $worksheet = $worksheets[0];

		    $listFeed = $worksheet->getListFeed();
			$listFeed->insert([
				'template' => $this->post('template'),
			    'text-1' =>  $this->post('text-1'),
			    'text-2' =>  $this->post('text-2'),
			    'text-3' =>  $this->post('text-3'),
			    'name' =>  $this->post('text-name'),
			    'whatsapp-number' =>  $this->post('text-wa'),
			    'photo' =>  $this->post('text-photo'),
			    'audio' =>  $this->post('text-audio'),
			    'aep' => '-',
			    'target' => $this->post('template'),
			    'render-status' => 'ready',
			    'output' => $uniq . '.mp4',
			]);
			$this->__upToDropbox($this->post('text-photo'));
			$insert = $this->api->insert('t_render', $data);
		}catch(Exception $e){
		    echo $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() . ' ' . $e->getCode;
		}
		if ($insert) {
			$this->response( [
	            'status' => true,
	            'data' => $data
	        ], 201 );
		}else{
			$this->response( [
	            'status' => false
	        ], 200 );
		}
	}

	function __upToDropbox($file)
	{
		$filename = './file/uploads/'.$file;
		$api_url = 'https://content.dropboxapi.com/2/files/upload'; //dropbox api url
        $token = 'rmp1LdZRb_EAAAAAAAAgRXRiuVZOsdCQb8u8t_LxKdrOXr6m5f-0Wiehmc9aCzL2';

        $headers = array('Authorization: Bearer '. $token,
            'Content-Type: application/octet-stream',
            'Dropbox-API-Arg: '.
            json_encode(
                array(
                    "path"=> '/SUNLIFE/Photo/'. basename($filename),
                    "mode" => "add",
                    "autorename" => true,
                    "mute" => false
                )
            )

        );

        $ch = curl_init($api_url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);

        $path = $filename;
        $fp = fopen($path, 'rb');
        $filesize = filesize($path);

        curl_setopt($ch, CURLOPT_POSTFIELDS, fread($fp, $filesize));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
	}

	function fullcalendar_get()
	{
		$query = $this->api->get_event();
		foreach ($query as $key => $value) {
			$result[] = [
				'id' => $value->id_kalender,
				'start' => $value->tanggal,
				'end' => $value->tanggal
			];
		}
		echo json_encode($result);
	}

	function eventid_get()
	{
		$query = $this->api->get_eventbyid(array('tanggal' => $this->get('kalender')));
		$this->response( [
            'data' => $query
        ], 200 );
	}

}

/* End of file Api_login.php */
/* Location: ./application/modules/api/controllers/Api_login.php */