<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}	

	public function index()
	{
		$data = [
			'title' => 'Calendar',
			'js' => 'calendar'
		];
		$this->template->load('templates','view_index',$data);
	}

	public function getCalendar	()
	{
		$list = $this->M_calendar->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->title;
			$row[] = $field->deskripsi;
			$row[] = $field->tanggal;
			$row[] = '<a href="javascript:;" class="mr-1 text-danger btn-hapus" data-id="'.$field->id_kalender.'"">
  			          	<i class="fa fa-trash" style="font-size: 18px;"></i>
  				        <label for="trash" class="text-danger" style="cursor: pointer;">Trash</label>
  			          </a>
  			          <a href="javascript:;" class="text-success btn-edit" data-idcalendar="'.$field->id_kalender.'">
  			            <i class="fa fa-edit" style="font-size: 18px;"></i>
  				        <label for="trash" class="text-success" style="cursor: pointer;">Edit</label>
  			          </a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_calendar->count_all(),
			"recordsFiltered" => $this->M_calendar->count_filtered(),
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}

	public function updateCalendar($id = '')
	{
		if ($id == '') {
			$dataJson['status'] = 'false';
		} else {
			$dataCalendar = $this->M_global->getOneWhere(array('id_kalender' => $id), 't_kalender');
			if ($dataCalendar) {
				$dataJson['dataCalendar'] = $dataCalendar;
				$dataJson['status'] = 'true';
			} else {
				$dataJson['status'] = 'false';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($dataJson);
	}

	public function simpan()
	{
		$data = [ 
			'title' => $this->input->post('title'), 
			'deskripsi' => $this->input->post('deskripsi'),
			'tanggal' => $this->input->post('tanggal')
		];

		$success = $this->M_global->insert('t_kalender',$data);
		if ($success) {
        	echo $this->session->set_flashdata('msg','simpan');
			redirect('calendar');
        }else{
			echo $this->session->set_flashdata('msg','gagal');
			redirect('calendar');
        }
	}

	public function update()
	{
		$data = [ 
			'title' => $this->input->post('titleUpdate'), 
			'deskripsi' => $this->input->post('deskripsiUpdate'),
			'tanggal' => $this->input->post('tanggalUpdate')
		];

		$id = $this->input->post('idUpdate');

		$success = $this->M_global->update('t_kalender',$data, ['id_kalender' => $id]);
		if ($success) {
        	echo $this->session->set_flashdata('msg','update');
			redirect('calendar');
        }else{
			echo $this->session->set_flashdata('msg','gagal');
			redirect('calendar');
        }
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$success = $this->M_global->delete('t_kalender','id_kalender',$id);
		if ($success) {
        	echo $this->session->set_flashdata('msg','delete');
			redirect('calendar');
        }else{
			echo $this->session->set_flashdata('msg','gagal');
			redirect('calendar');
        }
	}

}

/* End of file Audio.php */
/* Location: ./application/controllers/Audio.php */