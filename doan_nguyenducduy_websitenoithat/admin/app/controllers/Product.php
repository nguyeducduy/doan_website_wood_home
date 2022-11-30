<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * summary
 */
class Product extends MY_Controller
{
    /**
     * summary
     */
    public function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();
        $this->__check_login_user();
        $this->load->model('Product_model');
        $this->load->model('Brand_model');
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
        $dataInfo = $this->Product_model->getAllData();
        $config['base_url'] = base_url().'product/index';
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
        $data['info'] = $this->Product_model->getDataProductByPage($start, $config['per_page']);

        $header = array();
        $header['title'] = "Product";
        $header['content'] = 'This is Product';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('product/index_view', $data);

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

        $dataInfo = $this->Product_model->getAllData($keyword);
        $config['base_url'] = base_url()."brands/search/".$keyword;

        $config['total_rows'] = count($dataInfo);
        $config['per_page'] = 3; // limit
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
        $data['info'] = $this->Product_model->getDataProductByPage($start, $config['per_page'], $keyword);



        $header = array();
        $header['title'] = "Product";
        $header['content'] = 'This is Product';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('product/index_view', $data);

        // load footer
        $this->_load_footer();
    }
// end search


    // delete
    public function delete()
    {
    	$data = array();
        $id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);
        $id = is_numeric($id)?$id:0;

        $dataById = $this->Product_model->getInfoDataProduct_model($id);
        if (empty($dataById)) {
            $this->session->set_flashdata('warning', 'Không tồn tại dữ liệu');
            $this->index();
        }
        else
        {
            $delete =  $this->Product_model->deleteProduct_model($id);
            if ($delete) {
                $this->session->set_flashdata('success', 'Xóa thành công');
                redirect(site_url('product/index'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Xóa thất bại');
                redirect(site_url('product/index'));
            }
        }
    }
    // end delete


    //add
    public function add()
    {
    	$data = array();
        $header = array();
        $header['title'] = "Add Product";
        $header['content'] = 'Add Product';
        $data['brand'] = $this->Brand_model->get_all_data();
        $data['type'] = $this->TypeProduct_model->get_all_data();

        $this->_load_header($header);

        $this->_load_aside();

        $this->load->view('product/addProduct_view', $data);
        if (isset($_SESSION['error']))
        {
            unset($_SESSION['error']);
        }
        $this->_load_footer();

        if ($this->input->post()){
            $name = $this->input->post('txtNameProduct', TRUE);
            $name = $this->security->xss_clean($name);

            $type = $this->input->post('slcType', TRUE);
            $type = $this->security->xss_clean($type);
            $type = is_numeric($type) ? $type : '';

            $brand = $this->input->post('slcBrand', TRUE);
            $brand = $this->security->xss_clean($brand);
            $brand = is_numeric($brand) ? $brand : '';

            $gioitinh = $this->input->post('slcGT', TRUE);
            $gioitinh = $this->security->xss_clean($gioitinh);
            $gioitinh = (is_numeric($gioitinh) && in_array($gioitinh,array('1','0'))) ? $gioitinh : "";

            $cost = $this->input->post('txtGia', TRUE);
            $cost = $this->security->xss_clean($cost);
            $cost = is_numeric($cost) ? $cost : '';

            $qty = $this->input->post('txtQTY', TRUE);
            $qty = $this->security->xss_clean($qty);
            $qty = is_numeric($qty) ? $qty : '';

            $image = '';
            // upload image
            $config['upload_path']          = '../upload/imgProduct';
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
            $check = $this->validate_data($name, $cost, $qty, $image);
            foreach ($check as $key => $value){
                if (!empty($value)){
                    $flag = false;
                    break;
                }
            }

            if ($flag)
            {
                $checkName = $this->Product_model->checkNameProduct_model($name);
                if ($checkName)
                {
                    $add = $this->Product_model->addProduct_model($name, $type, $brand, $gioitinh, $cost, $qty, $image);
                    if ($add)
                    {
                        if (isset($_SESSION['error']))
                        {
                            unset($_SESSION['error']);
                        }
                        $this->session->set_flashdata('success', "Thêm thành công");
                        redirect('product/index');
                    }
                    else
                    {
                        if (isset($_SESSION['error']))
                        {
                            unset($_SESSION['error']);
                        }
                        $this->session->set_flashdata('err', 'Thêm thất bại');
                        redirect("product/add");
                    }
                }
                else
                {
                    if (isset($_SESSION['error']))
                    {
                        unset($_SESSION['error']);
                    }
                    $this->session->set_flashdata('warning', "Trùng tên sản phẩm");
                    redirect("product/add");
                }
            }
            else
            {
                $this->session->set_flashdata('err', 'Dữ liệu nhập sai');
                $_SESSION['error'] = $check;
                redirect('product/add');
            }
        }
    }
    // end add

    public function edit()
    {
    	$id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);

        $data = array();
        $header = array();
        $header['title'] = "Edit Product";
        $header['content'] = 'Edit Product';
        $data['brand'] = $this->Brand_model->get_all_data();
        $data['type'] = $this->TypeProduct_model->get_all_data();

        $dataById = $this->Product_model->getInfoDataProduct_model($id);

        if (empty($dataById))
        {
            $this->session->set_flashdata('warning', 'Không tồn tại dữ liệu');
            redirect('brands/index');
        }
        else
        {
            $data['product'] = $dataById;
            $this->_load_header($header);

            $this->_load_aside();

            $this->load->view('product/editProduct_view', $data);

            if (isset($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }

            $this->_load_footer();

            if ($this->input->post())
            {
                $nameProduct = $this->input->post('txtNameProduct', TRUE);
            	$nameProduct = $this->security->xss_clean($nameProduct);

                $hddNameProduct = $this->input->post('txthddProduct', TRUE);
                $hddNameProduct = $this->security->xss_clean($hddNameProduct);

                $type = $this->input->post('slcType', TRUE);
	            $type = $this->security->xss_clean($type);
	            $type = is_numeric($type) ? $type : '';

	            $brand = $this->input->post('slcBrand', TRUE);
	            $brand = $this->security->xss_clean($brand);
	            $brand = is_numeric($brand) ? $brand : '';

	            $gioitinh = $this->input->post('slcGT', TRUE);
	            $gioitinh = $this->security->xss_clean($gioitinh);
	            $gioitinh = (is_numeric($gioitinh) && in_array($gioitinh,array('1','0'))) ? $gioitinh : "";

	            $costOld = $this->input->post('txtGiaCu', TRUE);
	            $costOld = $this->security->xss_clean($costOld);
	            $costOld = is_numeric($costOld) ? $costOld : '';

	            $costNew = $this->input->post('txtGiaMoi', TRUE);
	            $costNew = $this->security->xss_clean($costNew);
	            $costNew = is_numeric($costNew) ? $costNew : '';

	            $qty = $this->input->post('txtQTY', TRUE);
	            $qty = $this->security->xss_clean($qty);
	            $qty = is_numeric($qty) ? $qty : '';

	            $view = $this->input->post('txtView', TRUE);
	            $view = $this->security->xss_clean($view);
	            $view = is_numeric($view) ? $view : '';

                $status = $this->input->post('slcStatus', TRUE);
                $status = $this->security->xss_clean($status);
                $status = (is_numeric($status) && in_array($status,array('1','0'))) ? $status : "";


                $image = '';
                $hddImg = $this->input->post('hddFile', TRUE);
                $hddImg = $this->security->xss_clean($hddImg);

                if ($hddImg !== $_FILES['txtFile']['name']){

                    $config['upload_path']          = '../upload/imgProduct';
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
                $check = $this->validate_data($nameProduct, $costOld, $qty, $hinhanh);
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
                    if ($nameProduct !== $hddNameProduct){
                        $checkFlag = $this->Product_model->checkNameProduct_model($nameProduct);
                    }
                    if ($checkFlag)
                    {
                        $edit = $this->Product_model->updateInfoProduct_model($id, $nameProduct, $type, $brand, $gioitinh, $costOld, $costNew, $qty, $view, $status, $hinhanh);
                        if ($edit)
                        {
                            if (isset($_SESSION['error']))
                            {
                                unset($_SESSION['error']);
                            }
                            $this->session->set_flashdata('success', "Sửa thành công");
                            redirect('product/index');
                        }
                        else
                        {
                            if (isset($_SESSION['error']))
                            {
                                unset($_SESSION['error']);
                            }
                            $this->session->set_flashdata('err', "Sửa thất bại");
                            redirect(site_url('product/edit').'?id='.$id);
                        }
                    }
                    else
                    {
                        if (isset($_SESSION['error']))
                        {
                            unset($_SESSION['error']);
                        }
                        $this->session->set_flashdata('warning', "Tên thương hiệu đã tồn tại");
                        redirect(site_url('product/edit').'?id='.$id);
                    }

                } else
                {

                    $this->session->set_flashdata('err', 'Dữ liệu nhập sai');
                    $_SESSION['error'] = $check;
                    redirect(site_url('product/edit').'?id='.$id);
                }

            }
        }
    }

    //validate
    public function validate_data($name, $cost, $qty, $image){
            $errors = array();
            $errors['name'] = (empty($name) OR strlen($name)<3)?"Tên sản phẩm còn trống hoặc phải lớn hơn 3 kí tự":"";
            $errors['cost'] = empty($cost)? "Vui lòng thêm giá sản phẩm":"";
            $errors['soluong'] = empty($qty)?"Vui lòng nhập số lượng":"";
            $errors['hinhanh'] = empty($image)?"Vui lòng nhập hình ảnh":"";
            return $errors;
        }
    // end validate
}
?>