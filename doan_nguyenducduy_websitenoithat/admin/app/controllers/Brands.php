<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends MY_Controller{

    public function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();
        $this->__check_login_user();
        $this->load->model('Brand_model');
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
        $dataInfo = $this->Brand_model->get_all_data();
        $config['base_url'] = base_url().'brands/index';
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
        $data['info'] = $this->Brand_model->getDataBrandByPage($start, $config['per_page']);

        $header = array();
        $header['title'] = "Brand";
        $header['content'] = 'This is Brand';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('brand/index_view', $data);

        // load footer
        $this->_load_footer();
    }

    /**
     * @return object
     */
    public function search()
    {
        $data = array();
        $keyword = ($this->input->post("txtSearch"))? $this->input->post("txtSearch") : "";
        $keyword = ($this->uri->segment(3)) ? $this->uri->segment(3) : $keyword;
        $keyword = $this->security->xss_clean($keyword);

        $dataInfo = $this->Brand_model->get_all_data($keyword);
        $config['base_url'] = base_url()."brands/search/".$keyword;

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
        $data['info'] = $this->Brand_model->getDataBrandByPage($start, $config['per_page'], $keyword);



        $header = array();
        $header['title'] = "Brand";
        $header['content'] = 'This is Brand';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('brand/index_view', $data);

        // load footer
        $this->_load_footer();

    }


    // cach xoa 1:
