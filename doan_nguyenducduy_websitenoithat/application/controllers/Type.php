<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends MY_Controller {

	public function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();
        $this->load->model('Type_model');
        $this->load->library('pagination');
    }

    public function index()
    {

        $id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);
        $id = is_numeric($id)?$id:0;

    	$data = array();
        $dataInfo = $this->Type_model->get_all_data($id);
        $config['base_url'] = base_url().'type/index';
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
        $data['info'] = $this->Type_model->getDataTypeByPage($start, $config['per_page'], $id);

        $header = array();
        $header['title'] = "Type";
        $header['content'] = 'This is Type';

        $this->_load_header($header);
        $this->load->view('type/index_view', $data);
        $this->_load_menu_right();
        $this->_load_footer();
    }

}

/* End of file Brand.php */
/* Location: ./application/controllers/Brand.php */