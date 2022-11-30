<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_data($keyword = "")
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('nhanhieu');
        $this->db->like('ten_nhanhieu', $keyword);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    public function getDataBrandByPage($start, $limit, $keyword = "")
    {
        $currPage = ($start - 1)*$limit;
        $data = array();
        $this->db->select('*');
        $this->db->from('nhanhieu');
        $this->db->like('ten_nhanhieu', $keyword);
        $this->db->limit($limit, $currPage);
        $this->db->order_by('created_at', 'DESC');
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    public function getInfoDataBrand_model($id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('nhanhieu');
        $this->db->where('id_nhanhieu', $id);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    public function deleteBrand_model($id)
    {
        $flag = false;
        if ($this->db->delete('nhanhieu', array('id_nhanhieu' => $id))) {
            $flag = true;
        }
        return $flag;
    }

    public function checkNameBrand_model($name)
    {
        $flag = true;
        $this->db->select('*');
        $this->db->from("nhanhieu");
        $this->db->where('ten_nhanhieu', $name);
        $result = $this->db->get();
        $data = $result->result_array();
        if (!empty($data)) // $result
        {
            $flag = false;
        }
        return $flag;
    }

    public function addBrand_model($name, $image)
    {
        $flag = false;
        $data = array(
            'ten_nhanhieu' => $name,
            'image' => $image,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => ''
        );
        if ($this->db->insert('nhanhieu', $data))
        {
            $flag = true;
        }
        return $flag;
    }

    public function updateInfoBrand_model($id, $nameBrand,$status, $hinhanh)
    {
        $flag = false;
        $data = array(
            'ten_nhanhieu' => $nameBrand,
            'image' => $hinhanh,
            'status' => $status,
            'created_at' => '',
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_nhanhieu', $id);
        if ($this->db->update('nhanhieu', $data))
        {
            $flag = true;
        }
        return $flag;
    }
}
