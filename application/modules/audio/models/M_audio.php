<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_audio extends CI_Model {

	var $table = 'tbl_musik'; //nama tabel dari database
    var $column_order = array(null,'id_musik','nama_musik','kategori_musik'); //field yang ada di table user
    var $column_search = array('id_musik','nama_musik','kategori_musik'); //field yang diizin untuk pencarian 
    var $order = array('id_musik' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
    {
     	$this->db->select('*');
        $this->db->from($this->table);	
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getKategoriAudio()
    {
        $this->db->select('kategori_musik');
        $this->db->group_by('kategori_musik');
        return $this->db->get('tbl_musik')->result_array();
    }

    public function getAudioWhere($id)
    {
        $this->db->from($this->table);  
        $this->db->where('id_musik', $id);
        return $this->db->get()->row();
    }

    public function countAllKategori()
    {
        return $this->db->get('tbl_musik')->num_rows();
    }

    public function countPerKategori()
    {
        $this->db->select('kategori_musik,count(kategori_musik) as jumlah');
        $this->db->group_by('kategori_musik');
        return $this->db->get('tbl_musik')->result_array();
    }

}

/* End of file M_video.php */
/* Location: ./application/models/mod/M_video.php */