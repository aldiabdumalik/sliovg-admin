<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_report extends CI_Model
{

	public function countFb()
	{
		$this->db->select_sum('fb_share');
		return $this->db->get('t_share')->row();
	}

	public function countTwit()
	{
		$this->db->select_sum('twitter_share');
		return $this->db->get('t_share')->row();
	}

	public function countIg()
	{
		$this->db->select_sum('ig_share');
		return $this->db->get('t_share')->row();
	}

	public function countYt()
	{
		$this->db->select_sum('yt_share');
		return $this->db->get('t_share')->row();
	}

	public function countWa()
	{
		$this->db->select_sum('wa_share');
		return $this->db->get('t_share')->row();
	}

	public function countLi()
	{
		$this->db->select_sum('linkedin_share');
		return $this->db->get('t_share')->row();
	}

	public function countUser()
	{
		return $this->db->get('t_user')->num_rows();
	}

	public function countRend()
	{
		return $this->db->get('t_render')->num_rows();
	}

	public function countRenderTemplate()
	{
		$this->db->select('t_kategori.nama_kategori as nama,(count(nama_kategori)/10) as jumlah, count(nama_kategori) as total');
		$this->db->join('t_video', 't_video.video = t_render.template', 'left');
		$this->db->join('t_kategori', 't_kategori.id_kategori = t_video.id_kategori', 'left');
		$this->db->where('t_kategori.template', 'video');
		$this->db->group_by('t_kategori.nama_kategori');
		return $this->db->get('t_render')->result_array();
	}

	public function getReportData()
	{
		$this->db->select('t_user.name, t_user.serial_number, count(nama_kategori) as jumlah, status');
		$this->db->join('t_video', 't_video.video = t_render.template', 'left');
		$this->db->join('t_kategori', 't_kategori.id_kategori = t_video.id_kategori', 'left');
		$this->db->join('t_user', 't_user.serial_number = t_render.id_user', 'left');
		$this->db->where('t_kategori.template', 'video');
		$this->db->group_by('t_render.id_user');
		return $this->db->get('t_render')->result_array();
	}



	// DataTable
	var $table = 't_render'; //nama tabel dari database
	var $column_order = array(null, 'id_user', 'nama_video', 'tgl_rendering'); //field yang ada di table user
	var $column_search = array('tgl_rendering'); //field yang diizin untuk pencarian 
	var $order = array('tgl_rendering' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->from($this->table);
		$this->db->join('t_user', 't_user.serial_number = t_render.id_user', 'left');

		$i = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($date)
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$this->db->like('tgl_rendering', $date);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($date)
	{
		$this->_get_datatables_query();
		$this->db->like('tgl_rendering', $date);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($date)
	{
		$this->db->from($this->table);
		$this->db->like('tgl_rendering', $date);
		return $this->db->count_all_results();
	}
}

/* End of file M_video.php */
/* Location: ./application/models/mod/M_video.php */