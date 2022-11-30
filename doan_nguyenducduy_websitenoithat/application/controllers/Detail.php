<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
	}

	public function index($stringID=null)
	{
		$data = array();

		// tach chuoi thanh mang voi dieu kien la dau -
		$arrStringID = explode("-", $stringID);

		// lay phan tu cuoi cung trong mang
		$idProduct = end($arrStringID);
		// echo $idBook; die();
		$idProduct = is_numeric($idProduct) ? $idProduct : 0;
		$detailProduct = $this->Home_model->get_data_product_by_id($idProduct);
		if (empty($detailProduct)) {
			show_404();
		}
		else {
			$data['detailProduct'] = $detailProduct;
			$this->Home_model->update_view_product($idProduct, $detailProduct['SoLuotXem']);

			// sach lien quan loai tru sach dang xem
			$data['sameProduct'] = $this->Home_model->get_data_product_by_type($detailProduct['id_loai'], $idProduct);
			$header = array();
			$header['title'] = 'welcome to detail';
			$header['content'] = 'this is detail';
			$this->_load_header($header);
			$this->load->view('detail/index_view', $data);
			$this->_load_menu_right();
			$this->_load_footer();
		}
	}

}

/* End of file Deatail.php */
/* Location: ./application/models/Deatail.php */