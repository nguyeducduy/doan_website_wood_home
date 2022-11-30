<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('home_model');

	}

	public function index($mess=null)
	{
		$content = array();

		$content['cart'] = $this->cart->contents();
		$this->session->set_userdata('carts', count($content['cart']));
		$content['mess'] = (isset($mess) && $mess=='fail')?'Vui long chon sp':'';
		$content['success'] = (isset($mess) && $mess=='success')?'Dat hang thanh cong! Chung toi se lien he voi ban trong thoi gian som nhat':'';
		$content['err'] = (isset($mess) && $mess=='err')?'Co loi xay ra':'';

		// echo '<pre>';
		// 	print_r($content['cart']); die();
		$header = array();
        $header['title'] = 'Cart';
        $header['content'] = 'This is cart';
        $this->_load_header($header);
        // $this->_load_banner();
        $this->load->view('cart/index_view', $content);
        // $this->_load_menu_right();
        $this->_load_footer();

	}

	public function addCart($id=null)
	{
		$id = is_numeric($id)?$id :0;
		$infoProduct = $this->home_model->get_data_product_by_id($id);
		if (!empty($infoProduct)) {
			$qty = $this->input->post('txtSoLuong', TRUE);
			$qty = (!empty($qty) && $qty >0) ? $qty :1;
			$data = array(
				'id' => $id,
				'qty' => $qty,
				'price' =>(empty($infoProduct['GiaMoi'])? $infoProduct['GiaCu']:$infoProduct['GiaMoi']),
				'name' => $infoProduct['TenSp'],
				'options' => array('image' => $infoProduct['img_path'])
			);
			// echo '<pre>';
			// print_r($data); die();
			$this->cart->insert($data);
			redirect(site_url('cart/index'));
			// $this->index();
		} else {
			show_404();
		}
	}

	public function delete($id=null)
	{
		$this->cart->remove($id);
		redirect(site_url('cart/index'));
	}

	public function deleteall()
	{
		$this->cart->destroy();
		redirect(site_url('cart/index'));
	}

	public function update_cart()
	{
		$data = array();
		if ($this->input->post()) {
			$arrQty = $this->input->post('txtQty', TRUE);
			$cartContent = $this->cart->contents();
			// print_r($arrQty); die();
			foreach ($cartContent as $k1=> $c) {
				foreach ($arrQty as $k2 => $v) {
					if ($c['rowid'] == $k2 && $v <10) {
						$data[] = array(
							'rowid' => $c['rowid'],
							'qty' => $v
						);
					}
				}
			}

			$this->cart->update($data);
			redirect(site_url('cart/index'));
		}
	}

	public function orders()
	{
		if ($this->input->post())
		{
			$cart = $this->cart->contents();
			if (!empty($cart))
			{
				$fullname = $this->input->post('txtHoTen', TRUE);
				$fullname = $this->security->xss_clean($fullname);

				$phone = $this->input->post('txtSoDienThoai', TRUE);
				$phone = $this->security->xss_clean($phone);

				$email = $this->input->post('txtEmail', TRUE);
				$email = $this->security->xss_clean($email);

				$add = $this->input->post('txtDiaChi', TRUE);
				$add = $this->security->xss_clean($add);

				$note = $this->input->post('txtGhiChu', TRUE);
				$note = $this->security->xss_clean($note);

				$check = FALSE;
				$data = array();
				foreach ($cart as $k => $c)
				{
					$data = array(
						'id_sanpham'=>$c['id'],
						'TenKH' => $fullname,
						'email'=>$email,
						'SDT' => $phone,
						'DiaChi'=>$add,
						'GhiChu' => $note,
						'QTY' => $c['qty'],
						'ThanhTien' => $c['subtotal'],
						'status' => 0,
						'create_at' => date('Y-m-d H:i:s'),
						'update_at' => ''
					);
					$check = $this->home_model->add_orders($data);
				}
				if ($check) {
					$this->cart->destroy();
					redirect(site_url('cart/index/success'));
				} else {
					redirect(site_url('cart/index/err'));
				}

			}else {
				redirect(site_url('cart/index/fail'));
			}
		}
	}
}

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */
