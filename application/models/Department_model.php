<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Department_model extends CI_Model
 {
	 function __construct()
    {
      
        parent::__construct();
    }

    public function record_departmentcount() {
       $count = $this->db->count_all("department");
       return $count;
    } 

    public function getdepartmentname()
    {
        $this->db->select('dt.*');
        $this->db->from('department as dt');
        //$this->db->join('user_master as um',"um.uid = ". explode(', ', 'dt.visible_for') ." ");
        $this->db->order_by("dt.dept_id","asc");
        
        $query = $this->db->get()->result();
        // echo $this->db->last_query();
        return $query;
        //exit;
        // if ($query->num_rows() > 0) 
        //     {
        //         foreach ($query->result() as $row) 
        //         {
        //             $data[] = $row;
        //         }
                 
        //         return $data;
        //     }
     
        // return false;
    }

    public function getalluser()
    {
        $this->db->select('*');
        $this->db->order_by("uid","asc");
        $this->db->from('user_master');
        $query = $this->db->get();
        if ($query->num_rows() > 0) 
            {
                foreach ($query->result() as $row) 
                {
                    $data[] = $row;
                }
                 
                return $data;
            }
     
        return false;
    }

    public function getdepartment($limit, $start, $search)
    {
        
        $this->db->select('*');
        if($search != ''){
          $this->db->like('department_name', $search);
        }
         $this->db->order_by("dept_id","asc");
        $this->db->limit($limit, $start);
        $this->db->from('department');
        $query = $this->db->get();

        //echo $this->db->last_query();
        //exit;
        if ($query->num_rows() > 0) 
            {
                foreach ($query->result() as $row) 
                {
                    $data[] = $row;
                }
                 
                return $data;
            }
     
        return false;
    }

    
    public function insert_department($data)
    {
        if(!empty($data))
        {
            $this->db->insert('department',$data);
        }
    }

    public function geteditdepartment($cid)
    {
       // print_r($data);
        $this->db->select('*'); 
        $this->db->where('dept_id',$cid);
        $this->db->from('department');  
        $query = $this->db->get();
        return $query->result();
    }
    public function update_department($data,$cid)
    {   
        $this->db->where('dept_id',$cid);
        $this->db->update('department',$data);
    }
}