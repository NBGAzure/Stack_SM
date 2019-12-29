<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Product_model extends CI_Model
 {
	function __construct()
    {
      parent::__construct();
    }

    public function record_productcount() {
       $count = $this->db->count_all("products");
       return $count;
    }

    public function getproduct($limit, $start, $search)
    {
        
        $this->db->select('ps.*,dt.*,st.*');
        $this->db->from('products as ps');
        $this->db->join('department as dt','dt.dept_id = ps.dept_id');
        $this->db->join('store as st','st.str_id = ps.str_id');
        if($search != ''){
          $this->db->like('ps.product_name', $search);
        }
         $this->db->order_by("ps.product_id","asc");
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

    
    public function insert_product($data)
    {
        if(!empty($data))
        {
            $this->db->insert('products',$data);
        }
    }

    public function geteditproduct($cid)
    {
        $this->db->select('ps.*,dt.*,st.*'); 
        $this->db->from('products as ps');
        $this->db->join('department as dt','dt.dept_id = ps.dept_id');
        $this->db->join('store as st','st.str_id = ps.str_id');
        $this->db->where('ps.product_id',$cid);
          
        $query = $this->db->get();
        return $query->result();
    }
    public function update_product($data,$cid)
    {
        $this->db->where('product_id',$cid);
        $this->db->update('products',$data);
    }
}