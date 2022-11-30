<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function __destruct()
	{
		$this->db->close();
	}

	public function check_user_login($username, $password)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where('TenDangNhap', $username);
		$this->db->where('MatKhau', $password);
		$this->db->where('TrangThai', 1);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */