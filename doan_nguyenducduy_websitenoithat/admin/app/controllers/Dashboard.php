<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();
        $this->__check_login_user();
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
        $header = array();
        $header['title'] = 'Dashboard';
        $header['content'] = 'This is Dashboard';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        //load content
        $this->load->view('dashboard/index_view');

        // load footer
        $this->_load_footer();
    }

    public function upload()
    {
        if ($this->input->post()) {
            // print_r($_FILES['txtFile']); die();
            $config['upload_path']          = '../upload';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 20480;
            $config['max_width']            = 1366;
            $config['max_height']           = 768;
            // echo $_FILES['txtFile']; die();
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('txtFile'))
            {
                redirect(site_url('dashboard/index/fail'));
                $error = $this->upload->display_errors(); // xem loi upload
                 echo $error; die();
            }
            else
            {
                $data = $this->upload->data(); // tra ve thong cua file da upload thanh cong
                echo "<pre/>";
                print_r($data);
            }
        }
    }

}

/* End of file Dashboard.php */
/* Location: .//C/xampp/htdocs/Cime/admin/app/controllers/Dashboard.php */