//    public function delete1()
//    {
//        if ($this->input->is_ajax_request()) {
//            $id = $this->input->post('id', TRUE);
//            $id = $this->security->xss_clean($id);
//
//            $data = array();
//            $data['result'] = '';
//            if (!is_numeric($id))
//            {
//                $data['result'] = 'FAIL';
//            }else
//            {
//                $dataById = $this->Brand_model->getInfoDataBrand_model($id);
//                if (empty($dataById))
//                {
//                    $data['result'] = 'ERR';
//                }else
//                {
//                    $delete =  $this->Brand_model->deleteBrand_model($id);
//                    if ($delete)
//                    {
//                        $data['result'] = 'OK';
//                    }else
//                    {
//                        $data['result'] = 'ERR';
//                    }
//                }
//            }
//            echo json_encode($data);
//        }
//    }


    // cach xoa 2
    function delete()
    {
        $data = array();
        $id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);
        $id = is_numeric($id)?$id:0;

        $dataById = $this->Brand_model->getInfoDataBrand_model($id);
        if (empty($dataById)) {
            $this->session->set_flashdata('warning', 'Không tồn tại dữ liệu');
            $this->index();
        }
        else
        {
            $delete =  $this->Brand_model->deleteBrand_model($id);
            if ($delete) {
                $this->session->set_flashdata('success', 'Xóa thành công');
                redirect(site_url('brands/index'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Xóa thất bại');
                redirect(site_url('brands/index'));
            }
        }
    }

    /*
     * return void
     */
    function add()
    {
        $data = array();
        $header = array();
        $header['title'] = "Add Brand";
        $header['content'] = 'Add Brand';

        $this->_load_header($header);

        $this->_load_aside();

        $this->load->view('brand/addBrand_view', $data);
        if (isset($_SESSION['error']))
        {
            unset($_SESSION['error']);
        }
        $this->_load_footer();

        if ($this->input->post()){
            $name = $this->input->post('txtNameBrand', TRUE);
            $name = $this->security->xss_clean($name);
            $image = '';
            // upload image
            $config['upload_path']          = '../upload/imgBrand';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 20480;
            $config['max_width']            = 1366;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('txtFile')){
                $img = $this->upload->data();
                $image = $img['file_name'];
            }
            $flag = true;
            $check = $this->validate_data($name, $image);
            foreach ($check as $key => $value){
                if (!empty($value)){
                    $flag = false;
                    break;
                }
            }

            if ($flag)
            {
                $checkName = $this->Brand_model->checkNameBrand_model($name);
                if ($checkName)
                {
                    $add = $this->Brand_model->addBrand_model($name, $image);
                    if ($add)
                    {
                        if (isset($_SESSION['error']))
                        {
                            unset($_SESSION['error']);
                        }
                        $this->session->set_flashdata('success', "Thêm thành công");
                        redirect('brands/index');
                    }
                    else
                    {
                        if (isset($_SESSION['error']))
                        {
                            unset($_SESSION['error']);
                        }
                        $this->session->set_flashdata('err', 'Thêm thất bại');
                        redirect("brands/add");
                    }
                }
                else
                {
                    if (isset($_SESSION['error']))
                    {
                        unset($_SESSION['error']);
                    }
                    $this->session->set_flashdata('warning', "Trùng tên thương hiệu");
                    redirect("brands/add");
                }
            }
            else
            {
                $this->session->set_flashdata('err', 'Dữ liệu nhập sai');
                $_SESSION['error'] = $check;
                redirect('brands/add');
            }
        }
    }

    public function edit()
    {
        $id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);

        $data = array();
        $header = array();
        $header['title'] = "Edit Brand";
        $header['content'] = 'Edit Brand';


        $dataById = $this->Brand_model->getInfoDataBrand_model($id);

        if (empty($dataById))
        {
            $this->session->set_flashdata('warning', 'Không tồn tại dữ liệu');
            redirect('brands/index');
        }
        else
        {
            $data['brand'] = $dataById;
            $this->_load_header($header);

            $this->_load_aside();

            $this->load->view('brand/editBrand_view', $data);

            if (isset($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }

            $this->_load_footer();

            if ($this->input->post())
            {
                $nameBrand = $this->input->post('txtNameBrand', TRUE);
                $nameBrand = $this->security->xss_clean($nameBrand);

                $hddNameBrand = $this->input->post('txthddBrand', TRUE);
                $hddNameBrand = $this->security->xss_clean($hddNameBrand);

                $status = $this->input->post('slcStatus', TRUE);
                $status = $this->security->xss_clean($status);
                $status = (is_numeric($status) && in_array($status,array('1','0'))) ? $status : "";


                $image = '';
                $hddImg = $this->input->post('hddFile', TRUE);
                $hddImg = $this->security->xss_clean($hddImg);

                if ($hddImg !== $_FILES['txtFile']['name']){

                    $config['upload_path']          = '../upload/imgBrand';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 20480;
                    $config['max_width']            = 1366;
                    $config['max_height']           = 768;

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('txtFile')){
                        $img = $this->upload->data();
                        $image = $img['file_name'];
                    }
                }
                $hinhanh = (empty($image)) ? $hddImg : $image;
                $flag = true;
                $check = $this->validate_data($nameBrand, $hinhanh);
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
                    if ($nameBrand !== $hddNameBrand){
                        $checkFlag = $this->Brand_model->checkNameBrand_model($nameBrand);
                    }
                    if ($checkFlag)
                    {
                        $edit = $this->Brand_model->updateInfoBrand_model($id, $nameBrand,$status, $hinhanh);
                        if ($edit)
                        {
                            if (isset($_SESSION['error']))
                            {
                                unset($_SESSION['error']);
                            }
                            $this->session->set_flashdata('success', "Sửa thành công");
                            redirect('brands/index');
                        }
                        else
                        {
                            if (isset($_SESSION['error']))
                            {
                                unset($_SESSION['error']);
                            }
                            $this->session->set_flashdata('err', "Sửa thất bại");
                            redirect(site_url('brands/edit').'?id='.$id);
                        }
                    }
                    else
                    {
                        if (isset($_SESSION['error']))
                        {
                            unset($_SESSION['error']);
                        }
                        $this->session->set_flashdata('warning', "Tên thương hiệu đã tồn tại");
                        redirect(site_url('brands/edit').'?id='.$id);
                    }

                } else
                {

                    $this->session->set_flashdata('err', 'Dữ liệu nhập sai');
                    $_SESSION['error'] = $check;
                    redirect(site_url('brands/edit').'?id='.$id);
                }

            }
        }
    }

    /**
     * @param $name
     * @param $image
     * @return boolean
     */
    public function validate_data($name, $image)
    {
        $error = array();
        $error['name'] = (empty($name) OR strlen($name) < 3) ? "Tên thương hiệu còn trống hoặc phải lớn hơn 3 kí tự" : "";
        $error['image'] = empty($image) ? "Vui lòng thêm hình ảnh" : "";
        return $error;
    }

    private function log_error($value = array())
    {
        echo "<pre/>";
        print_r($value);
        die();
    }
}