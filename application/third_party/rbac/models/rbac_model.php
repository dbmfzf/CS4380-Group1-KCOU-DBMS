<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rbac_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/*
	 * Get privileges list
	*/
	public function get_acl($role_id){
		$query = $this->db->query("SELECT N.node_id,N.directory,N.controller,N.func FROM Node N, Authorizes A WHERE N.node_id = A.node_id AND rid = '{$role_id}'");
		$role_data = $query->result();
		foreach($role_data as $vo){
			$Tmp_role[$vo->directory][$vo->controller][$vo->func] = TRUE;
		}
		rbac_conf(array('ACL'),$Tmp_role);
	}
	
	/*
	 * check user
	*/
	public function check_user($uid,$password){
		$query = $this->db->query("SELECT uid,password,phone,email,rid,status FROM User WHERE uid = '".$uid."' LIMIT 1");
		$data  = $query->row_array();
		if($data){
			if($data['status']==1){
				if($data['password']==$password){
					rbac_conf(array('INFO','uid'),$data['uid']);
					rbac_conf(array('INFO','rid'),$data['rid']);
					rbac_conf(array('INFO','email'),$data['email']);
					rbac_conf(array('INFO','phone'),$data['phone']);
					$this->get_acl($data['rid']);
					return TRUE;
				}
				else{
					return "Invalid password!";
				}
			}else{
				return "Sorry, this user is disabled!";
			}
		}else{
			return "Invalid user id!";
		}
	}
	
}
