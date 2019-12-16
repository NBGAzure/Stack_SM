<?php   
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
class Errorlog_model extends CI_Model {  
	
	function __construct()
    {
      
        parent::__construct();
    }
	
	public function insert_response($data) {
		if(!empty($data))
        {
            $this->db->insert('errorlog',$data);
        }
   	}

}
 
 
