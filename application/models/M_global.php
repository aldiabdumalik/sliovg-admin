<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_global extends CI_Model {

	public function insert($table,$data)
	{
		return $this->db->insert($table, $data);
	}

	public function update($table,$data,$where=array())
	{
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function delete($table,$where,$id)
	{
		$this->db->where($where, $id);
		return $this->db->delete($table);
	}

	public function get($table)
	{
		return $this->db->get($table)->result();
	}

	public function getOneSpesificWhere($select,$where,$table){
		return $this->db->select($select)->where($where)->get($table)->row();
	}

	public function getOneWhere($where,$table){
		return $this->db->where($where)->get($table)->row();
	}

}

/* End of file M_global.php */
/* Location: ./application/models/M_global.php */