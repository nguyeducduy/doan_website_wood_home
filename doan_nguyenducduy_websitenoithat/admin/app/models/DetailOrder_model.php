<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailOrder_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function __destruct()
	{
		$this->db->close();
	}
	
	public function getAllData($keyword = "")
	{
		$data = array();
        $this->db->select('*');
        $this->db->from('chitiethoadon');
        $this->db->join('donhang', 'donhang.id_donhang = chitiethoadon.id_donhang');
        $this->db->join('sanpham', 'sanpham.id_sanpham = donhang.id_sanpham');
        $this->db->like('TenKH', $keyword);
        $this->db->or_like('SDT', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('DiaChi', $keyword);
        $this->db->or_like('TenSp', $keyword);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
	}

	public function getDataDetailOrderByPage($start, $limit, $keyword = "")
	{
		$currPage = ($start - 1)*$limit;
        $data = array();
        $this->db->select('*');
        $this->db->from('chitiethoadon');
        $this->db->join('donhang', 'donhang.id_donhang = chitiethoadon.id_donhang');
        $this->db->join('sanpham', 'sanpham.id_sanpham = donhang.id_sanpham');
        $this->db->like('TenKH', $keyword);
        $this->db->or_like('SDT', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('DiaChi', $keyword);
        $this->db->or_like('TenSp', $keyword);
        $this->db->limit($limit, $currPage);
        $this->db->order_by('chitiethoadon.created_at', 'DESC');
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
	}

	// get by id
	public function getDataInfoDetailOrder_model($id)
	{
		$data = array();
        $this->db->select('*');
        $this->db->from('chitiethoadon');
        $this->db->join('donhang', 'donhang.id_donhang = chitiethoadon.id_donhang');
        $this->db->join('sanpham', 'sanpham.id_sanpham = donhang.id_sanpham');
        $this->db->where('chitiethoadon.id_hoadon', $id);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
	}


	// delete cthd
	public function deleteDataDetailOrder_model($id)
	{
		$flag = false;
        if ($this->db->delete('chitiethoadon', array('id_hoadon' => $id))) {
            $flag = true;
        }
        return $flag;
	}

}

/* End of file DetailOrder_model.php */
/* Location: .//C/xampp/htdocs/fashion/admin/app/models/DetailOrder_model.php */