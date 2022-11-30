<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller {

	public function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__)); // cách lấy ra tên controller
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('myencryption');
		$this->load->model('signup_model');
		
	}

	public function index($mess=null)
	{
        $data = array();
        $data['fail'] = (isset($mess) && $mess == 'fail')? 'Dang ki that bai':'';
        $data['success'] = (isset($mess) && $mess == 'success')? 'Dang ki thanh cong vao mail de kich hoat tai khoan':'';
        $data['error'] = (isset($mess) && $mess == 'error')? 'Chua gui dc email':'';
        $this->load->view('signup/index_view', $data);
	}

	public function add()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('txtTenDangNhap', 'Ten Dang Nhap', 'trim|required|min_length[3]|is_unique[member.TenDangNhap]');
			$this->form_validation->set_rules('txtMatKhau', 'Mat Khau', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required|valid_email|is_unique[member.Email]');
			$this->form_validation->set_rules('txtHoTen', 'Ho ten', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('txtAddress', 'Dia chi', 'trim|required|min_length[2]');
			$this->form_validation->set_rules('txtPhone', 'So dien thoai', 'callback_phone_check');
			if ($this->form_validation->run() == FALSE)
            {
                $this->index();
            }
            else
            {
                $username = $this->input->post('txtTenDangNhap', TRUE);
                $username = $this->security->xss_clean($username);

                $password = $this->input->post('txtMatKhau', TRUE);
                $password = $this->security->xss_clean($password);

                $email = $this->input->post('txtEmail', TRUE);
                $email = $this->security->xss_clean($email);

                $name = $this->input->post('txtHoTen', TRUE);
                $name = $this->security->xss_clean($name);

                $address = $this->input->post('txtAddress', TRUE);
                $address = $this->security->xss_clean($address);

                $phone = $this->input->post('txtPhone', TRUE);
                $phone = $this->security->xss_clean($phone);

                $authen_key = $this->myencryption->encode(date('Y-m-d H:i:s', strtotime('+3days')));
                $data = array(
                	'TenDangNhap' => $username,
                	'MatKhau' => md5($password),
                	'TenHienThi'=> $name,
                	'DiaChi' => $address,
                	'SDT' => $phone,
                	'Email'=> $email,
                	'TrangThai'=> 0,
                	'authen_key'=> $authen_key,
                	'created_time'=> date('Y-m-d H:i:s'),
                	'updated_time' => ''
                );

                $idUser = $this->signup_model->add_user($data);
                if ($idUser>0) 
                {
                	$idUserEncode = $this->myencryption->encode($idUser);

                	$message = "<a href='".base_url().'signup/active/'.$authen_key.'/'.$idUserEncode."'>Nhấp vào đây</a> để kích hoạt";
                	$message .= '<p>Chú ý link này chỉ tồn tại trong 3 ngày</p>';

                    if (sendMail($email, $message)) 
                    {
                        redirect(site_url('signup/index/success'));
                    } else 
                    {
                        redirect(site_url('signup/index/error'));
                    }
                } else 
                {
                	redirect(site_url('signup/index/fail'));
                }
            }
		}
	}

	public function phone_check($phone)
	{
		$check = preg_match('/^[0][9]\d{8}$|^[0][1]\d{9}$/', $phone);
		if (!$check) {
			$this->form_validation->set_message('phone_check', '{field} khong hop le');
             return FALSE;
		}else {
			return TRUE;
		}
	}

    public function active($authen_key=null, $idUser=null)
    {
        $authen_key = isset($authen_key)?trim($authen_key):'';
        $idUser = isset($idUser)?trim($idUser):'';

        $id_decode = $this->myencryption->decode($idUser);
        $id_decode = is_numeric($id_decode)?$id_decode:'';
        $check = $this->signup_model->get_info_user($id_decode);
        if (!empty($check)) 
        {
            if ($authen_key = $check['authen_key']) 
            {
                $today = date('Y-m-d H:i:s');
                $au = $this->myencryption->decode($authen_key);
                if (strtotime($today)>strtotime($au)) 
                {
                    $data['over'] = 'Mã hết hạn';
                } else 
                {
                    if($check['TrangThai']!=1)
                    {
                        $active = $this->signup_model->active_account_member_model($id_decode);
                        if ($active) 
                        {
                            $data['success'] = 'Kích hoạt tài khoản thành công';
                        } else 
                        {
                            $data['fail'] = 'Kích hoạt tài khoản không thành công';
                        }
                    }else 
                    {
                        $data['succed'] = 'Tài khoản đã được kích hoạt';
                    }
                }
            } 
            else 
            {
                $data['err'] = 'Mã kích hoạt không hợp lệ';
            }
        }
        else {
            $data['err'] = 'Mã kích hoạt không hợp lệ';
        }
        $this->load->view('signup/active_view', $data);
    }
}

/* End of file Signup.php */
/* Location: ./application/controllers/Signup.php */