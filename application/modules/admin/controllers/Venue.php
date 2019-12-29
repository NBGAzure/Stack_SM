<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venue extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Pagination');
	}
	

	public function index()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->load->view('admin/venue/venuecategory_list');
		$this->load->view('admin/footer');
	}

	public function venuecategory_list()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$_SESSION['search'] = "";
		$this->load->model('Venuecategory_model');
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
		$total_records = $this->Venuecategory_model->record_venuecategorycount($search_text);
		
		if ($total_records > 0) 
        {
		
            $params["venuecat_data"] = $this->Venuecategory_model->getvenuecategory($limit_per_page, $start_index, $search_text);
             
            $config['base_url'] = base_url() . 'admin/Venue/venuecategory_list';
			
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
			$params['search'] = $search_text;
        }

		//$data['category_data']= $this->Category_model->getcategory(); 
		
		$this->load->view('admin/venue/venuecategory_list',$params);
	 	$this->load->view('admin/footer');  	
	}

	public function addvenuecategory()
	{
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	 	$this->load->model('Venuecategory_model');
	 	
	 	$this->load->view('venue/add_venuecategory');
	 	$this->load->view('admin/footer');
	    	
	}

	public function insert_venuecategory()
	{
	    $this->load->model('Venuecategory_model');	
	    
  		$id =$this->input->post('cat_id');	
	    $data['cat_name']=$this->input->post('venuecategory');
	    $data['cat_parent']='0'; 
	    
	    $this->Venuecategory_model->insert_venuecategory($data);
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
		redirect('admin/venue/venuecategory_list' ,'refresh');
		$this->load->view('admin/footer');
	}
	
	public function editvenuecategory()
	{
	    $this->load->model('Venuecategory_model');
	    $id=$this->uri->segment('4');
	    $data['venuecat_data']=$this->Venuecategory_model->geteditvenuecategory($id);
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/venue/edit_venuecategory',$data);
	    $this->load->view('admin/footer');
	}
	
	public function update_venuecategory()
	{
		
		$this->load->model('Venuecategory_model');
		$id =$this->input->post('cat_id');	

		$data['cat_name']=$this->input->post('venuecategory');
	    $data['cat_parent']=0; 

        $this->Venuecategory_model->update_venuecategory($data,$id);
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		redirect('admin/venue/venuecategory_list' ,'refresh');
	    $this->load->view('admin/footer');
	}

	public function delete_venuecategory()
	{	
		$id = $_POST['list_id'];
	    $this->db->where('cat_id', $id);
        $this->db->delete('venue_category');
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
        redirect('admin/venue/venuecategory_list', 'refresh');
        $this->load->view('admin/footer');
	}
}