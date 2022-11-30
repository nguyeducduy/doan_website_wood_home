<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getAllData($keyword = "")
	{
		$data = array();
        $this->db->select('*');
        $this->db->from('sanpham');
        $this->db->join('loaisp', 'loaisp.id_loai = sanpham.id_loai');
        $this->db->join('nhanhieu', 'nhanhieu.id_nhanhieu = sanpham.id_nhanhieu');
        $this->db->like('TenSp', $keyword);
        $this->db->or_like('ten_nhanhieu', $keyword);
        $this->db->or_like('TenLoai', $keyword);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
	}

	public function getDataProductByPage($start, $limit, $keyword = "")
	{
		$currPage = ($start - 1)*$limit;
        $data = array();
        $this->db->select('*');
        $this->db->from('sanpham');
        $this->db->join('loaisp', 'loaisp.id_loai = sanpham.id_loai');
        $this->db->join('nhanhieu', 'nhanhieu.id_nhanhieu = sanpham.id_nhanhieu');
        $this->db->like('TenSp', $keyword);
        $this->db->or_like('ten_nhanhieu', $keyword);
        $this->db->or_like('TenLoai', $keyword);
        $this->db->limit($limit, $currPage);
        $this->db->order_by('sanpham.created_at', 'DESC');
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
	}


	public function getInfoDataProduct_model($id)
	{
		$data = array();
        $this->db->select('*');
        $this->db->from('sanpham');
        $this->db->where('id_sanpham', $id);
        $result = $this->db->get();
        $data = $result->result_array();
        return $data;
	}

	// delete 
	public function deleteProduct_model($id)
	{
		$flag = false;
        if ($this->db->delete('sanpham', array('id_sanpham' => $id))) {
            $flag = true;
        }
        return $flag;
	}
// end delete

	// check name exist 
	public function checkNameProduct_model($name)
	{
		$flag = true;
        $this->db->select('*');
        $this->db->from("sanpham");
        $this->db->where('TenSp', $name);
        $result = $this->db->get();
        $data = $result->result_array();
        if (!empty($data))
        {
            $flag = false;
        }
        return $flag;
	}

	// add
	public function addProduct_model($name, $type, $brand, $gioitinh, $cost, $qty, $image)
	{
		$flag = false;
        $data = array(
            'TenSp' => $name,
            'img_path' => $image,
            'id_loai' => $type,
            'id_nhanhieu' => $brand,
            'sex' => $gioitinh,
            'GiaCu' => $cost,
            'status' => 1,
            'SoLuong' => $qty,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => ''
        );
        if ($this->db->insert('sanpham', $data))
        {
            $flag = true;
        }
        return $flag;
	}
	//end add

	// edit
	public function updateInfoProduct_model($id, $nameProduct, $type, $brand, $gioitinh, $costOld, $costNew, $qty, $view, $status, $hinhanh)
	{
		$flag = false;
        $data = array(
            'TenSp' => $nameProduct,
            'id_loai' => $type,
            'id_nhanhieu' => $brand,
            'sex' => $gioitinh,
            'GiaCu' => $costOld,
            'GiaMoi' => $costNew,
            'status' => $status,
            'SoLuong' => $qty,
            'SoLuotXem' => $view,
            'img_path' => $hinhanh,
            'created_at' => '',
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_sanpham', $id);
        if ($this->db->update('sanpham', $data))
        {
            $flag = true;
        }
        return $flag;
	}
	//end edit
}

/* End of file Product_model.php */
/* Location: .//C/xampp/htdocs/fashion/admin/app/models/Product_model.php */