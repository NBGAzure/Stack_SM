<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Report_model extends CI_Model
{
    function __construct()
    {
      parent::__construct();
    }


    public function getreportstock()
    {
        $this->db->select('*');
        $this->db->from('tillreport');
        $this->db->order_by("id","asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function record_reportcount() {
       $count = $this->db->count_all("tillreport");
       return $count;
    }

    public function getreport($limit, $start, $search)
    {   
        $id =$this->session->userdata['uid'];
        
        $this->db->select('tr.*');
        $this->db->from('tillreport as tr');
        if($search != ''){
          $this->db->like('item', $search);
        }
        $this->db->order_by("tr.id","asc");
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

    
    public function insert_report($data)
    {
        if(!empty($data))
        {
            $this->db->insert('tillreport',$data);
        }
    }

    public function geteditreport($cid)
    {
        $this->db->select('tr.*');
        $this->db->from('tillreport as tr');
        $this->db->where('tr.id',$cid);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_report($data,$cid)
    {
        $this->db->where('id',$cid);
        $this->db->update('tillreport',$data);
    }
    
    public function geteditreportitem($did)
    {   
        $uid =$this->session->userdata['uid'];
        $today = date('Y-m-d');
        
        $this->db->select("rs.*");
        $this->db->from('report_stock as rs');
        $this->db->where('rs.uid',$uid);
        $this->db->where('DATE(rs.created_date)',$today);
        
        $res = $this->db->get()->result();
        // echo $this->db->last_query();
        // echo count($res);
        // exit;
        if(count($res)>0){
            $this->db->select('tr.item,tr.id as itemid,rs.id,rs.quantity,rs.item_id,rs.total,rs.previous_qun,rs.created_date');
            $this->db->from('tillreport as tr'); 
            $this->db->join('report_stock as rs', 'rs.item_id = tr.id','left');
            $this->db->where('rs.uid',$uid);
            $this->db->where('date(rs.created_date)',date('Y-m-d'));
            if(date('rs.created_date')!= date('Y-m-d') && date('rs.created_date') == date('Y-m-d', strtotime(' -1 day'))){
                $this->db->where('date(rs.created_date)',date('Y-m-d', strtotime(' -1 day')));
            }$this->db->where_not_in('tr.id',array('12','19','20','21','22'));
            $this->db->group_by('tr.id');
            
        }else{
            $this->db->select('tr.item,tr.id as itemid');
            $this->db->from('tillreport as tr'); 
            $this->db->where_not_in('tr.id',array('12','19','20','21','22'));
            $this->db->group_by('tr.id');
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit;
        return $query->result();
    }

  
    public function save_reportstock($post,$did)
    {   
        //print_r($post);
       
        $uid =$this->session->userdata['uid'];
        $insertArray = array();
        $updateArray = array();

        foreach($post as $key1=>$data){
            if($key1 == 'item_id'){
                $i = 0;
                foreach ($data as $key => $value) {
                    //print_r($key);
                    $this->db->select('rs.*');
                    $this->db->from('report_stock as rs');
                    $this->db->where('rs.uid',$uid);
                    $this->db->where('rs.item_id',$value);
                    $this->db->limit("1","desc");
                    $predata = $this->db->get()->row();
                    $prequan = isset($predata->quantity)?$predata->quantity:"";
                    
                    $this->db->select('rs.*');
                    $this->db->from('report_stock as rs');
                    $this->db->where('rs.uid',$uid);
                    $this->db->where('rs.item_id',$value);
                    $this->db->where('date(rs.created_date)',date('Y-m-d'));
                    $query = $this->db->get()->result_array();
                    //echo $this->db->last_query();
                        
                    if(sizeof($query)>0){
                        //print "in";
                        //exit;
                        $itemqun = $post['quantity'][$key];
                        //echo $itemqun;
                        //echo $value;
                        if($itemqun > 0 && $value < 8)
                        {
                            $this->db->select('item');
                            $this->db->from('tillreport'); 
                            $this->db->where('id',$value);
                            $tot = $this->db->get()->row();
                            //echo $this->db->last_query();
                            $nodol = trim($tot->item,"$");
                           
                            $totval = $itemqun*$nodol;
                            //echo $totval;
                        }
                        elseif($itemqun > 0 && $value > 7 && $value < 11)
                        {
                            $this->db->select('item');
                            $this->db->from('tillreport'); 
                            $this->db->where('id',$value);
                            $tot = $this->db->get()->row();
                            //echo $this->db->last_query();
                            $nodol = trim($tot->item,"C");
                           
                            $totval = $itemqun*$nodol/100;
                           
                        }
                        elseif($itemqun == 12 | $itemqun == 19 |$itemqun == 20 |$itemqun == 21 | $itemqun == 22)
                        {
                            $totval = "";
                            //echo $totval;
                        }else{
                            $totval = $post['quantity'][$key];
                        }
                         //exit;
                        
                        $updateArray = array(
                            'uid'         => $uid,
                            'item_id'  => $value,
                            'quantity'    => isset($post['quantity'][$key])?$post['quantity'][$key]:0,
                            'previous_qun'   =>$post['previous_qun'][$key],
                            'total'   => $totval,
                            'modified_date' => date( 'Y-m-d H:i:s' )
                        );
                         //print_r($updateArray);
                         //exit;
                        $today = date('Y-m-d');
                        $this->db->where(array('uid'=>$uid,'item_id'=>$value));
                        $this->db->where('DATE(created_date)',$today);
                        $this->db->update('report_stock', $updateArray);
                        //echo $this->db->last_query();
                       // echo "in";
                        
                    }
                    else
                    {
                        $itemqun= $post['quantity'][$key];
                        //echo $value;
                        if($itemqun > 0 && $value < 11)
                        {
                            $this->db->select('item');
                            $this->db->from('tillreport'); 
                            $this->db->where('id',$value);
                            $tot = $this->db->get()->row();
                            //echo $this->db->last_query();
                            $nodol = trim($tot->item,"$");
                           
                            $totval =$itemqun*$nodol;
                            //echo $totval;
                        }else{
                            $totval = $post['quantity'][$key];
                        }
                        
                        $insertArray[$i] = array(
                            'uid'         => $uid,
                            'item_id'  => $value,
                            'quantity'    => isset($post['quantity'][$key])?$post['quantity'][$key]:0,
                            'previous_qun'   =>$post['previous_qun'][$key],
                            'total'   => $totval,
                            'created_date' => date( 'Y-m-d H:i:s' )
                        );
                    }
                   
                  $i++;
                }
            }

           
        }
        // print_r($insertArray);
        // print_r($updateArray);
        //exit;
        if(isset($insertArray) && !empty($insertArray)){
            $this->db->insert_batch('report_stock', $insertArray);
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

    public function submit_reportstock($did)
    {   
        $uid =$this->session->userdata['uid'];
        
        $this->db->select('rs.*');
        $this->db->from('report_stock as rs');
        $this->db->where('rs.uid',$uid);
        $this->db->where('date(rs.created_date)',date('Y-m-d'));
        $query = $this->db->get()->result();
        //echo $this->db->last_query();
        //exit; 
        
        if(sizeof($query)>0){
            //print "in";
            //exit;
            foreach($query as $key=>$data)
            {   
                
                $itemid = $data->item_id;
               
                if($itemid == 12){
                    $this->db->select('SUM(total) AS cash_sum');
                    $this->db->from('report_stock'); 
                    $this->db->where('uid',$uid);
                    $this->db->where('date(created_date)',date('Y-m-d'));
                    $this->db->where('item_id >',0);
                    $this->db->where('item_id <',11);
                    $cash = $this->db->get()->row();
                    
                    $cashtotal = $cash->cash_sum;

                    $updateArray = array(
                        'total'   => isset($cashtotal)?$cashtotal:0,
                        'modified_date' => date( 'Y-m-d H:i:s' )
                    );
                    
                    $today = date('Y-m-d');
                    $this->db->where('uid',$uid);
                    $this->db->where('item_id',12);
                    $this->db->where('DATE(created_date)',$today);
                    $this->db->update('report_stock', $updateArray);
                }
                elseif($itemid == 19){
                    $this->db->select('SUM(total) AS dine_sum');
                    $this->db->from('report_stock'); 
                    $this->db->where('uid',$uid);
                    $this->db->where('date(created_date)',date('Y-m-d'));
                    $this->db->where('item_id >',12);
                    $this->db->where('item_id <',15);
                    $dine = $this->db->get()->row();
                    
                    $cashtotal = $dine->dine_sum;

                    $updateArray = array(
                        'total'   => isset($cashtotal)?$cashtotal:0,
                        'modified_date' => date( 'Y-m-d H:i:s' )
                    );
                    
                    $today = date('Y-m-d');
                    $this->db->where('uid',$uid);
                    $this->db->where('item_id',19);
                    $this->db->where('DATE(created_date)',$today);
                    $this->db->update('report_stock', $updateArray);
                }elseif($itemid == 20){
                    $this->db->select('SUM(total) AS online_sum');
                    $this->db->from('report_stock'); 
                    $this->db->where('uid',$uid);
                    $this->db->where('date(created_date)',date('Y-m-d'));
                    $this->db->where('item_id >',14);
                    $this->db->where('item_id <',17);
                    $this->db->or_where('item_id',11);
                    $online = $this->db->get()->row();
                    
                    $cashtotal = $online->online_sum;

                    $updateArray = array(
                        'total'   => isset($cashtotal)?$cashtotal:0,
                        'modified_date' => date( 'Y-m-d H:i:s' )
                    );
                    
                    $today = date('Y-m-d');
                    $this->db->where('uid',$uid);
                    $this->db->where('item_id',20);
                    $this->db->where('DATE(created_date)',$today);
                    $this->db->update('report_stock', $updateArray);
                }
                elseif($itemid == 21){
                    $this->db->select('SUM(total) AS take_sum');
                    $this->db->from('report_stock'); 
                    $this->db->where('uid',$uid);
                    $this->db->where('date(created_date)',date('Y-m-d'));
                    $this->db->where('item_id >',16);
                    $this->db->where('item_id <',19);
                    $take = $this->db->get()->row();
                    
                    $cashtotal = $take->take_sum;

                    $updateArray = array(
                        'total'   => isset($cashtotal)?$cashtotal:0,
                        'modified_date' => date( 'Y-m-d H:i:s' )
                    );
                    
                    $today = date('Y-m-d');
                    $this->db->where('uid',$uid);
                    $this->db->where('item_id',21);
                    $this->db->where('DATE(created_date)',$today);
                    $this->db->update('report_stock', $updateArray);
                }
                elseif($itemid == 22){   

                    $itemids = array('12','19','20','21');

                    $this->db->select('SUM(total) AS grand_sum');
                    $this->db->from('report_stock'); 
                    $this->db->where('uid',$uid);
                    $this->db->where('date(created_date)',date('Y-m-d'));
                    $this->db->where_not_in('item_id',$itemids);
                    $grand = $this->db->get()->row();
                    
                    $cashtotal = $grand->grand_sum;

                    $updateArray = array(
                        'total'   => isset($cashtotal)?$cashtotal:0,
                        'modified_date' => date( 'Y-m-d H:i:s' )
                    );
                    //print_r($updateArray);
                     //exit;
                    $today = date('Y-m-d');
                    $this->db->where('uid',$uid);
                    $this->db->where('item_id',22);
                    $this->db->where('DATE(created_date)',$today);
                    $this->db->update('report_stock', $updateArray);
                }
            }
        }     
    }

    public function pdfgenerate($post,$did)
    {   
        $uid =$this->session->userdata['uid'];
        $this->db->select('rs.*,tr.item');
        $this->db->from('report_stock as rs');
        $this->db->join('tillreport as tr', 'tr.id = rs.item_id');
        $this->db->where('rs.uid',$uid);
        $this->db->where('date(rs.created_date)',date('Y-m-d'));
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();
        //exit;
        return $query;
    }
    
    public function sendemailpdf($uid,$saved_pdf)
    {   


        
        $this->db->select('*');
        $this->db->where('uid',$uid);
        $this->db->from('user_master');
        $user = $this->db->get()->row();


        $email=$this->$user->email;
        $subject="RESNBOT REPORT";
        $message="HELLO ".$user->username.", <br/> Your till report has been submitted successfully. <br/> Thank you! ";


        // $q -> $this -> db -> query("select email as email_id from user_master where uid=$uid");
        // $d -> $q -> row_array();
        // $test_to -> $d['email_id'];

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
          'smtp_user' => 'test@resnbot.net', // change it to yours
          'smtp_pass' => 'TRkSsR|i', // change it to yours
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('test@resnbot.net');
        $this->email->to('vickydesai8002@gmail.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($saved_pdf);
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