<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Store_model extends CI_Model
 {
	 function __construct()
    {
      
        parent::__construct();
    }

    public function record_storecount() {
       $count = $this->db->count_all("store");
       return $count;
    } 

    public function getstorename()
    {
        $this->db->select('st.*');
        $this->db->from('store as st');
        //$this->db->join('user_master as um',"um.uid = ". explode(', ', 'dt.visible_for') ." ");
        $this->db->order_by("st.str_id","asc");
        
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

    public function getstore($limit, $start, $search)
    {
        
        $this->db->select('*');
        if($search != ''){
          $this->db->like('store_name', $search);
        }
         $this->db->order_by("str_id","asc");
        $this->db->limit($limit, $start);
        $this->db->from('store');
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

    
    public function insert_store($data)
    {
        if(!empty($data))
        {
            $this->db->insert('store',$data);
        }
    }

    public function geteditstore($cid)
    {
       // print_r($data);
        $this->db->select('*'); 
        $this->db->where('str_id',$cid);
        $this->db->from('store');  
        $query = $this->db->get();
        return $query->result();
    }
    public function update_store($data,$cid)
    {   
        $this->db->where('str_id',$cid);
        $this->db->update('store',$data);
    }
}