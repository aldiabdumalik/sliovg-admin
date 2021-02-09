<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
            redirect('dashboard','refresh');
        }
	}

	public function index()
	{

		$data = [
			'title' => 'Dashboard',
			'js' => 'dashboard',
			'total_user' => $this->db->get('t_user')->num_rows(),
			'rendering' => $this->count_table(),// $this->M_report->countRend(),
			'template' => $this->db->get('t_video')->num_rows(),
			'status_server' => $this->db->get('t_notif')->row()
		];
		
		$this->template->load('templates','view_index',$data);
	}

	public function post_notif()
	{
		$query = $this->db->update('t_notif', array('status' => $this->input->post('status')), array('id' => 1));
		echo json_encode(['status' => true]);
	}

	public function count_table()
	{
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
		    $spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
		        ->getSpreadsheetFeed()
		        ->getByTitle('sunlife-lebaran');
		    $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
		    $worksheet = $worksheets[0];
		    $listFeed = $worksheet->getListFeed();
			return count($listFeed->getEntries());
		}catch(Exception $e){
		    echo $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() . ' ' . $e->getCode;
		}
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */