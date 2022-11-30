<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailOrder extends MY_Controller {

	public function __construct()
	{
		$this->_module = trim(strtolower(__CLASS__));
		parent::__construct();
		$this->__check_login_user();
		$this->load->model('detailorder_model');
		$this->load->model('orders_model');
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
        $dataInfo = $this->detailorder_model->getAllData();
        $config['base_url'] = base_url().'detailorder/index';
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
        $data['info'] = $this->detailorder_model->getDataDetailOrderByPage($start, $config['per_page']);

        $header = array();
        $header['title'] = "Deatail Order";
        $header['content'] = 'This is Deatail Order';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('detailorder/index_view', $data);

        // load footer
        $this->_load_footer();
	}


	public function search()
	{
		$data = array();
        $keyword = ($this->input->post("txtSearch"))? $this->input->post("txtSearch") : "";
        $keyword = ($this->uri->segment(3)) ? $this->uri->segment(3) : $keyword;
        $keyword = $this->security->xss_clean($keyword);

        $dataInfo = $this->detailorder_model->getAllData($keyword);
        $config['base_url'] = base_url()."detailorder/search/".$keyword;

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
        $data['info'] = $this->detailorder_model->getDataDetailOrderByPage($start, $config['per_page'], $keyword);



        $header = array();
        $header['title'] = "Type DetailOrder";
        $header['content'] = 'This is DetailOrder';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('detailorder/index_view', $data);

        // load footer
        $this->_load_footer();
	}

	public function delete()
	{
		$data = array();
        $id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);
        $id = is_numeric($id)?$id:0;
        $dataInfo = $this->detailorder_model->getDataInfoDetailOrder_model($id);
        foreach ($dataInfo as $key => $value) {
			$idOrder = $value['id_donhang'];
		}
        if (empty($dataInfo)) 
        {
        	$this->session->set_flashdata('warning', 'Không tồn tại dữ liệu');
            redirect(site_url('detailorder/index'));
        }else 
        {
        	// xoa hoa don trc
        	$deleteDH = $this->orders_model->deleteOrders_model($idOrder);
        	if ($deleteDH) 
        	{
        		// xoa ctdh
        		$delete = $this->detailorder_model->deleteDataDetailOrder_model($id);

        		if ($delete) {
	                $this->session->set_flashdata('success', 'Xóa thành công');
	                redirect(site_url('detailorder/index'));
	            }
	            else
	            {
	                $this->session->set_flashdata('error', 'Xóa thất bại');
	                redirect(site_url('detailorder/index'));
	            }

        	} else {
        		$this->session->set_flashdata('error', 'Xóa thất bại');
                redirect(site_url('detailorder/index'));
        	}
        }
	}

	public function export()
	{
		$data = array();
        $id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);
        $id = is_numeric($id)?$id:0;
        $OrderInfo = $this->detailorder_model->getDataInfoDetailOrder_model($id);

        $data['Order'] = $OrderInfo;
        $header = array();
        $header['title'] = "Xuất hóa đơn";
        $header['content'] = 'Chi tiết hóa đơn';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('detailorder/export_view', $data);

        // load footer
        $this->_load_footer();
	}

}

/* End of file DetailOrder.php */
/* Location: .//C/xampp/htdocs/fashion/admin/app/controllers/DetailOrder.php */