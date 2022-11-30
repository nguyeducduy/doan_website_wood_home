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
        $data['address'] = $this->_get_sess_address();
        $data['phone'] = $this->_get_sess_phone();
        $data['email'] = $this->_get_sess_email();
        $this->load->view('partials/header_view', $data);


    }

    protected function _load_aside()
    {
        $data = array();
        $data['module'] = $this->_module;
        $this->load->view('partials/aside_view',$data);
    }


    protected function _load_footer()
    {
        $this->load->view('partials/footer_view');
    }

    protected function _get_sess_username()
    {
        $username = $this->session->userdata('admusername');
        $username = (!empty($username))? $username : '';
        return $username;
    }

    protected function _get_sess_address()
    {
        $address = $this->session->userdata('admaddress');
        $address = (!empty($address))? $address : '';
        return $address;
    }

    protected function _get_sess_email()
    {
        $email = $this->session->userdata('admemail');
        $email = (!empty($email))? $email : '';
        return $email;
    }

    protected function _get_sess_phone()
    {
        $phone = $this->session->userdata('admphone');
        $phone = (!empty($phone))? $phone : '';
        return $phone;
    }

    protected function _check_login()
    {
        $username = $this->_get_sess_username();
        $email = $this->_get_sess_email();
        if (empty($username) OR empty($email))
        {
            return FALSE;
        }
        return TRUE;
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */