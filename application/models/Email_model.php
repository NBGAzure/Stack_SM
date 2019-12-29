<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {
  
  function __construct() {
    parent::__construct();
    $this->load->database();
  }
 
  public function ForgotPassword($email)
  {
   
    $email = $email['email'];
    $this->db->select('email');
    $this->db->from('user_master'); 
    $this->db->where('email', $email); 
    $query=$this->db->get()->row_array();
    //print_r($query);
    return $query;
  }
 
  public function randomPassword()
  {
    $alphabet = '1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 4; $i++)
    {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }

  public function sendpassword($data)
   {
      //print_r($data);
      $email = $data['email'];
      $this->db->select('email,password,username');
      $this->db->from('user_master'); 
      $this->db->where('email', $email); 
      $query=$this->db->get();
      $row = $query->row();

	    if ($query->num_rows()>0)
    	{
			
  			$otp = $this->randomPassword();
  			$this->db->where('email', $email);
  			$this->db->update('user_master',array('otp'=>$otp));
  			
        //$otp = $newpassword;
        
  		  $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'mail.emailmanagers.net',
          'smtp_port' => 3535,
          'smtp_user' => 'no-reply@emailmanagers.net', // change it to yours
          'smtp_pass' => 'N@rp!y$97', // change it to yours
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );

         $message = 'Thanks for contacting regarding to forgot password,<br> Your <b>OTP</b> is <b>'.$otp.'</b>';
         $this->load->library('email', $config);
         $this->email->set_newline("\r\n");  
         $this->email->from('no-reply@emailmanagers.net'); // change it to yours
         $this->email->to($row->email);// change it to yours
         $this->email->subject('Musician Forgot Password');
         //$this->email->message('Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$newpass.'</b>');
         $this->email->message($message);
    		 if($this->email->send())
    		 {
    		      $this->session->set_flashdata('flash_data','Email sent. Please check your email address');
              $data['message']='Thanks for contacting regarding to forgot password,<br> Your <b>OTP</b> is '.$otp.'';
              return $data;

    		 }
    		 else
    		 {
    		   $error = show_error($this->email->print_debugger());
    		   $this->session->set_flashdata('flash_data',$error);
    		   return $data;
    		 }
    			 return $data;     
  	}
  	else
  	{  
		   $this->session->set_flashdata('flash_data','Email not found try again!');
		  return $data;
  	}
  }

	public function otpmatch_user($type){
      $otp_api = $type['otp'];
      $email = $type['email'];
      //$uid = $type['uid'];
      
      $this->db->select('otp');
      $this->db->from('user_master'); 
      $this->db->where('email', $email); 
      $query=$this->db->get();
      $row = $query->row();
            
      if ($otp_api==$row->otp)
      {      
       return true;
      }
      else{
         return false;
      }
   }
  
  public function regenaratepass_user($type){
      
      $re_password = $type['re_password'];
      $email = $type['email'];
      

      if(!empty($re_password)){
        $this->db->where('email', $email);
        $this->db->update('user_master',array('password'=>md5($re_password)));
        return true;
      }
      else{
        return false;
      }
  }


  public function randomverify()
  {
      $alphabet = '1234567890';
      $pass = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      for ($i = 0; $i < 4; $i++)
      {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
      }
      return implode($pass); //turn the array into a string
  }

  public function register_verify($type){
    $email = $type['email'];
        
    $verify_otp = $this->randomverify();

    $this->db->where('email', $email);
    $this->db->update('user_master',array('verification_code'=>$verify_otp));
          
          //$otp = $newpassword;
          
          $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.emailmanagers.net',
            'smtp_port' => 3535,
            'smtp_user' => 'no-reply@emailmanagers.net', // change it to yours
            'smtp_pass' => 'N@rp!y$97', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
          );

           $message = 'This Email is regarding to varify your account in JELLY ,JAM WITH US. Your OTP is <b>'.$verify_otp.'</b>';
           $this->load->library('email', $config);
           $this->email->set_newline("\r\n");  
           $this->email->from('no-reply@emailmanagers.net'); // change it to yours
           $this->email->to($email);// change it to yours
           $this->email->subject('Verification Mail- JELLY!');
           //$this->email->message('Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$newpass.'</b>');
           $this->email->message($message);
           if($this->email->send())
           {
                $this->session->set_flashdata('flash_data','Email sent. Please check your email address');
                  
                  $this->db->select('*');
                  $this->db->where('email',$email);
                  $this->db->from('user_master');
                  $user_data= $this->db->get()->row();

                  //print_r($user_data);
                  $data['uid'] = $user_data->uid;
                  $data['email'] = $email;
                  $data['firstname'] = $type['firstname'];
                  $data['lastname'] = $type['lastname'];
                  //$data['phone'] = $type['phone'];
                  $data['verify_flag'] = 0;
                  $data['message']= 'This Email is regarding to varify your account in JELLY ,JAM WITH US. Your OTP is '.$verify_otp.'';
                  return $data;
           }
           else
           {
             $error = show_error($this->email->print_debugger());
             $this->session->set_flashdata('flash_data',$error);
             //return $data;
           }
  }

  public function registerverification_user($type){
        
        $otp_api = $type['otp'];
        $email = $type['email'];
        $this->db->select('verification_code');
        $this->db->from('user_master'); 
        $this->db->where('email',$email);
        $query=$this->db->get();
        $row = $query->row();
      
        if ($otp_api==$row->verification_code)
        { 

         $this->db->where('email', $email);
         $this->db->update('user_master',array('verify_flag'=>1));     
         return true;
        }
        else{
           return false;
        }
  }


  public function appsendlink($data)
  {
      //print_r($data);
      $email = $data['email'];
      $this->db->select('uid,email,password,username');
      $this->db->from('user_master'); 
      $this->db->where('email', $email); 
      $query=$this->db->get();
      $row = $query->row();
      //echo $this->db->last_query();
      $id = base64_encode($row->uid);

      if ($query->num_rows()>0)
      { 
        $config = Array(
          'protocol' => 'smtp',
          'smtp_host' => 'mail.emailmanagers.net',
          'smtp_port' => 3535,
          'smtp_user' => 'no-reply@emailmanagers.net', // change it to yours
          'smtp_pass' => 'N@rp!y$97', // change it to yours
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
        );

        $message = 'Click on link: <a href ="http://Jellyapp.com/appforgotpassword?user_id='.$id.'">http://Jellyapp.com/appforgotpassword?user_id='.$id.'</a>';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");  
        $this->email->from('no-reply@emailmanagers.net'); // change it to yours
        $this->email->to($row->email);// change it to yours
        $this->email->subject('Musician Forgot Password');
        $this->email->message($message);
        if($this->email->send())
        {
          $this->session->set_flashdata('flash_data','Email sent. Please check your email address');
          $data['message'] = $message;
          return $data;
        }
        else
        {
          $error = show_error($this->email->print_debugger());
          $this->session->set_flashdata('flash_data',$error);
          return $data;
        }
        return $data;     
    }
    else
    {  
      $this->session->set_flashdata('flash_data','Email not found try again!');
      return $data;
    }
  }
   
}	 