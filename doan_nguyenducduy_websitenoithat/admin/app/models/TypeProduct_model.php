<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TypeProduct_model extends CI_Model
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
        $this->db->from('loaisp');
        $this->db->like('TenLoai', $keyword);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    public function getDataTypeProductByPage($start, $limit, $keyword = "")
    {
        $currPage = ($start - 1)*$limit;
        $data = array();
        $this->db->select('*');
        $this->db->from('loaisp');
        $this->db->like('TenLoai', $keyword);
        $this->db->limit($limit, $currPage);
        $this->db->order_by('created_at', 'DESC');
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    // get data by id
    public function getInfoDataTypeProduct_model($id)
    {
        $data = array();
        $this->db->select('*');
        $this->db->from('loaisp');
        $this->db->where('id_loai', $id);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    //delete
    public function deleteTypeProduct_model($id)
    {
        $flag = false;
        if ($this->db->delete('loaisp', array('id_loai' => $id))) {
            $flag = true;
        }
        return $flag;
    }

    // kiem tra xem co trung voi db ko
    public function checkNameTypeProduct_model($name)
    {
        $flag = true;
        $this->db->select('*');
        $this->db->from("loaisp");
        $this->db->where('TenLoai', $name);
        $result = $this->db->get();
        $data = $result->result_array();
        if (!empty($data)) // $result
        {
            $flag = false;
        }
        return $flag;
    }

    // them loai quan ao
    public function addTypeProduct_model($name, $gioitinh)
    {
        $flag = false;
        $data = array(
            'TenLoai' => $name,
            'gioitinh' => $gioitinh,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => ''
        );
        if ($this->db->insert('loaisp', $data))
        {
            $flag = true;
        }
        return $flag;
    }

    // sua loai quan ao
    public function updateInfoTypeProduct_model($id, $nameType,$gioitinh, $status)
    {
        $flag = false;
        $data = array(
            'TenLoai' => $nameType,
            'gioitinh' => $gioitinh,
            'status' => $status,
            'created_at' => '',
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_loai', $id);
        if ($this->db->update('loaisp', $data))
        {
            $flag = true;
        }
        return $flag;
    }

}