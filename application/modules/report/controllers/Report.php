<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'title' => 'Report',
			'js' => 'report',
			'facebook' => $this->M_report->countFb(),
			'twitter' => $this->M_report->countTwit(),
			'youtube' => $this->M_report->countYt(),
			'instagram' => $this->M_report->countIg(),
			'wa' => $this->M_report->countWa(),
			'linkedin' => $this->M_report->countLi(),
			'total_user' => $this->M_report->countUser(),
			'rendering' => $this->M_report->countRend(),
			'render_template' => $this->M_report->countRenderTemplate()
		];
		$this->template->load('templates', 'view_index', $data);
	}

	public function export_excel()
	{
		$data = $this->M_report->getReportData();
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Nama');
		$sheet->setCellValue('B1', 'Serial Number');
		$sheet->setCellValue('C1', 'Total Render');
		$sheet->setCellValue('D1', 'Status');
		$no = 2;
		foreach ($data as $v) {
			$sheet->setCellValue('A' . $no, $v['name']);
			$sheet->setCellValue('B' . $no, $v['serial_number']);
			$sheet->setCellValue('C' . $no, $v['jumlah']);
			if ($v['status'] == 1) {
				$status = 'Aktif';
			} else {
				$status = 'Tidak Aktif';
			}
			$sheet->setCellValue('D' . $no, $status);
			$no++;
		}

		$writer = new Xlsx($spreadsheet);

		$filename = 'Report';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function getDate($mydate)
	{
		$list = $this->M_report->get_datatables($mydate);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$row = array();
			$row[] = $field->serial_number;
			$row[] = $field->name;
			$row[] = $field->nama_video;
			$row[] = date('d/m/Y H:i', strtotime($field->tgl_rendering));

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_report->count_all($mydate),
			"recordsFiltered" => $this->M_report->count_filtered($mydate),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */