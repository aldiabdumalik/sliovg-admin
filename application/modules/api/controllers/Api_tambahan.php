<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

class Api_tambahan extends RestController {

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

	public function thumb_post()
	{
		$input = file_get_contents("php://input");
		$input = json_decode($input);
		$image = $input->image;
		$location = "./file/uploads/Thumb/";
		$image_parts = explode(";base64,", $image);
		$image_base64 = base64_decode($image_parts[1]);
		$filename = "thumb_".uniqid().'.png';
		$file = $location . $filename;
		file_put_contents($file, $image_base64);
		$this->response([
            'status' => true,
            'img' => $filename
        ], 201 );
	}
}