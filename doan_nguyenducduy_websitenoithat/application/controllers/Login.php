<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->load->view('login/index_view');
	}

	public function handle()
	{
		if ($this->input->is_ajax_request()) {
			$username = $this->input->post('user', TRUE);
			$username = $this->security->xss_clean($username);
			$password = $this->input->post('pass', TRUE);
			$password = $this->security->xss_clean($password);

			$data = array();
			$data['result'] = '';
			if (empty($username) OR empty($password)) {
				$data['result'] = 'FAIL';
			}else {
				$checkLogin = $this->login_model->check_user_login($username, md5($password));
				// $data['result'] = $checkLogin;
				if (!empty($checkLogin)) {
					// gan gia tri cho bien session
					$array = array(
						'username' => $checkLogin['TenDangNhap'],
						'name'=> $checkLogin['TenHienThi'],
						'address'=> $checkLogin['DiaChi'],
						'phone'=> $checkLogin['SDT'],
						'email'=> $checkLogin['Email'],
					);
					$this->session->set_userdata($array);
					$data['result'] = 'OK';

				} else {
					$data['result'] = 'ERR';
				}
			}
			echo json_encode($data);
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */