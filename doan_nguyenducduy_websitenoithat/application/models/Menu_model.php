<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getAllBrand_model()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('nhanhieu');
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	public function getAllTypeWoman_model()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('loaisp');
		$this->db->where('gioitinh', 0);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	public function getAllTypeMan_model()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('loaisp');
		$this->db->where('gioitinh', 1);
		$query = $this->db->get();
		$data = $query->result_array();
		return $data;
	}

	function __destruct(){
		$this->db->close();
	}
}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */