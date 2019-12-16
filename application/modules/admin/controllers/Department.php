<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Pagination');
	}
	

	public function index()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->load->view('admin/department/department_list');
		//$this->load->view('admin/footer');
	}

	public function department_list()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$_SESSION['search'] = "";
		$this->load->model('Department_model');

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
		$total_records = $this->Department_model->record_departmentcount($search_text);
		//echo $total_records;
		//exit;
		if ($total_records > 0) 
        {
		
            $params["department_data"] = $this->Department_model->getdepartment($limit_per_page, $start_index, $search_text);
            // print_r( $params["department_data"]);
            // exit;
            $config['base_url'] = base_url() . 'admin/Department/department_list';
			
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
			$params['search'] = $search_text;
        }
        //exit;
        $this->load->view('admin/nav',$params);
		$this->load->view('admin/department/department_list',$params);
	 	
	}

	public function adddepartment()
	{
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	 	$this->load->model('Department_model');
	 	$data['userdata'] = $this->Department_model->getalluser();
	 	$this->load->view('department/add_department',$data);
	 	$this->load->view('admin/footer');
	    	
	}

	public function insert_department()
	{
	    $this->load->model('Department_model');	
	   
  		$id =$this->input->post('dept_id');	
	    $data['department_name']=$this->input->post('department_name');
	    $visible = implode(",", $this->input->post('visible_for'));
	    $data['visible_for']=$visible;
	    $this->Department_model->insert_department($data);
	    //exit;
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Department Has Been Inserted Successfully');
		redirect('admin/department/department_list' ,'refresh');
		$this->load->view('admin/footer');
	}
	
	public function editdepartment()
	{
	    $this->load->model('Department_model');
	    $id=$this->uri->segment('4');
	    $data['department_data']=$this->Department_model->geteditdepartment($id);
	    $data['userdata'] = $this->Department_model->getalluser();
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/department/edit_department',$data);
	    $this->load->view('admin/footer');
	}
	
	public function update_department()
	{
		
		$this->load->model('Department_model');
		$id =$this->input->post('dept_id');	
		$data['department_name']=$this->input->post('department_name');
		$visible = implode(",", $this->input->post('visible_for'));
	    $data['visible_for']=$visible;
        $this->Department_model->update_department($data,$id);
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Department Has Been Updated Successfully');
		redirect('admin/department/department_list' ,'refresh');
	    $this->load->view('admin/footer');
	}

	public function delete_department()
	{	
		$id = $_POST['list_id'];
	    $this->db->where('dept_id', $id);
        $this->db->delete('department');
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Department Has Been Deleted Successfully');
        redirect('admin/department/department_list', 'refresh');
        $this->load->view('admin/footer');
	}

}