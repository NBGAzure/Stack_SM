<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    function __construct() { 
        parent::__construct();
    }
        
    public function index()
    {  
		$this->load->view('admin/header');
        $this->load->view('admin/nav');
        $this->load->view('dashboard');
        $this->load->view('admin/footer');
    }

    public function admin_profile()
    {  
        $this->load->view('admin/header');
        $this->load->view('admin/nav');
        $this->load->view('profile');
        $this->load->view('admin/footer');
        $this->load->model('register_model');
    }
    
    public function logout()
    {
		$data = ['username', 'password'];
		$this->session->unset_userdata($data);
 
        redirect('admin/Login');
    }
}
?>
    