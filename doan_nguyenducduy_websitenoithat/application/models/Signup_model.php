<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function __destruct()
	{
		$this->db->close();
	}

	public function add_user($data = array())
	{
		$flag = 0;
		if ($this->db->insert('member', $data)) {
			$flag = $this->db->insert_id();
		}
		return $flag;
	}

	public function get_info_user($id_decode)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where('id_member', $id_decode);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}

	public function active_account_member_model($id_decode)
	{
		$flag = FALSE;
		$data = array(
			'TrangThai' => 1
		);
		$this->db->where('id_member', $id_decode);
		if ($this->db->update('member', $data)) {
			$flag = TRUE;
		}
		return $flag;
	}
}

/* End of file Signup_model.php */
/* Location: ./application/models/Signup_model.php */