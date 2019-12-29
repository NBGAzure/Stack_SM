<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	    function __construct() {
        parent::__construct();
        $this->load->database();
		
    }

    public function validate_user($data) {
		
        
		if(!empty($data['username'])){
		
		$res = $this->db->query("select uid,username from user_master where (BINARY username= BINARY '".$data['username']."' or BINARY username= BINARY '".$data['username']."') and password='".md5($data['password'])."'")->row();
		}else{
			$res = '';
		}
		//print_r($res);
        //exit;
		if(!empty($res)){
			$this->db->where('uid', $res->uid);
			$this->db->update('user_master',array('last_login_time'=>time()));
		}

		return $res;
    }
 
    public function social_login($data){

		$password = $data['password'];
		$social_id = $data['social_id'];
		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$social_type= $data['social_type'];
		$deviceid= $data['device_id'];
		$token= $data['token'];
		$last_login_time = $data['last_login_time'];
		//echo $data['phone'];
        
        $select = $this->db->select('*');
        if(!empty($data['phone']))
		{
		$this->db->where('phone', $data['phone']);
		}
		else
		{
		$this->db->where('email', $data['email']);
		}
	  	$query = $this->db->get('user_master');
	  	//print $this->db->last_query();
	  	if ($query->num_rows() > 0) 
        {
        	$row = $query->row();
			if($row->social_type != $data['social_type']){
				//echo "yes";
				$post_data = array('firstname'=>$firstname,'lastname'=>$lastname,'device_id'=>$deviceid,'social_id'=>$social_id,'social_type'=>$social_type,'token'=>$token,'last_login_time'=>$last_login_time);
				$this->db->where('uid',$row->uid);
				$res = $this->db->update('user_master',$post_data);
				//print $this->db->last_query();
				$data1['uid'] = $row->uid;
				$data1['firstname']=$data['firstname'];
				$data1['lastname']=$data['lastname'];
				$data1['email']=$data['email'];
				$data1['social_id']=$data['social_id'];
				$data1['social_type']=$data['social_type'];
				$data1['phone']=$data['phone'];

				$this->db->select('*');
				$this->db->where('uid',$row->uid);
				$this->db->from('artist_detail');
				$datas = $this->db->get()->row();
				//$data1['userpic']=$datas->userpic;

				if(isset($datas) && !empty($datas)){
					$data1['userpic']= $datas->userpic;
				}else{
					$data1['userpic'] = "";
				}

				$this->db->select('*');
				$this->db->where('uid',$row->uid);
				$this->db->from('role_management');
				$roledata = $this->db->get()->row();
				$data1['role']=$roledata->role_id;

				// echo $data1['role'];
				// exit;
				
				if(isset($roledata) && !empty($roledata)){
					$data1['role']=$roledata->role_id;
				}else{
					$data1['role'] = "";
				}

				$this->db->select('sc.*,cm.*');
	            $this->db->from('category_management as cm');
	            $this->db->join('skill_category as sc', 'sc.cat_id = cm.cat_id AND sc.cat_parent=0');
	            $this->db->where('cm.uid',$row->uid);
	            $result = $this->db->get()->row();
	            $data1['cat_id'] = isset($result->cat_id)?$result->cat_id:"";

				if($data1['role'] == 1){
					$this->db->select('*');
					$this->db->where('uid',$row->uid);
					$this->db->from('artist_detail');
					$datas_pro = $this->db->get()->row();

					$data1['profile_complete']=isset($datas_pro->profile_complete)?$datas_pro->profile_complete:"";
				}else{
					$this->db->select('*');
					$this->db->where('uid',$row->uid);
					$this->db->from('host_detail');
					$datas_pro = $this->db->get()->row();

					$data1['profile_complete']=isset($datas_pro->profile_complete)?$datas_pro->profile_complete:"";
				}
				//$data1['profile_complete']=0;
				//isset($procom->profile_complete)?$procom->profile_complete:""

			}else{
				//echo "yes1";
				$post_data = array('firstname'=>$firstname,'lastname'=>$lastname,'device_id'=>$deviceid,'social_id'=>$social_id,'social_type'=>$social_type,'token'=>$token,'last_login_time'=>$last_login_time);
				$this->db->where('uid',$row->uid);
				$res = $this->db->update('user_master',$post_data);

				$data1['uid'] = $row->uid;
				$data1['firstname']=$data['firstname'];
				$data1['lastname']=$data['lastname'];
				$data1['email']=$data['email'];
				$data1['social_id']=$data['social_id'];
				$data1['social_type']=$data['social_type'];
				$data1['phone']=isset($data['phone'])?$data['phone']:"";

				// $this->db->select('*');
				// $this->db->where('uid',$row->uid);
				// $this->db->from('artist_detail');
				// $ret = $this->db->get()->row();
				// //print_r($ret);
				// $data1['userpic'] = "";

				// if(isset($ret) && !empty($ret)){
				// 	$data1['userpic']= $ret->userpic;
				// }

				$this->db->select('sc.*,cm.*');
	            $this->db->from('category_management as cm');
	            $this->db->join('skill_category as sc', 'sc.cat_id = cm.cat_id AND sc.cat_parent=0');
	            $this->db->where('cm.uid',$row->uid);
	            $result = $this->db->get()->row();
	            $data1['cat_id'] = isset($result->cat_id)?$result->cat_id:"";
				
				$this->db->select('*');
				$this->db->where('uid',$row->uid);
				$this->db->from('role_management');
				$rolet = $this->db->get()->row();
				$data1['role'] = "";
				if(isset($rolet) && !empty($rolet)){
					$data1['role']=$rolet->role_id;
				}

				if($data1['role'] == 1){
					$this->db->select('*');
					$this->db->where('uid',$row->uid);
					$this->db->from('artist_detail');
					$datas = $this->db->get()->row();
					

					if(isset($datas) && !empty($datas)){
						$data1['userpic']= $datas->userpic;
					}else{
						$data1['userpic'] = "";
					}

					$this->db->select('count(id) as cnt');
			        $this->db->where('uid',$row->uid);
			        $this->db->from('artist_detail');
			        $queryc = $this->db->get();
			        $count = $queryc->row()->cnt;
			        //echo $this->db->last_query();

			        $this->db->select('*');
			        $this->db->where('uid',$row->uid);
			        $this->db->from('artist_detail');
			        $queryc1 = $this->db->get();
			        $procom = $queryc1->row();

			        if($count > 0){
			        	$data1['profile_complete']=$procom->profile_complete;
			        }
			        else{
			        	$data1['profile_complete']='';
			        }

				}else{
					$this->db->select('*');
					$this->db->where('uid',$row->uid);
					$this->db->from('host_detail');
					$datas = $this->db->get()->row();
					
					if(isset($datas) && !empty($datas)){
						$data1['userpic']= $datas->userpic;
					}else{
						$data1['userpic'] = "";
					}


					$this->db->select('count(id) as cnt');
			        $this->db->where('uid',$row->uid);
			        $this->db->from('host_detail');
			        $queryc = $this->db->get();
			        $count = $queryc->row()->cnt;
			        //echo $this->db->last_query();

			        $this->db->select('*');
			        $this->db->where('uid',$row->uid);
			        $this->db->from('host_detail');
			        $queryc1 = $this->db->get();
			        $procom = $queryc1->row();

			        if($count > 0){
			        	$data1['profile_complete']=isset($procom->profile_complete)?$procom->profile_complete:"";
			        }
			        else{
			        	$data1['profile_complete']='';
			        }
				}

			}
		}
        else
        {
			$post_data = array('firstname'=>$firstname,'lastname'=>$lastname,'password'=>$data['email'],'email'=>$data['email'],'phone'=>$data['phone'],'device_id'=>$deviceid,'social_id'=>$social_id,'social_type'=>$social_type,'token'=>$token,'last_login_time'=>$last_login_time);
    		$this->db->insert('user_master',$post_data);
			$cid = $this->db->insert_id();
			$data1['uid']  = $cid;
			$data1['firstname']=$data['firstname'];
			$data1['lastname']=$data['lastname'];
			$data1['email']=$data['email'];
			$data1['social_id']=$data['social_id'];
			$data1['social_type']=$data['social_type'];
			$data1['phone']=isset($data['phone'])?$data['phone']:"";

			$this->db->select('sc.*,cm.*');
            $this->db->from('category_management as cm');
            $this->db->join('skill_category as sc', 'sc.cat_id = cm.cat_id AND sc.cat_parent=0');
            $this->db->where('cm.uid',$row->uid);
            $result = $this->db->get()->row();
            $data1['cat_id'] = isset($result->cat_id)?$result->cat_id:"";

			$this->db->select('*');
			$this->db->where('uid',$cid);
			$this->db->from('role_management');
			$roledata = $this->db->get()->row();
			//$data1['role']=$roledata->role_id;

			$data1['role'] = "";
			if(isset($roledata) && !empty($roledata)){
				$data1['role']=$roledata->role_id;
			}

			if($data1['role'] == 1){
				$this->db->select('*');
				$this->db->where('uid',$cid);
				$this->db->from('artist_detail');
				$datas = $this->db->get()->row();
				

				if(isset($datas) && !empty($datas)){
					$data1['userpic']= $datas->userpic;
				}else{
					$data1['userpic'] = "";
				}
				$this->db->select('count(id) as cnt');
		        $this->db->where('uid',$cid);
		        $this->db->from('artist_detail');
		        $queryc = $this->db->get();
		        $count = $queryc->row()->cnt;
		        //echo $this->db->last_query();

		        $this->db->select('*');
		        $this->db->where('uid',$cid);
		        $this->db->from('artist_detail');
		        $queryc1 = $this->db->get();
		        $procom = $queryc1->row();

		        if($count > 0){
		        	$data1['profile_complete']=$procom->profile_complete;
		        }
		        else{
		        	$data1['profile_complete']='';
		        }
			}else{
				$this->db->select('*');
				$this->db->where('uid',$cid);
				$this->db->from('host_detail');
				$datas = $this->db->get()->row();
				

				if(isset($datas) && !empty($datas)){
					$data1['userpic']= $datas->userpic;
				}else{
					$data1['userpic'] = "";
				}
				$this->db->select('count(id) as cnt');
		        $this->db->where('uid',$cid);
		        $this->db->from('host_detail');
		        $queryc = $this->db->get();
		        $count = $queryc->row()->cnt;
		        //echo $this->db->last_query();

		        $this->db->select('*');
		        $this->db->where('uid',$cid);
		        $this->db->from('host_detail');
		        $queryc1 = $this->db->get();
		        $procom = $queryc1->row();

		        if($count > 0){
		        	$data1['profile_complete']=isset($procom->profile_complete)?$procom->profile_complete:"";
		        }
		        else{
		        	$data1['profile_complete']='';
		        }
			}

		}
	    
		return $data1;
	}


	public function checkemail($type){

		$email = $type['email'];
		
		$this->db->where('email',$email);
		$query = $this->db->get('user_master');
		if($query->num_rows()>0){
			$row = $query->row();
			$data['uid']= $row->uid;
			$data['social_type']= $row->social_type;
			$data['social_id']= $row->social_id;
			$data['password']= $row->password;
			$data['email']= $row->email;
			return $data;
		}
		
	}

	public function manual_login($data){
		
		// $this->db->get_where(array('email' => $data['email'],'password'=> md5($data['password']));
		// $res =  $this->db->get('user_master')->row(); // echo " IN MODEL :";
		
		$res = $this->db->get_where('user_master',array('email'=>$data['email'],'password'=> md5($data['password'])))->row();

		//print_r($res);
		//exit;
		if(count($res) > 0){
		    $device_id=$data['device_id'];
			$token=$data['token'];
			$last_login_time = $data['last_login_time'];
			
			$value=array('device_id'=>$device_id,'token'=>$token,'last_login_time'=>$last_login_time);
			$this->db->where('uid',$res->uid);
			$this->db->update('user_master',$value);

		
		    $data1['uid']  = $res->uid;
			$data1['email']= $res->email;
			$data1['social_id']=$res->social_id;
			$data1['social_type']=$res->social_type;
			$data1['phone']=isset($res->phone)?$res->phone:"";

			$this->db->select('sc.*,cm.*');
            $this->db->from('category_management as cm');
            $this->db->join('skill_category as sc', 'sc.cat_id = cm.cat_id AND sc.cat_parent=0');
            $this->db->where('cm.uid',$res->uid);
            $result = $this->db->get()->row();
            $data1['cat_id'] = isset($result->cat_id)?$result->cat_id:"";
            
			// $this->db->select('*');
			// $this->db->where('uid',$row->uid);
			// $this->db->from('artist_detail');
			// $datas = $this->db->get()->row();
			// //$data1['userpic']=$datas->userpic;

			// $data1['userpic'] = "";

			// if(isset($datas) && !empty($datas)){
			// 	$data1['userpic']= $data->userpic;
			// }

			$this->db->select('*');
			$this->db->where('uid',$res->uid);
			$this->db->from('role_management');
			$roledata = $this->db->get()->row();
			//$data1['role']=$roledata->role_id;

			$data1['role'] = "";
			if(isset($roledata) && !empty($roledata)){
				$data1['role']=$roledata->role_id;
			}

			if($data1['role'] == 1){
				$this->db->select('*');
				$this->db->where('uid',$res->uid);
				$this->db->from('artist_detail');
				$datas = $this->db->get()->row();
				$data1['userpic'] = "";

				if(isset($datas) && !empty($datas)){
					$data1['userpic']= $datas->userpic;
				}

				$this->db->select('count(id) as cnt');
		        $this->db->where('uid',$res->uid);
		        $this->db->from('artist_detail');
		        $queryc = $this->db->get();
		        $count = $queryc->row()->cnt;
		        //echo $this->db->last_query();
		        
		        $this->db->select('*');
		        $this->db->where('uid',$res->uid);
		        $this->db->from('artist_detail');
		        $queryc1 = $this->db->get();
		        $procom = $queryc1->row();

		        if($count > 0){
		        	$data1['profile_complete']=isset($procom->profile_complete)?$procom->profile_complete:"";
		        }
		        else{
		        	$data1['profile_complete']='';
		        }

		        
			}else{
				$this->db->select('*');
				$this->db->where('uid',$res->uid);
				$this->db->from('host_detail');
				$datas = $this->db->get()->row();
				$data1['userpic'] = "";

				if(isset($datas) && !empty($datas)){
					$data1['userpic']= $datas->userpic;
				}

				$this->db->select('count(id) as cnt');
		        $this->db->where('uid',$res->uid);
		        $this->db->from('host_detail');
		        $queryc = $this->db->get();
		        $count = $queryc->row()->cnt;
		        //echo $this->db->last_query();

		        $this->db->select('*');
		        $this->db->where('uid',$res->uid);
		        $this->db->from('host_detail');
		        $queryc1 = $this->db->get();
		        $procom = $queryc1->row();

		        if($count > 0){
		        	$data1['profile_complete']=isset($procom->profile_complete)?$procom->profile_complete:"";
		        }
		        else{
		        	$data1['profile_complete']='';
		        }
			}

			return $data1;
		}else{
			return 0;
		}

	}
 	public function appregister_user($type)
	{
		$email= $type['email'];
		
		$query = $this->db->get_where('user_master',array('email'=>$email))->num_rows();

		if($query == 0){
			return true;
		}else{
			return false;
		}
	}

	public function register_user($type)
	{
	
		$firstname= $type['firstname'];
		$lastname= $type['lastname'];
		$password= $type['password'];
		$email= $type['email'];
		$device_id= $type['device_id'];
		$token= $type['token'];

		$query = $this->db->get_where('user_master',array('email'=>$email))->num_rows();

		if($query == 0){
			//echo "yes";
			//exit;
			$post_data = array('password'=>md5($password),'email'=>$email,'device_id'=>$device_id,'token'=>$token,'status'=>0,'firstname'=>$firstname,'lastname'=>$lastname);
    		$res = $this->db->insert('user_master',$post_data);

    		$uid = $this->db->insert_id();
		    	
	    	$data1['uid'] = $uid;
			$data1['email'] = $email;
			
			return $data1;
		}
		else
		{
			return $query;
		}

	}
	function __destruct() {
        $this->db->close();
    }

}	 