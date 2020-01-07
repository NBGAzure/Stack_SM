<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Request_model extends CI_Model
 {
	function __construct()
    {
      parent::__construct();
    }

    public function record_requestcount()
    {
        //$count = $this->db->count_all("product_stock")->where('check_val',1);
       $count = $this->db->where('check_val',1)->from("product_stock")->count_all_results();
       return $count;
    }

    public function getrequest($limit, $start, $search)
    {
        
        $this->db->select('ps.*,p.product_name');
        $this->db->from('product_stock as ps');
        $this->db->join('products as p','p.product_id = ps.product_id');
        //$this->db->join('store as st','st.str_id = ps.str_id');
        $this->db->where('ps.check_val',1);
        if($search != ''){
          $this->db->like('p.product_name', $search);
        }
        $this->db->order_by("ps.id","asc");
        $this->db->group_by("ps.product_id");
        $this->db->limit($limit, $start);
        
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


    public function record_adminrequestcount()
    {
        //$count = $this->db->count_all("product_stock")->where('check_val',1);
       $count = $this->db->where('check_val',1)->from("product_stock")->count_all_results();
       return $count;
    }

    public function getadminrequest($limit, $start, $search)
    {
        
        $this->db->select('ps.*,p.product_name,st.store_name,dt.department_name');
        $this->db->from('product_stock as ps');
        $this->db->join('products as p','p.product_id = ps.product_id');
        $this->db->join('store as st','st.str_id = p.str_id');
        $this->db->join('department as dt','dt.dept_id = ps.dept_id');
        $this->db->where('ps.check_val',1);
        if($search != ''){
          $this->db->like('p.product_name', $search);
          $this->db->like('st.store_name', $search);
          $this->db->like('dt.department_name', $search);
        }
        $this->db->order_by("ps.id","asc");
        $this->db->group_by("ps.product_id");
        $this->db->limit($limit, $start);
        
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

}