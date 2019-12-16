<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
     function __construct() { 
        parent::__construct();

        $this->load->model("login_model", "login");
        if(!empty($_SESSION['username']))
    	redirect('admin/Login');
		
		$this->load->helper('cookie');
    }
 		
	public function index()
	{
		/* get user data from coockies */
		$_platform = explode("/",get_cookie('user_id'));
		
		$this->load->view('login',array("remember_user"=>$_platform));

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if($_POST) {
             
            // print_r($_POST);
            // exit;

            $result = $this->login->validate_user($_POST);  
		     // print_r($result);
             //exit;
            if(!empty($result)) {
                $data = [
                    'username' => $result->username,
					'uid' => $result->uid
                ];
                //print $data['user_role'];
				
				//;
				if($this->input->post('remember_me') == "1"){
					$val = array($_POST['username'],$_POST['password']);
					$coockie_value = implode("/",$val);

					$cookie = array(
					'name'   => 'user_id',
					'value'  => $coockie_value,
					'expire' => '15000000',
					'prefix' => ''
					);
					$this->input->set_cookie($cookie);
		
				}else{
					delete_cookie('user_id');
				}
 				
                $this->session->set_userdata($data);
				
				redirect('admin/Home');
				
				
            } else {
                $this->session->set_flashdata('flash_data', 'Username or password is wrong!');
                redirect('admin/login');
            }
        }
 
     }
	
	
	
	
}
