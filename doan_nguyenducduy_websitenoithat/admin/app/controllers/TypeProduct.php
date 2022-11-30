<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TypeProduct extends MY_Controller
{
    public function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();
        $this->__check_login_user();
        $this->load->model('TypeProduct_model');
        $this->load->library('pagination');
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
        $dataInfo = $this->TypeProduct_model->get_all_data();
        $config['base_url'] = base_url().'typeproduct/index';
        $config['total_rows'] = count($dataInfo);
        $config['per_page'] = 3; // limit
        $config['use_page_numbers'] = TRUE;
        $config['use_global_url_suffix'] = TRUE;

        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';

        $config["first_link"] = "&laquo;";
        $config["first_tag_open"] = "<li>";
        $config["first_tag_close"] = "</li>";

        $config["last_link"] = "&raquo;";
        $config["last_tag_open"] = "<li>";
        $config["last_tag_close"] = "</li>";

        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';

        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        // tim start
        $start = $this->uri->segment(3);
        $start = (!isset($start))? 1 : $start;
        // echo $start; die();
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();

        //load data by page
        $data['info'] = $this->TypeProduct_model->getDataTypeProductByPage($start, $config['per_page']);

        $header = array();
        $header['title'] = "Type Product";
        $header['content'] = 'This is Type Product';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('typeproduct/index_view', $data);

        // load footer
        $this->_load_footer();
    }


    // search
    public function search()
    {
        $data = array();
        $keyword = ($this->input->post("txtSearch"))? $this->input->post("txtSearch") : "";
        $keyword = ($this->uri->segment(3)) ? $this->uri->segment(3) : $keyword;
        $keyword = $this->security->xss_clean($keyword);

        $dataInfo = $this->TypeProduct_model->get_all_data($keyword);
        $config['base_url'] = base_url()."typeproduct/search/".$keyword;

        $config['total_rows'] = count($dataInfo);
        $config['per_page'] = 2; // limit
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);
        $config['use_page_numbers'] = TRUE;
        $config['use_global_url_suffix'] = TRUE;

        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';

        $config["first_link"] = "&laquo;";
        $config["first_tag_open"] = "<li>";
        $config["first_tag_close"] = "</li>";

        $config["last_link"] = "&raquo;";
        $config["last_tag_open"] = "<li>";
        $config["last_tag_close"] = "</li>";

        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';

        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $start = $this->uri->segment(4);
        $start = (!isset($start)) ? 1 : $start;
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();
        $data['info'] = $this->TypeProduct_model->getDataTypeProductByPage($start, $config['per_page'], $keyword);



        $header = array();
        $header['title'] = "Type Product";
        $header['content'] = 'This is Type Product';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('typeproduct/index_view', $data);

        // load footer
        $this->_load_footer();
    }


    // delete
    function delete()
    {
        $data = array();
        $id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);
        $id = is_numeric($id)?$id:0;

        $dataById = $this->TypeProduct_model->getInfoDataTypeProduct_model($id);
        if (empty($dataById)) {
            $this->session->set_flashdata('warning', 'Không tồn tại dữ liệu');
            $this->index();
        }
        else
        {
            $delete =  $this->TypeProduct_model->deleteTypeProduct_model($id);
            if ($delete) {
                $this->session->set_flashdata('success', 'Xóa thành công');
                redirect(site_url('typeproduct/index'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Xóa thất bại');
                redirect(site_url('typeproduct/index'));
            }
        }
    }
    // end delete


    // add
    public function add()
    {
        $data = array();
        $header = array();
        $header['title'] = "Add Brand";
        $header['content'] = 'Add Brand';

        $this->_load_header($header);

        $this->_load_aside();

        $this->load->view('typeproduct/addTypeProduct_view', $data);
        if (isset($_SESSION['error']))
        {
            unset($_SESSION['error']);
        }
        $this->_load_footer();

        if ($this->input->post()){
            $name = $this->input->post('txtNameType', TRUE);
            $name = $this->security->xss_clean($name);

            $gioitinh = $this->input->post('slcGT', TRUE);
            $gioitinh = $this->security->xss_clean($gioitinh);
            $gioitinh = (is_numeric($gioitinh) && in_array($gioitinh,array('1','0'))) ? $gioitinh : "";
            $flag = true;
            $check = $this->validate_data($name);
            foreach ($check as $key => $value){
                if (!empty($value)){
                    $flag = false;
                    break;
                }
            }

            if ($flag)
            {
                $checkName = $this->TypeProduct_model->checkNameTypeProduct_model($name);
                if ($checkName)
                {
                    $add = $this->TypeProduct_model->addTypeProduct_model($name, $gioitinh);
                    if ($add)
                    {
                        if (isset($_SESSION['error']))
                        {
                            unset($_SESSION['error']);
                        }
                        $this->session->set_flashdata('success', "Thêm thành công");
                        redirect('typeproduct/index');
                    }
                    else
                    {
                        if (isset($_SESSION['error']))
                        {
                            unset($_SESSION['error']);
                        }
                        $this->session->set_flashdata('err', 'Thêm thất bại');
                        redirect("typeproduct/add");
                    }
                }
                else
                {
                    if (isset($_SESSION['error']))
                    {
                        unset($_SESSION['error']);
                    }
                    $this->session->set_flashdata('warning', "Trùng tên loại đã có");
                    redirect("typeproduct/add");
                }
            }
            else
            {
                $this->session->set_flashdata('err', 'Dữ liệu nhập sai');
                $_SESSION['error'] = $check;
                redirect('typeproduct/add');
            }
        }
    }
    // end add

    // edit
    public function edit()
    {
        $id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);

        $data = array();
        $header = array();
        $header['title'] = "Edit Type Product";
        $header['content'] = 'Edit Type Product';


        $dataById = $this->TypeProduct_model->getInfoDataTypeProduct_model($id);
        if (empty($dataById))
        {
            $this->session->set_flashdata('warning', 'Không tồn tại dữ liệu');
            redirect('typeproduct/index');
        }
        else
        {
            $data['typeproduct'] = $dataById;
            $this->_load_header($header);

            $this->_load_aside();

            $this->load->view('typeproduct/editTypeProduct_view', $data);

            if (isset($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }

            $this->_load_footer();

            if ($this->input->post())
            {
                $nameType = $this->input->post('txtNameType', TRUE);
                $nameType = $this->security->xss_clean($nameType);

                $hddNameType = $this->input->post('txthddType', TRUE);
                $hddNameType = $this->security->xss_clean($hddNameType);

                $gioitinh = $this->input->post('slcGT', TRUE);
                $gioitinh = $this->security->xss_clean($gioitinh);
                $gioitinh = (is_numeric($gioitinh) && in_array($gioitinh,array('1','0'))) ? $gioitinh : "";

                $status = $this->input->post('slcStatus', TRUE);
                $status = $this->security->xss_clean($status);
                $status = (is_numeric($status) && in_array($status,array('1','0'))) ? $status : "";

                $flag = true;
                $check = $this->validate_data($nameType);
                foreach ($check as $key => $value)
                {
                    if (!empty($value))
                    {
                        $flag = false;
                        break;
                    }
                }

                if ($flag)
                {
                    $checkFlag = true;
                    if ($nameType !== $hddNameType){
                        $checkFlag = $this->TypeProduct_model->checkNameTypeProduct_model($nameType);
                    }
                    if ($checkFlag)
                    {
                        $edit = $this->TypeProduct_model->updateInfoTypeProduct_model($id, $nameType,$gioitinh, $status);
                        if ($edit)
                        {
                            if (isset($_SESSION['error']))
                            {
                                unset($_SESSION['error']);
                            }
                            $this->session->set_flashdata('success', "Sửa thành công");
                            redirect('typeproduct/index');
                        }
                        else
                        {
                            if (isset($_SESSION['error']))
                            {
                                unset($_SESSION['error']);
                            }
                            $this->session->set_flashdata('err', "Sửa thất bại");
                            redirect(site_url('typeproduct/edit').'?id='.$id);
                        }
                    }
                    else
                    {
                        if (isset($_SESSION['error']))
                        {
                            unset($_SESSION['error']);
                        }
                        $this->session->set_flashdata('warning', "Tên loại đã tồn tại");
                        redirect(site_url('typeproduct/edit').'?id='.$id);
                    }

                } else
                {

                    $this->session->set_flashdata('err', 'Dữ liệu nhập sai');
                    $_SESSION['error'] = $check;
                    redirect(site_url('typeproduct/edit').'?id='.$id);
                }

            }
        }
    }
    // end edit

    // validate data
    public function validate_data($name)
    {
        $error = array();
        $error['name'] = (empty($name) OR strlen($name) < 3) ? "Tên loại sản phẩm còn trống hoặc phải lớn hơn 3 kí tự" : "";
        return $error;
    }
    // end validate
}