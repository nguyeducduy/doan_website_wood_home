<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_data($id = '')
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('loaisp');
        $this->db->join('sanpham', 'sanpham.id_loai = loaisp.id_loai');
        $this->db->join('nhanhieu', 'nhanhieu.id_nhanhieu = sanpham.id_nhanhieu');
        $this->db->where('loaisp.id_loai', $id);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    public function getDataTypeByPage($start, $limit, $id = '')
    {
        $currPage = ($start - 1)*$limit;
        $data = array();
        $this->db->select('*');
        $this->db->from('loaisp');
        $this->db->join('sanpham', 'sanpham.id_loai = loaisp.id_loai');
        $this->db->join('nhanhieu', 'nhanhieu.id_nhanhieu = sanpham.id_nhanhieu');
        $this->db->where('loaisp.id_loai', $id);
        $this->db->limit($limit, $currPage);
        $this->db->order_by('loaisp.created_at', 'DESC');
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

}

/* End of file Type_model.php */
/* Location: ./application/models/Type_model.php */