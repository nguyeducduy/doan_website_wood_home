<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model 
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
        $this->db->from('member');
        $this->db->like('TenDangNhap', $keyword);
        $this->db->or_like('TenHienThi', $keyword);
        $this->db->or_like('SDT', $keyword);
        $this->db->or_like('Email', $keyword);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    public function getDataMemberByPage($start, $limit, $keyword = "")
    {
    	$currPage = ($start - 1)*$limit;
        $data = array();
        $this->db->select('*');
        $this->db->from('member');
        $this->db->like('TenDangNhap', $keyword);
        $this->db->or_like('TenHienThi', $keyword);
        $this->db->or_like('SDT', $keyword);
        $this->db->or_like('Email', $keyword);
        $this->db->limit($limit, $currPage);
        $this->db->order_by('created_time', 'DESC');
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    // get member by id
    public function getInfoDataMember_model($id)
    {
    	$data = array();
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('id_member', $id);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
    }

    // delete
    public function deleteMember_model($id)
    {
    	$flag = false;
        if ($this->db->delete('member', array('id_member' => $id))) {
            $flag = true;
        }
        return $flag;
    }

    // edit
    public function updateInfoMember_model($id, $status)
    {
    	$flag = false;
        $data = array(
            'TrangThai' => $status,
            'created_time' => '',
            'updated_time' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_member', $id);
        if ($this->db->update('member', $data))
        {
            $flag = true;
        }
        return $flag;
    }
}

/* End of file Member_model.php */
/* Location: .//C/xampp/htdocs/fashion/admin/app/models/Member_model.php */