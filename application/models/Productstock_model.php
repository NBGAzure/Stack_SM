<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Productstock_model extends CI_Model
 {
    function __construct()
    {
      parent::__construct();
    }


    public function getproduct()
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by("product_id","asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getdepartment()
    {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->order_by("dept_id","asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function record_productstockcount() {
       $count = $this->db->count_all("product_stock");
       return $count;
    }

    public function getproductstock($limit, $start, $search)
    {   
        $id =$this->session->userdata['uid'];
        
        $this->db->select('ps.* ,pro.* , dt.*, um.*');
        $this->db->from('product_stock as ps');
        $this->db->join('products as pro', 'pro.product_id = ps.product_id','left');
        $this->db->join('department as dt', 'dt.dept_id = ps.dept_id','left');
        $this->db->join('user_master as um', 'um.uid = ps.uid','left');
        if($search != ''){
          $this->db->like('product_name', $search);
        }
        $this->db->where('ps.uid',$id);
        $this->db->order_by("ps.id","asc");
        $this->db->limit($limit, $start);
        
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

    
    public function insert_productstock($data)
    {
        if(!empty($data))
        {
            $this->db->insert('product_stock',$data);
        }
    }

    public function geteditproductstock($cid)
    {
        $this->db->select('ps.* ,pro.* , dt.*, um.*');
        $this->db->from('product_stock as ps');
        $this->db->join('products as pro', 'pro.product_id = ps.product_id','left');
        $this->db->join('department as dt', 'dt.dept_id = ps.dept_id','left');
        $this->db->join('user_master as um', 'um.uid = ps.uid','left');
        $this->db->where('ps.id',$cid);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_productstock($data,$cid)
    {
        $this->db->where('id',$cid);
        $this->db->update('product_stock',$data);
    }
    
    public function geteditdepartmentproduct($did)
    {   
        $uid =$this->session->userdata['uid'];
        $today = date('Y-m-d');
        // $predate = date('Y-m-d', strtotime(' -1 day'));

        // $prequ= "Select quantity from product_stock where dept_id = '$did' and uid = '$uid' and create_date= '$predate'";
        //print $prequ;
        $this->db->select("ps.*");
        $this->db->from('product_stock as ps');
        $this->db->where('ps.uid',$uid);
        $this->db->where('ps.dept_id',$did);
        //$this->db->where('ps.previous_quantity',$prequ);
        $this->db->where('DATE(ps.create_date)',$today);
        
        $res = $this->db->get()->result();
        // echo $this->db->last_query();
        // exit;
        if(count($res)>0){
            $this->db->select('pro.product_name,pro.product_id,dt.department_name,dt.dept_id,ps.quantity,ps.check_val,ps.previous_quantity,ps.create_date');
            $this->db->from('products as pro'); 
            $this->db->join('department as dt', 'dt.dept_id = pro.dept_id','left');
            $this->db->join('product_stock as ps', 'ps.dept_id = pro.dept_id and `ps`.`product_id` = `pro`.`product_id`','left');
            $this->db->where('pro.dept_id',$did);
            $this->db->where('ps.uid',$uid);
            $this->db->where('date(ps.create_date)',date('Y-m-d'));
            if(date('ps.create_date')!= date('Y-m-d') && date('ps.create_date') == date('Y-m-d', strtotime(' -1 day'))){
                $this->db->where('date(ps.create_date)',date('Y-m-d', strtotime(' -1 day')));
            }
            $this->db->group_by('pro.product_id');
            
        }else{
            $this->db->select('pro.product_name,pro.product_id,dt.department_name,dt.dept_id');
            $this->db->from('products as pro'); 
            $this->db->join('department as dt', 'dt.dept_id = pro.dept_id');
            $this->db->where('pro.dept_id',$did);
            $this->db->group_by('pro.product_id');
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit;
        return $query->result();
    }

    public function getproductquantity($did)
    {   
        $uid =$this->session->userdata['uid'];

        $this->db->select('ps.*');
        $this->db->from('product_stock as ps');
        $this->db->where('ps.uid',$uid);
        $this->db->where('ps.dept_id',$did);
        //$this->db->where('date(ps.create_date)',date('Y-m-d', strtotime('now - 1day')));
        //$this->db->where('date(ps.create_date)',date('Y-m-d'));
        $query = $this->db->get();
        return $query->result();
    }

    public function get_todayproductquantity($did)
    {   
        $uid = $this->session->userdata['uid'];

        $this->db->select('ps.*');
        $this->db->from('product_stock as ps');
        $this->db->where('ps.uid',$uid);
        $this->db->where('ps.dept_id',$did);
        $this->db->where('date(ps.create_date)',date('Y-m-d'));
        $query = $this->db->get();
        return $query->result();
    }


    public function update_deptproductstock($post,$did,$dept_id)
    {   
        $uid =$this->session->userdata['uid'];
        $insertArray = array();
        $updateArray = array();

        foreach($post as $key1=>$data){
           if($key1 == 'product_id'){
                $i = 0;
                foreach ($data as $key => $value) {

                    $this->db->select('ps.*');
                    $this->db->from('product_stock as ps');
                    $this->db->where('ps.uid',$uid);
                    $this->db->where('ps.product_id',$value);
                    $this->db->where('ps.dept_id',$dept_id);
                    //$this->db->where('date(ps.create_date)',date('Y-m-d'));
                    $this->db->limit("1","desc");
                    $predata = $this->db->get()->row();
                    $prequan = isset($predata->quantity)?$predata->quantity:"";
                    // echo $prequan;
                    // exit;
                    // $qudata = array('previous_quantity'=>$prequan);
                    // $this->db->insert('product_stock',$qudata);
                    
                    $this->db->select('ps.*');
                    $this->db->from('product_stock as ps');
                    $this->db->where('ps.uid',$uid);
                    $this->db->where('ps.product_id',$value);
                    $this->db->where('ps.dept_id',$dept_id);
                    $this->db->where('date(ps.create_date)',date('Y-m-d'));
                    $query = $this->db->get()->result_array();
                    //echo $this->db->last_query();
                        
                    if(sizeof($query)>0){
                        //print "in";
                        //exit;
                        $updateArray = array(
                            'uid'         => $uid,
                            'product_id'  => $value,
                            'dept_id'     => $dept_id,
                            'quantity'    => $post['quantity'][$key],
                            'check_val'   => isset($post['check_val'][$key])?$post['check_val'][$key]:'',
                            'create_date' => date( 'Y-m-d H:i:s' )
                        );
                        $today = date('Y-m-d');
                        $this->db->where(array('uid'=>$uid,'product_id'=>$value,'dept_id'=>$dept_id));
                        $this->db->where('DATE(create_date)',$today);
                        $this->db->update('product_stock', $updateArray);
                        //echo $this->db->last_query();
                       // echo "in";
                        
                    }
                    else
                    {
                        $insertArray[$i] = array(
                            'uid'         => $uid,
                            'product_id'  => $value,
                            'dept_id'     => $dept_id,
                            'quantity'    => $post['quantity'][$key],
                            'previous_quantity'   => $prequan,
                            'check_val'   => $post['check_val'][$key],
                            'create_date' => date( 'Y-m-d H:i:s' )
                        );
                    }
                   
                  $i++;
                }
            }

           
        }
        //print_r($insertArray);
        //print_r($updateArray);
       
        if(isset($insertArray) && !empty($insertArray)){
            $this->db->insert_batch('product_stock', $insertArray);
            //exit;
        } 
        // else{
        //     echo "in";
        //     $where = array('uid','product_id','dept_id');
        //    // $this->db->update_batch('product_stock', $updateArray, array('uid','product_id','dept_id'));
        //     $this->db->update_batch('product_stock', $updateArray,$where);
        //   //  echo $this->db->last_query();
        // }

        
    }

    public function pdfgenerate($post,$did,$dept_id)
    {   
        $uid =$this->session->userdata['uid'];
        $this->db->select('ps.*,dt.department_name,pro.product_name');
        $this->db->from('product_stock as ps');
        $this->db->join('products as pro', 'pro.product_id = ps.product_id');
        $this->db->join('department as dt', 'dt.dept_id = ps.dept_id');
        $this->db->where('ps.uid',$uid);
        $this->db->where('ps.dept_id',$dept_id);
        $this->db->where('date(ps.create_date)',date('Y-m-d'));
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();
        //exit;
        return $query;
    }
    
    public function sendemailpdf($uid)
    {   
        
        $this->db->select('*');
        $this->db->where('uid',$uid);
        $this->db->from('user_master');
        $user = $this->db->get()->row();

        $email=$user->email;
        $subject="RESNBOT REPORT";
        $message="HELLO ".$user->username.", <br/> Please Find attachment of your product report. <br/> Thank you! ";

        // $config = Array(
        //   'protocol' => 'smtp',
        //   'smtp_host' => 'ssl://smtp.googlemail.com',
        //   'smtp_port' => 465,
        //   'smtp_user' => 'niralikanani04@gmail.com', 
        //   'smtp_pass' => 'Theparanoid@0407', 
        //   'mailtype' => 'html',
        //   'charset' => 'iso-8859-1',
        //   'wordwrap' => TRUE
        // );
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.hostinger.com',
          'smtp_port' => 587,
          'smtp_user' => 'daily-report@resnbot.net', // change it to yours
          'smtp_pass' => 'N@rp!y$97', // change it to yours
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('daily-report@resnbot.net');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
       // $this->email->attach($saved_pdf);
        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false;
            //show_error($this->email->print_debugger());
        }
    }
}