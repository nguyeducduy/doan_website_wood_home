<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $_module;

	function __construct()
	{
		parent::__construct();
	}

	protected function _load_header($header = array())
	{
		$data = array();
		$data['title'] = $header['title'];
		$data['content'] = $header['content'];
		$data['module'] = $this->_module;
		$data['username'] = $this->_get_sess_username();
		$data['fullname'] = $this->_get_sess_fullname();
		$data['address'] = $this->_get_sess_address();
		$data['phone'] = $this->_get_sess_phone();
		$data['email'] = $this->_get_sess_email();
		$data['countCart'] = $this->session->userdata('carts');
		$this->load->view('partials/header_view', $data);
		
		if ($this->_module != 'cart') {
            $this->_load_banner();
        }
	}

	protected function _load_banner()
	{
		$this->load->view('partials/banner_view');
	}

	protected function _load_menu_right()
	{
		$this->load->model('Menu_model');
        $allBrand = $this->Menu_model->getAllBrand_model();

        $typeWoman = $this->Menu_model->getAllTypeWoman_model();
        $typeMan = $this->Menu_model->getAllTypeMan_model();
  //       $allPbbook = $this->Menu_model->get_all_pb_book();
        $data = array();
        $data['brand'] = $allBrand;
        $data['typeWoman'] = $typeWoman;
        $data['typeMan'] = $typeMan;
        // $data['pubish'] = $allPbbook;
		$this->load->view('partials/menu_right_view', $data);
	}

	protected function _load_footer()
	{
		$this->load->view('partials/footer_view');
	}

	protected function _get_sess_username()
	{
		$username = $this->session->userdata('username');
		$username = (!empty($username))? $username : '';
		return $username;
	}

	protected function _get_sess_fullname()
	{
		$fullname = $this->session->userdata('name');
		$fullname = (!empty($fullname))? $fullname : '';
		return $fullname;
	}

	protected function _get_sess_address()
	{
		$address = $this->session->userdata('address');
		$address = (!empty($address))? $address : '';
		return $address;
	}

	protected function _get_sess_email()
	{
		$email = $this->session->userdata('email');
		$email = (!empty($email))? $email : '';
		return $email;
	}

	protected function _get_sess_phone()
	{
		$phone = $this->session->userdata('phone');
		$phone = (!empty($phone))? $phone : '';
		return $phone;
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */