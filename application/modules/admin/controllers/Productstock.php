<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productstock extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Pagination');
	}
	

	public function index()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->load->view('admin/Productstock/productstock_list');
		//$this->load->view('admin/footer');
	}

	public function productstock_list()
	{	
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
		$_SESSION['search'] = "";
		$this->load->model('Productstock_model');

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
		$total_records = $this->Productstock_model->record_productstockcount($search_text);
		
		if ($total_records > 0) 
        {
		
            $params["productstock_data"] = $this->Productstock_model->getproductstock($limit_per_page, $start_index, $search_text);
            
            $config['base_url'] = base_url() . 'admin/Productstock/productstock_list';
			
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 4;
             
            $this->pagination->initialize($config);
            $params["links"] = $this->pagination->create_links();
			$params['search'] = $search_text;
        }
        $params["product_data"] = $this->Productstock_model->getproduct();
	 	$params["department_data"] = $this->Productstock_model->getdepartment();

		$this->load->view('admin/Productstock/productstock_list',$params);
	 	//$this->load->view('admin/footer');  	
	}

	public function addproductstock()
	{
	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	 	$this->load->model('Productstock_model');
	 	$data["product_data"] = $this->Productstock_model->getproduct();
	 	$data["department_data"] = $this->Productstock_model->getdepartment();
	 	$this->load->view('productstock/add_productstock',$data);
	 	$this->load->view('admin/footer');
	}

	public function insert_productstock()
	{
	    $this->load->model('Productstock_model');

	   	$id =$this->input->post('id');
	   	$data['uid'] =$this->session->userdata['uid'];
	   	$data['product_id'] =$this->input->post('product_id');
  		$data['dept_id'] =$this->input->post('department_id');	
	    $data['quantity']=$this->input->post('quantity');
	    $data['create_date']=date('Y-m-d H:i:s');
	    
	    $this->Productstock_model->insert_productstock($data);

	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Productstock Has Been Inserted Successfully');
		redirect('admin/Productstock/productstock_list' ,'refresh');
		$this->load->view('admin/footer');
	}
	
	public function editproductstock()
	{
	    $this->load->model('Productstock_model');
	    $id=$this->uri->segment('4');
	    
	    $data["product_data"] = $this->Productstock_model->getproduct();
	 	$data["department_data"] = $this->Productstock_model->getdepartment();
	    $data['productstock_data']=$this->Productstock_model->geteditproductstock($id);

	    $this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/Productstock/edit_productstock',$data);
	    $this->load->view('admin/footer');
	}
	
	public function update_productstock()
	{
		
		$this->load->model('Productstock_model');
		$id =$this->input->post('id');
	   	$data['uid'] =$this->session->userdata['uid'];
	   	$data['product_id'] =$this->input->post('product_id');
  		$data['dept_id'] =$this->input->post('department_id');	
	    $data['quantity']=$this->input->post('quantity');
	    $data['updated_date']=date('Y-m-d H:i:s');
	    
        $this->Productstock_model->update_productstock($data,$id);
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Productstock Has Been Updated Successfully');
		redirect('admin/Productstock/productstock_list' ,'refresh');
	    $this->load->view('admin/footer');
	}

	public function delete_productstock()
	{	
		$id = $_POST['list_id'];
	    $this->db->where('id', $id);
        $this->db->delete('product_stock');
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Productstock Has Been Deleted Successfully');
        redirect('admin/Productstock/productstock_list', 'refresh');
        $this->load->view('admin/footer');
	}

	public function getproduct()
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by("product_id","asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getdepartment()
    {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->order_by("dept_id","asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function departmentproduct()
    {	
    	$this->load->model('Productstock_model');
	    $id=$this->uri->segment('4');
	    
	    $data['productstock_dept'] = $this->Productstock_model->geteditdepartmentproduct($id);
	    
		$this->load->view('admin/header');
		$this->load->view('admin/nav');
	    $this->load->view('admin/Productstock/edit_departmentproductstock',$data);
	    $this->load->view('admin/footer');
	}


	public function editdepartproductstock()
	{
		
		$this->load->model('Productstock_model');
		$id =$this->input->post('id');
	   	
	   	$data['product_id'] =$this->input->post('product_id');
  		$data['dept_id'] =$this->input->post('dept_id');	
	    $data['quantity']=$this->input->post('quantity');
	    $data['check_val']=$this->input->post('check_val');
	    $data['create_date']=date('Y-m-d H:i:s');
	    //print_r($data);
	    //exit;
        $this->Productstock_model->update_deptproductstock($data,$id,$data['dept_id']);
        $this->load->view('admin/header');
		$this->load->view('admin/nav');
		$this->session->set_flashdata('success', 'Productstock Has Been Updated Successfully');

		redirect('admin/Productstock/departmentproduct/'.$data['dept_id'].'' ,'refresh');
		//exit;
	    $this->load->view('admin/footer');
	}
}