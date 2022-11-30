<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_data($id = '')
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('nhanhieu');
        $this->db->join('sanpham', 'sanpham.id_nhanhieu = nhanhieu.id_nhanhieu');
        $this->db->join('loaisp', 'loaisp.id_loai = sanpham.id_loai');
        $this->db->where('nhanhieu.id_nhanhieu', $id);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    public function getDataBrandByPage($start, $limit, $id = '')
    {
        $currPage = ($start - 1)*$limit;
        $data = array();
        $this->db->select('*');
        $this->db->from('nhanhieu');
        $this->db->join('sanpham', 'sanpham.id_nhanhieu = nhanhieu.id_nhanhieu');
        $this->db->join('loaisp', 'loaisp.id_loai = sanpham.id_loai');
        $this->db->where('nhanhieu.id_nhanhieu', $id);
        $this->db->limit($limit, $currPage);
        $this->db->order_by('nhanhieu.created_at', 'DESC');
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

}

/* End of file Brand_model.php */
/* Location: ./application/models/Brand_model.php */