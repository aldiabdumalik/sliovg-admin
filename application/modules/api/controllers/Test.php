<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
class Test extends CI_Controller {

	public function index()
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
		    
		    // Get our spreadsheet
		    $spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
		        ->getSpreadsheetFeed()
		        ->getByTitle('sunlife-lebaran');

		    // Get the first worksheet (tab)
		    $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
		    $worksheet = $worksheets[0];

		    $listFeed = $worksheet->getListFeed();
			echo count($listFeed->getEntries());
		}catch(Exception $e){
		    echo $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() . ' ' . $e->getCode;
		}
	}

	public function dropbox()
	{
		$filename = './assets/vid.mp4';
		$api_url = 'https://content.dropboxapi.com/2/files/upload'; //dropbox api url
        $token = 'rmp1LdZRb_EAAAAAAAAgRXRiuVZOsdCQb8u8t_LxKdrOXr6m5f-0Wiehmc9aCzL2';

        $headers = array('Authorization: Bearer '. $token,
            'Content-Type: application/octet-stream',
            'Dropbox-API-Arg: '.
            json_encode(
                array(
                    "path"=> '/SUNLIFE/'. basename($filename),
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

}

/* End of file test.php */
/* Location: ./application/modules/api/controllers/test.php */