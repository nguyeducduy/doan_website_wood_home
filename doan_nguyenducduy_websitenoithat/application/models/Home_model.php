<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	function __construct(){
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

// ham lay sach theo id de hien ra chi tiet sach
	function get_data_product_by_id($idProduct)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('sanpham');
		$this->db->join('loaisp', 'loaisp.id_loai = sanpham.id_loai');
        $this->db->join('nhanhieu', 'nhanhieu.id_nhanhieu = sanpham.id_nhanhieu');
		$this->db->where('sanpham.id_sanpham', $idProduct);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}

	// ham cap nhap view
	function update_view_product($id, $view)
	{
		$flag = FALSE;
		$view++;
		$data = array(
			'SoLuotXem' => $view
		);
		$this->db->where('id_sanpham', $id);
		if ($this->db->update('sanpham', $data)) {
			$flag = TRUE;
		}
		return $flag;
	}

	// sp lien quan
	public function get_data_product_by_type($idloai, $id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('sanpham');
		// $this->db->join('loaisach', 'loaisach.id_loai = sach.id_loai');
		$this->db->where('sanpham.id_loai', $idloai);
		$this->db->where('sanpham.id_sanpham <>', $id);
		$result = $this->db->get();
		$data = $result->result_array();
		return $data;
	}

	public function add_orders($data)
	{
		$flag = FALSE;
		if ($this->db->insert('donhang', $data)) 
		{
			$flag = TRUE;
		}
		return $flag;
	}
}

/* End of file Home_model.php */
/* Location: ./application/models/Home_model.php */