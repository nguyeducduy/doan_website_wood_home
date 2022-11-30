<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller {

	public function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
		$this->__check_login_user();
		$this->load->model('orders_model');
		$this->load->model('product_model');
		// $this->lang->load('orders','vietnamese');
		// $this->load->library('myflashmessages');
	}

	private function __check_login_user()
    {
        if (!$this->_check_login()) {
            redirect(site_url('login/index'));
            die();
        }
    }

    public function index()
	{

		$data = array();
		$allOrders = $this->orders_model->get_all_orders();
		$data['orders'] = $allOrders;
		// echo '<pre/>';
		// print_r($data['orders']);
		// die();
		// $data['lang'] = $this->lang->line('orders_lang');
		$header = array();
		$header['title'] = "Order";
		$header['content'] = "This is Order";

		$this->_load_header($header);
		$this->_load_aside();
		$this->load->view('orders/index_view', $data);
		$this->_load_footer();
	}

	public function update()
	{
		if ($this->input->is_ajax_request()) 
		{
			$id = $this->input->post('id', TRUE);
			$id = $this->security->xss_clean($id);
			$id = is_numeric($id) ? $id : 0;

			$type = $this->input->post('type', TRUE);
			$type = $this->security->xss_clean($type);
			$type = (is_numeric($type) && in_array($type,array('1','2'))) ? $type : 0;
			$data = array();
			$data['result'] = '';

			if ($id !=0 && $type !=0) 
			{
				if ($type == 1) 
				{
					$dataInfo = $this->orders_model->getDataOrderById($id);
					foreach ($dataInfo as $key => $value) {
						$idProduct = $value['id_sanpham'];
						$qtyOrder = $value['QTY'];
					}

					$dataProduct = $this->product_model->getInfoDataProduct_model($idProduct);
					foreach ($dataProduct as $key => $value) {
						$qtyProduct = $value['SoLuong'];
					}
					$qty = $qtyProduct - $qtyOrder;
					if ($qty < 0) {
						echo 'errqty';
					}
					else
					{

						$update = $this->orders_model->updateOrder_model($id,$type);
			    		$updateQty = $this->orders_model->updateQtyBook_model($idProduct, $qty);
			            if($update && $updateQty){

			                $detailOrders = $this->orders_model->saveDetailOrders_model($id);
			                if($detailOrders){
			                    echo "ok";
			                }else{
			                    echo "err";
			                }

			            }else{
			                echo "errup";
			            }

					}
					
				}elseif ($type == 2) {
					
					$delete = $this->orders_model->deleteOrders_model($id);
		            if($delete)
		            {
		                echo "ok";
		            }
		            else
		            {
		                echo "errde";
		            }

				}
			} else 
			{
				echo "err";
			}
		}
	}

}

/* End of file Orders.php */
/* Location: .//C/xampp/htdocs/fashion/admin/app/controllers/Orders.php */