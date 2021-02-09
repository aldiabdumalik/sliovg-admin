<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends CI_Model {

	function login($where)
	{
		$query = $this->db->get_where('t_user', $where);
		return $query->row();
	}

	function get_notif(	)
	{
		return $this->db->get('t_notif')->row();
	}

	function music($data)
	{
		$limit = 12;
		$offset = $limit*$data['page'];
		$query = $this->db->get_where('tbl_musik', array('kategori_musik' => $data['kategori']), $limit, $offset);
		return $query->result();
	}

	function get_email($email)
	{
		$query = $this->db->get_where('t_user', array('email' => $email));
		return $query->row();
	}

	function insert($table, $data)
	{
		$this->db->insert($table, $data);
		return true;
	}

	function update($table, $data, $where)
	{
		$this->db->update($table, $data, $where);
		return true;
	}

	function get_myvideo($where, $page=0)
	{
		$limit = 6;
		$offset = $limit*$page;
		$this->db->order_by('tgl_rendering', 'desc');
		$query = $this->db->get_where('t_render', $where, $limit, $offset);
		return $query->result();
	}
	function count_video($where)
	{
		$query = $this->db->get_where('t_render', $where);
		return $query->result();
	}

	function get_myvideobyid($where)
	{
		$query = $this->db->get_where('t_render', $where);
		return $query->row();
	}

	function share_myvideobyid($like)
	{
		$this->db->like('nama_video', $like);
		$query = $this->db->get('t_render');
		return $query->row();
	}

	function get_reportingbyid($where)
	{
		$this->db->join('t_share', 't_share.id_render = t_render.id_render', 'left');
		$query = $this->db->get_where('t_render', $where);
		return $query->row();
	}

	function cek_report($where)
	{
		$query = $this->db->get_where('t_share', $where);
		return $query->row();
	}

	function get_event()
	{
		$query =  $this->db->get('t_kalender');
		return $query->result();
	}

	function get_eventbyid($where)
	{
		$query =  $this->db->get_where('t_kalender', $where);
		return $query->result();
	}
	
	function template($where, $page=0, $like=null)
	{
		$limit = 6;
		$offset = $limit*$page;
		if ($like != null) {
			$this->db->like('hak_akses', $like, 'BOTH');
		}
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('id_video', 'asc');
		$query = $this->db->get('t_video');
		return $query->result();
	}

	function count_template($where, $like=null)
	{
		$this->db->where($where);
		if ($like != null) {
			$this->db->like('hak_akses', $like, 'BOTH');
		}
		$query = $this->db->get('t_video');
		return $query->result();
	}

}

/* End of file M_api.php */
/* Location: ./application/modules/v1/models/M_api.php */