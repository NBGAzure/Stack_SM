<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class User_model extends CI_Model
 {
     function __construct()
    {
      
        parent::__construct();
    }

    public function record_usercount()
    {
        $this->db->select('*');
        $this->db->where('user_role != ','superadmin');
        $query = $this->db->from('user_master')->get();
        //  echo $this->db->last_query();
        // exit;
        $count = $query->num_rows();
        //print $count;
        return $count;
    }

    public function getuser($limit, $start, $search)
    {
        
        $this->db->select('*');
        if($search != ''){
          $this->db->like('uid', $search);
          $this->db->or_like('username', $search);
        }
        $this->db->where('user_role != ','superadmin');
        $this->db->order_by("uid","asc");
        $this->db->limit($limit, $start);
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

    public function insert_user($data)
    {
        if(!empty($data))
        {
            $this->db->insert('user_master',$data);
        }
    }

    public function getedituser($rid)
    {
       // print_r($data);
        $this->db->select('*'); 
        $this->db->where('uid',$rid);
        $this->db->from('user_master');  
        $query = $this->db->get();
        return $query->result();
    }
    
    public function update_user($data,$rid)
    {
        $this->db->where('uid',$rid);
        $this->db->update('user_master',$data);
    }

    public function user_details($uid){
        //echo $uid;
        //$data = $this->db->get_where('product_stock',array('uid'=>$uid))->result_array();

        $this->db->select('um.*, ps.*, pro.*, dep.*');
        $this->db->from('product_stock as ps');
        $this->db->join('user_master as um', 'um.uid = ps.uid');
        $this->db->join('products as pro', 'pro.product_id = ps.product_id');
        $this->db->join('department as dep', 'dep.dept_id = dep.dept_id');
        $this->db->where('ps.uid',$uid);
        $this->db->group_by('ps.id');
        $data = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $data;
        
    }

}