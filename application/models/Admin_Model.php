<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin_Model extends CI_Model {

	    function __construct() {
        parent::__construct();
        $this->load->database();
		
    }

	function artist_count(){
		$this->db->select('count(Id) as cnt');
		$this->db->where('role_id','1');	
		$this->db->from('role_management');
		$query = $this->db->get();
	  	return $query->row()->cnt; 	
	}

	function host_count(){
		$this->db->select('count(Id) as cnt');
		$this->db->where('role_id','2');
		$this->db->from('role_management');
		$query = $this->db->get();
	  	return $query->row()->cnt; 	
	}
}