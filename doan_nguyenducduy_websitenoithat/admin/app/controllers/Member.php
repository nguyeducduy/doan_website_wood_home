<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct()
    {
        $this->_module = trim(strtolower(__CLASS__));
        parent::__construct();
        $this->__check_login_user();
        $this->load->model('Member_model');
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
        $dataInfo = $this->Member_model->get_all_data();
        $config['base_url'] = base_url().'member/index';
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
        $data['info'] = $this->Member_model->getDataMemberByPage($start, $config['per_page']);

        $header = array();
        $header['title'] = "Member";
        $header['content'] = 'This is Member';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('member/index_view', $data);

        // load footer
        $this->_load_footer();
    }

    public function search()
    {
    	$data = array();
        $keyword = ($this->input->post("txtSearch"))? $this->input->post("txtSearch") : "";
        $keyword = ($this->uri->segment(3)) ? $this->uri->segment(3) : $keyword;
        $keyword = $this->security->xss_clean($keyword);

        $dataInfo = $this->Member_model->get_all_data($keyword);
        $config['base_url'] = base_url()."member/search/".$keyword;

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
        $data['info'] = $this->Member_model->getDataMemberByPage($start, $config['per_page'], $keyword);



        $header = array();
        $header['title'] = "Member";
        $header['content'] = 'This is Member';

        // load header
        $this->_load_header($header);

        // load aside
        $this->_load_aside();

        // load content
        $this->load->view('member/index_view', $data);

        // load footer
        $this->_load_footer();
    }

    //delete
    public function delete()
    {
    	$data = array();
        $id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);
        $id = is_numeric($id)?$id:0;

        $dataById = $this->Member_model->getInfoDataMember_model($id);
        if (empty($dataById)) {
            $this->session->set_flashdata('warning', 'Không tồn tại dữ liệu');
            $this->index();
        }
        else
        {
            $delete =  $this->Member_model->deleteMember_model($id);
            if ($delete) {
                $this->session->set_flashdata('success', 'Xóa thành công');
                redirect(site_url('member/index'));
            }
            else
            {
                $this->session->set_flashdata('error', 'Xóa thất bại');
                redirect(site_url('member/index'));
            }
        }
    }
    // end delete

    //edit
    public function edit()
    {
    	$id = $this->input->get('id', TRUE);
        $id = $this->security->xss_clean($id);

        $data = array();
        $header = array();
        $header['title'] = "Edit Member";
        $header['content'] = 'Edit Member';
        $dataById = $this->Member_model->getInfoDataMember_model($id);
        if (empty($dataById))
        {
            $this->session->set_flashdata('warning', 'Không tồn tại dữ liệu');
            redirect('member/index');
        }
        else
        {
        	$data['typeproduct'] = $dataById;
            $this->_load_header($header);

            $this->_load_aside();

            $this->load->view('member/editMember_view', $data);

            if (isset($_SESSION['error']))
            {
                unset($_SESSION['error']);
            }

            $this->_load_footer();
            if ($this->input->post()) 
            {
            	$status = $this->input->post('slcStatus', TRUE);
                $status = $this->security->xss_clean($status);
                $status = (is_numeric($status) && in_array($status,array('1','0'))) ? $status : "";
                $edit = $this->Member_model->updateInfoMember_model($id, $status);
                if ($edit)
                {
                    if (isset($_SESSION['error']))
                    {
                        unset($_SESSION['error']);
                    }
                    $this->session->set_flashdata('success', "Sửa thành công");
                    redirect('member/index');
                }
                else
                {
                    if (isset($_SESSION['error']))
                    {
                        unset($_SESSION['error']);
                    }
                    $this->session->set_flashdata('err', "Sửa thất bại");
                    redirect(site_url('member/edit').'?id='.$id);
                }
            }
        }
    }

}

/* End of file Member.php */
/* Location: .//C/xampp/htdocs/fashion/admin/app/controllers/Member.php */