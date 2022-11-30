<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_data($id = '')
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('sanpham');
        $this->db->join('nhanhieu', 'sanpham.id_nhanhieu = nhanhieu.id_nhanhieu');
        $this->db->join('loaisp', 'loaisp.id_loai = sanpham.id_loai');
        if ($id == 1) {
        	$this->db->where('GiaCu >=', 10000);
        	$this->db->where('GiaCu <=', 199000);
        }
        if ($id == 2) {
        	$this->db->where('GiaCu >=', 200000);
        	$this->db->where('GiaCu <=', 499000);
        }
        if ($id == 3) {
        	$this->db->where('GiaCu >=', 500000);
        }
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    public function getDataPriceByPage($start, $limit, $id = '')
    {
        $currPage = ($start - 1)*$limit;
        $data = array();
        $this->db->select('*');
        $this->db->from('sanpham');
        $this->db->join('nhanhieu', 'sanpham.id_nhanhieu = nhanhieu.id_nhanhieu');
        $this->db->join('loaisp', 'loaisp.id_loai = sanpham.id_loai');
        if ($id == 1) {
        	$this->db->where('GiaCu >=', 10000);
        	$this->db->where('GiaCu <=', 199000);
        }
        if ($id == 2) {
        	$this->db->where('GiaCu >=', 200000);
        	$this->db->where('GiaCu <=', 499000);
        }
        if ($id == 3) {
        	$this->db->where('GiaCu >=', 500000);
        }
        $this->db->limit($limit, $currPage);
        $this->db->order_by('sanpham.created_at', 'DESC');
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

}

/* End of file Price_model.php */
/* Location: ./application/models/Price_model.php */