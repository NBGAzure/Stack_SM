<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Pagination');
	}
	

	public function index()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->load->view('admin/store/store_list');
		//$this->load->view('admin/footer');
	}

	public function store_list()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$_SESSION['search'] = "";
		$this->load->model('Store_model');

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
		$total_records = $this->Store_model->record_storecount($search_text);
		//echo $total_records;
		//exit;
		if ($total_records > 0) 
        {
		
            $params["store_data"] = $this->Store_model->getstore($limit_per_page, $start_index, $search_text);
            // print_r( $params["department_data"]);
            // exit;
            $config['base_url'] = base_url() . 'admin/Store/store_list';
			
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
			$params['search'] = $search_text;
        }
        //exit;
        $this->load->view('admin/nav',$params);
		$this->load->view('admin/store/store_list',$params);
	 	
	}

	public function addstore()
	{
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	 	$this->load->model('Store_model');
	 	$data['userdata'] = $this->Store_model->getalluser();
	 	$this->load->view('admin/store/add_store',$data);
	 	$this->load->view('admin/footer');
	    	
	}

	public function insert_store()
	{
	    $this->load->model('Store_model');	
	   
  		$id =$this->input->post('str_id');	
	    $data['store_name']=$this->input->post('store_name');
	    // $visible = implode(",", $this->input->post('visible_for'));
	    // $data['visible_for']=$visible;
	    $this->Store_model->insert_store($data);
	    //exit;
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Store Has Been Inserted Successfully');
		redirect('admin/store/store_list' ,'refresh');
		$this->load->view('admin/footer');
	}
	
	public function editstore()
	{
	    $this->load->model('Store_model');
	    $id=$this->uri->segment('4');
	    $data['store_data']=$this->Store_model->geteditstore($id);
	    $data['userdata'] = $this->Store_model->getalluser();
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/store/edit_store',$data);
	    $this->load->view('admin/footer');
	}
	
	public function update_store()
	{
		
		$this->load->model('Store_model');
		$id =$this->input->post('str_id');	
		$data['store_name']=$this->input->post('store_name');
		// $visible = implode(",", $this->input->post('visible_for'));
	 //    $data['visible_for']=$visible;
        $this->Store_model->update_store($data,$id);
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Store Has Been Updated Successfully');
		redirect('admin/store/store_list' ,'refresh');
	    $this->load->view('admin/footer');
	}

	public function delete_store()
	{	
		$id = $_POST['list_id'];
	    $this->db->where('str_id', $id);
        $this->db->delete('store');
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Store Has Been Deleted Successfully');
        redirect('admin/store/store_list', 'refresh');
        $this->load->view('admin/footer');
	}

}