<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function index_2()
	{
		putenv('GOOGLE_APPLICATION_CREDENTIALS=' . 'assets/sheet.json');
		$client = new Google_Client;
		print_r($client);die();
		// try{
		//     $client->useApplicationDefaultCredentials();
		//     $client->setApplicationName("Something to do with my representatives");
		//     $client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
		//     if ($client->isAccessTokenExpired()) {
		//         $client->refreshTokenWithAssertion();
		//     }

		//     $accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
		//     ServiceRequestFactory::setInstance(new DefaultServiceRequest($accessToken));
		    
		//     // Get our spreadsheet
		//     $spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
		//         ->getSpreadsheetFeed()
		//         ->getByTitle('sunlife-lebaran');

		//     // Get the first worksheet (tab)
		//     $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
		//     $worksheet = $worksheets[0];

		//     $listFeed = $worksheet->getListFeed();
		// 	$listFeed->insert([
		// 		'template' => $this->post('template'),
		// 	    'text-1' =>  $this->post('text-1'),
		// 	    'text-2' =>  $this->post('text-2'),
		// 	    'text-3' =>  $this->post('text-3'),
		// 	    'name' =>  $this->post('text-name'),
		// 	    'whatsapp-number' =>  $this->post('text-wa'),
		// 	    'photo' =>  $this->post('text-photo'),
		// 	    'audio' =>  $this->post('text-audio'),
		// 	    'aep' => '-',
		// 	    'target' => $this->post('template'),
		// 	    'render-status' => 'ready',
		// 	    'output' => $uniq . '.mp4',
		// 	]);
		// 	$this->__upToDropbox($this->post('text-photo'));
		// 	$insert = $this->api->insert('t_render', $data);
		// }catch(Exception $e){
		//     echo $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() . ' ' . $e->getCode;
		// }
	}
}
