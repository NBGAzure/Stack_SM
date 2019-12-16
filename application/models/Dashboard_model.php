<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	function __construct() {
        parent::__construct();
        $this->load->database();
		
	//	$sql = "CALL dashboard(1)";
		//$this->db->query($sql);
		//exit;
	}

	/*function dashboard($data){
		//$data = $this->db->get_where("dashboard",array("uid"=>$data['uid']))->result_array();
		$data = $this->db->query("select um.uid as uid,sk.cat_name as user_category,events.uid as event_user_id,ad.firstname as event_user_firstname,ad.lastname as event_user_lastname,events.event_id,events.event_name,events.create_date as event_create_date,epc.like_count as event_like,epc.comment_count as event_comment,epc.sharing_count as event_shares,epc.sharing_count as event_location from user_master as um INNER JOIN artist_detail as ad ON um.uid=ad.uid LEFT JOIN category_management as cm on um.uid=cm.uid LEFT JOIN skill_category as sk on sk.cat_id=cm.cat_id INNER JOIN events on um.uid=events.uid LEFT JOIN event_post_counts as epc ON events.event_id=epc.event_id where sk.cat_parent=0 group BY events.event_id")->result_array();
		//print_r($data);
		return $data;
	}*/
	
	function dashboard($post){

		$limit = PAGINATION_LIMIT;
		$page = $post['page'];
		$uid = $post['uid'];
		$role = $post['role'];

		if($role == 1){
			$this->db->select('um.uid as uid,sk.cat_name as user_category,events.uid as event_user_id,ad.firstname as event_user_firstname,ad.lastname as event_user_lastname,ad.userpic as userpic,hd.firstname as event_user_host_firstname,hd.lastname as event_user_host_lastname,hd.userpic as host_userpic,events.event_id,events.event_name,events.event_description,events.create_date as event_create_date,epc.like_count as event_like,epc.comment_count as event_comment,epc.sharing_count as event_shares,epc.sharing_count as event_location, gp.*');
			$this->db->from('user_master as um');
			$this->db->join('artist_detail as ad', 'um.uid=ad.uid', 'left');
			$this->db->join('host_detail as hd', 'um.uid=hd.uid', 'left');
			$this->db->join('category_management as cm', 'um.uid=cm.uid', 'left');
			$this->db->join('skill_category as sk', 'sk.cat_id=cm.cat_id', 'left');
			$this->db->join('events', 'um.uid=events.uid', 'inner');
			$this->db->join('event_post_counts as epc', 'events.event_id=epc.event_id', 'left');
			$this->db->join('gig_post as gp', 'gp.host_id!=um.uid', 'left');
			$this->db->where("sk.cat_parent",0);
			$this->db->where("um.uid",$uid );
			$this->db->group_by("events.event_id");
			$this->db->limit($limit,$page*$limit);
			$data = $this->db->get()->result_array();
		}
		else{
			$this->db->select('um.uid as uid,sk.cat_name as user_category,events.uid as event_user_id,hd.firstname as event_user_host_firstname,hd.lastname as event_user_host_lastname,hd.userpic as host_userpic,events.event_id,events.event_name,events.event_description,events.create_date as event_create_date,epc.like_count as event_like,epc.comment_count as event_comment,epc.sharing_count as event_shares,epc.sharing_count as event_location');
			$this->db->from('user_master as um');
			$this->db->join('host_detail as hd', 'um.uid=hd.uid', 'inner');
			$this->db->join('category_management as cm', 'um.uid=cm.uid', 'left');
			$this->db->join('skill_category as sk', 'sk.cat_id=cm.cat_id', 'left');
			$this->db->join('events', 'um.uid=events.uid', 'inner');
			$this->db->join('event_post_counts as epc', 'events.event_id=epc.event_id', 'left');
			//$this->db->join('event_media as em', 'events.event_id=em.event_id', 'left');
			$this->db->where("sk.cat_parent",0);
			$this->db->where("um.uid",$uid );
			$this->db->group_by("events.event_id");
			$this->db->limit($limit,$page*$limit);
			$data = $this->db->get()->result_array();
		}
		

		//echo $this->db->last_query();
		return $data;
	}
	
	function get_media($event_id){
		$this->db->select('media_path');
		$this->db->where("event_id",$event_id );
		$media = $this->db->get('event_media')->result_array();
		return $media;
	}
	

    function __destruct() {
        $this->db->close();
    }

}	 