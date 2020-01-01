<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Pagination');
	}
	

	// public function index()
	// {	
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/nav');
	// 	$this->load->view('admin/Request/request_list');
	// 	//$this->load->view('admin/footer');
	// }

	public function request_list()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$_SESSION['search'] = "";
		$this->load->model('Request_model');

		$search_text = "";
    	if($this->input->post('submit') != NULL ){
	      	$search_text = $this->input->post('search');
			$this->session->set_userdata(array("search"=>$search_text));
			}else{
	      	if($this->session->userdata('search') != NULL){
	        	$search_text = $this->session->userdata('search');
        	}
        }
		$params = array();
        $limit_per_page = 10;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$total_records = $this->Request_model->record_requestcount($search_text);
		//echo $total_records;
		//exit;
		if ($total_records > 0) 
        {
		
            $params["request_data"] = $this->Request_model->getrequest($limit_per_page, $start_index, $search_text);
            
            $config['base_url'] = base_url() . 'admin/Request/request_list';
			
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
			$params['search'] = $search_text;
        }

		$this->load->view('admin/Request/request_list',$params);
	 	//$this->load->view('admin/footer');  	
	}


	public function adminrequest_list()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$_SESSION['search'] = "";
		$this->load->model('Request_model');

		$search_text = "";
    	if($this->input->post('submit') != NULL ){
	      	$search_text = $this->input->post('search');
			$this->session->set_userdata(array("search"=>$search_text));
			}else{
	      	if($this->session->userdata('search') != NULL){
	        	$search_text = $this->session->userdata('search');
        	}
        }
		$params = array();
        $limit_per_page = 10;
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$total_records = $this->Request_model->record_adminrequestcount($search_text);
		//echo $total_records;
		//exit;
		if ($total_records > 0) 
        {
		
            $params["adminrequest_data"] = $this->Request_model->getadminrequest($limit_per_page, $start_index, $search_text);
            
            $config['base_url'] = base_url() . 'admin/Request/adminrequest_list';
			
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
			$params['search'] = $search_text;
        }

		$this->load->view('admin/Request/adminrequest_list',$params);
	 	//$this->load->view('admin/footer');  	
	}

	public function updateproductqunatity($id)
	{	
		// echo $id;
		// exit;
		$this->db->set('check_val',0);
		$this->db->where('id',$id);
		$this->db->update('product_stock');
		$this->session->set_flashdata('success', 'Product Quantity Has Been Updated Successfully!');
        redirect('admin/Request/adminrequest_list', 'refresh');
	}
}