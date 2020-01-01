<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdfcon extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Pdf');
	}
	
	function index(){
	    $this->load->view('Login');
	}
}