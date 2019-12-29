<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Pagination');
	}
	

	public function index()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->load->view('admin/User/user_list');
		//$this->load->view('admin/footer');
	}

	public function user_list()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$_SESSION['search'] = "";
		$this->load->model('User_model');
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
		$total_records = $this->User_model->record_usercount($search_text);
		
		if ($total_records > 0) 
        {
		
            $params["user_data"] = $this->User_model->getuser($limit_per_page, $start_index, $search_text);
             
            $config['base_url'] = base_url() . 'admin/user/user_list';
			
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
			$params['search'] = $search_text;
        }

		//$data['category_data']= $this->Category_model->getcategory(); 
		
		$this->load->view('admin/user/user_list',$params);
	 	//$this->load->view('admin/footer');  	
	}

	public function adduser()
	{
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	 	$this->load->model('User_model');
	 	
	 	$this->load->view('user/add_user');
	 	$this->load->view('admin/footer');
	    	
	}

	public function insert_user()
	{
	    $this->load->model('User_model');	
	    
  		$id =$this->input->post('uid');	
	    $data['user_role']=$this->input->post('user_role');
	    $data['username']=$this->input->post('user_name');
	    $data['password']=md5($this->input->post('user_pass'));
	    
	    $this->User_model->insert_user($data);
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'User Has Been Inserted Successfully');
		redirect('admin/user/user_list' ,'refresh');
		//$this->load->view('admin/footer');
	}
	
	public function edituser()
	{
	    $this->load->model('User_model');
	    $id=$this->uri->segment('4');
	    $data['user_data']=$this->User_model->getedituser($id);
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/user/edit_user',$data);
	    $this->load->view('admin/footer');
	}
	
	public function update_user()
	{
		
		$this->load->model('User_model');
		$id =$this->input->post('uid');	

		$data['username']=$this->input->post('user_name');
	    $data['password']=md5($this->input->post('user_pass'));

        $this->User_model->update_user($data,$id);
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'User Has Been Updated Successfully');
		redirect('admin/user/user_list' ,'refresh');
	   // $this->load->view('admin/footer');
	}

	public function delete_user()
	{	
		$id = $_POST['list_id'];
	    $this->db->where('id', $id);
        $this->db->delete('user_master');
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'User Has Been Deleted Successfully');
        redirect('admin/user/user_list', 'refresh');
        //$this->load->view('admin/footer');
	}


	public function ajax_user_details()
	{	
		$this->load->model('User_model');
		//print_r($_POST);
		$user_id = $_POST['uid'];
		
		//echo $user_id;
		$params = array();
		$data = $this->User_model->user_details($user_id);
		
		echo json_encode($data);
		
	}
	
	

}