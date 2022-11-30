<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function __destruct()
	{
		$this->db->close();
	}

	public function get_all_orders()
	{
		$status = 0;
		$data = array();
		$this->db->select('*');
		$this->db->from('donhang');
		$this->db->join('sanpham', 'sanpham.id_sanpham = donhang.id_sanpham');
		$this->db->where('donhang.status', $status);

		$result = $this->db->get();
		$data = $result->result_array();

		$orderProduct = array();
		foreach ($data as $k => $val) {
			$orderProduct[$val['id_sanpham']]['imgProduct'] = $val['img_path'];
			$orderProduct[$val['id_sanpham']]['nameProduct'] = $val['TenSp'];
			$orderProduct[$val['id_sanpham']]['ltsOrder'][] = $val;
		}
		return $orderProduct;
	}

	public function getDataOrderById($id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('donhang');
		$this->db->where('id_donhang', $id);
		$result = $this->db->get();
        $data = $result->result_array();
        return $data;
	}


	// update order
	public function updateOrder_model($id,$type)
	{
		$flag = FALSE;
		$data = array(
			'status'=>$type
		);
		$this->db->where('id_donhang', $id);
		if($this->db->update('donhang', $data)) 
		{
			$flag = TRUE;
		}
		return $flag;
	}

// update qty product
	public function updateQtyBook_model($idProduct, $qty)
	{
		$flag = FALSE;
		$data = array(
			'SoLuong'=>$qty
		);
		$this->db->where('id_sanpham', $idProduct);
		if($this->db->update('sanpham', $data)) 
		{
			$flag = TRUE;
		}
		return $flag;
	}

	// add cthd
	public function saveDetailOrders_model($id)
	{
		$flag = FALSE;
		$data = array(
			'id_donhang' => $id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => ''
		);
		if ($this->db->insert('chitiethoadon', $data)) {
			$flag = TRUE;
		}
		return $flag;
	}

	// delete Orders
	public function deleteOrders_model($id)
	{
		$flag = false;
        if ($this->db->delete('donhang', array('id_donhang' => $id))) {
            $flag = true;
        }
        return $flag;
	}
}

/* End of file Orders_model.php */
/* Location: .//C/xampp/htdocs/fashion/admin/app/models/Orders_model.php */