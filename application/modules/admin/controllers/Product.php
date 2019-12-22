<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Pagination');
	}
	

	public function index()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->load->view('admin/product/product_list');
		//$this->load->view('admin/footer');
	}

	public function product_list()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$_SESSION['search'] = "";
		$this->load->model('Product_model');

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
		$total_records = $this->Product_model->record_productcount($search_text);
		//echo $total_records;
		//exit;
		if ($total_records > 0) 
        {
		
            $params["product_data"] = $this->Product_model->getproduct($limit_per_page, $start_index, $search_text);
            
            $config['base_url'] = base_url() . 'admin/Product/product_list';
			
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
			$params['search'] = $search_text;
        }

		$this->load->view('admin/product/product_list',$params);
	 	//$this->load->view('admin/footer');  	
	}

	public function addproduct()
	{
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	 	$this->load->model('Product_model');
	 	$this->load->model('Department_model');
		$params["results"] = $this->Department_model->getdepartmentname();
	 	$this->load->view('product/add_product', $params);
	 	$this->load->view('admin/footer');
	}

	public function insert_product()
	{
	    $this->load->model('Product_model');	
	   
  		$id =$this->input->post('dept_id');	
	    $data['product_name']=$this->input->post('product_name');
	    $data['dept_id']=$this->input->post('dept_id');
	    
	    $this->Product_model->insert_product($data);

	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Product Has Been Inserted Successfully');
		redirect('admin/product/product_list' ,'refresh');
		$this->load->view('admin/footer');
	}
	
	public function editproduct()
	{
	    $this->load->model('Product_model');
	    
	    $id=$this->uri->segment('4');
	    $data['product_data']=$this->Product_model->geteditproduct($id);

	    //print_r($data['product_data']);
	    //exit;
	    $this->load->model('Department_model');
		$data["results"] = $this->Department_model->getdepartmentname();
	    
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/product/edit_product',$data);
	    $this->load->view('admin/footer');
	}
	
	public function update_product()
	{
		
		$this->load->model('Product_model');
		$id =$this->input->post('product_id');	
		$data['product_name']=$this->input->post('product_name');
	    $data['dept_id']=$this->input->post('dept_id');
        $this->Product_model->update_product($data,$id);
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Product Has Been Updated Successfully');
		redirect('admin/Product/Product_list' ,'refresh');
	    $this->load->view('admin/footer');
	}

	public function delete_product()
	{	
		$id = $_POST['list_id'];
	    $this->db->where('dept_id', $id);
        $this->db->delete('product');
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Product Has Been Deleted Successfully');
        redirect('admin/Product/product_list', 'refresh');
        $this->load->view('admin/footer');
	}

}