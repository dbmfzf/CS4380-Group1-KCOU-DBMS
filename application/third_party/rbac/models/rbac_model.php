<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * 模型
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Rbac_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/*
	 * 获取权限列表
	*/
	public function get_acl($role_id){
		$query = $this->db->query("SELECT node_id,directory,controller,func FROM Node WHERE node_id in (SELECT node_id FROM Authorizes WHERE rid = ".$role_id.")");
		$role_data = $query->result();
		foreach($role_data as $vo){
			$Tmp_role[$vo->directory][$vo->controller][$vo->func] = TRUE;
		}
		rbac_conf(array('ACL'),$Tmp_role);
	}
	
	/*
	 * 用户登录检测
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
