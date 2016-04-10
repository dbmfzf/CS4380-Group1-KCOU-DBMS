<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC管理后台中用户模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class User extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * profiles
	 * 
	 */
	public function index()
	{
		$uid = rbac_conf(array('INFO','uid'));
		
		$user_query = $this->db->query("SELECT fullname,gender FROM User WHERE uid = '".$uid."' limit 1");
		$user_data = $user_query -> row_array();
		 
		$role_query = $this->db->query("SELECT name from Role R, User U where U.rid = R.rid and U.uid = '".$uid."' limit 1");
		$role_data = $role_query -> row_array();
		
		$dept_query = $this->db->query("SELECT name from Department D, Belongs_to B, User U where U.uid = B.uid and D.did = B.did and U.uid = '".$uid."' limit 1");
		$dept_data = $dept_query -> row_array();
		
		$login_query = $this->db->query("SELECT * FROM Login_record WHERE uid = '".$uid."' AND log_id != (SELECT MAX(log_id) FROM Login_record WHERE uid = '".$uid."') order by log_id desc limit 1");
		$login_data = $login_query -> row_array();
		
		$data['fullname'] = $user_data['fullname'];
		$data['gender'] = $user_data['gender'];
		$data['role'] = $role_data['name'];
		$dept_data['name'] == NULL?$data['dept'] = "No department!":$data['dept'] = $dept_data['name'];
		$login_data['date_time'] ==NULL?$data['last_login_time'] = "First login!":$data['last_login_time'] = $login_data['date_time'];
		$login_data['ip']== NULL?$data['last_login_ip'] = "First login!":$data['last_login_ip'] = $login_data['ip'];
		
		$data = $query->result();
		$this->load->view("info/profile",array("data"=>$data));
	}
	/**
	 * edit profile
	 * 
	 */
	public function edit(){
		$uid = rbac_conf(array('INFO','uid')); 
		$query = $this->db->query("SELECT U.*,name FROM User U LEFT JOIN Role R ON R.rid = U.rid WHERE U.uid = '".$uid."'");
		$data = $query->row_array();
		$role_query = $this->db->query("SELECT rid,name FROM Role WHERE status = 1");
		$role_data = $role_query->result();
		if($data){
			if($this->input->post()){
				$uid = $this->input->post("uid");
				$fullname = $this->input->post("fullname");
				$email = $this->input->post("email");
				$role = $this->input->post("role");
				$status = $this->input->post("status");
				$password = $this->input->post("password");
				$password2 = $this->input->post("password2");
				if($uid!=""){
					if($password==$password2){
						if($uid){
							if($password){$newpass = ",password='".md5($password2)."'";}else{$newpass="";}
							if($status){$newstat = ",status='1'";}else{$newstat = ",status='0'";}
							if($role){$newrole = ",rid={$role}";}else{$newrole = ",rid=NULL";}
							$sql = "UPDATE User set fullname='{$fullname}',email='{$email}' {$newpass} {$newstat} {$newrole} WHERE uid = '{$uid}'";
							$this->db->query($sql);
							success_redirct("info/profile/index","Edit successful!");
						}else{
							error_redirct("","The user's information is not complete!");
						}
					}else{
						error_redirct("","Invaild password!");
					}
				}else{
					error_redirct("","No user is found!");
				}
			}
			$this->load->view("info/profile/edit",array("data"=>$data,"role_data"=>$role_data));
		}else{
			error_redirct("info/profile/index","No user is found!");
		}
	}
	/**
	 * reset password
	 */
	public function reset(){
		$uid = rbac_conf(array('INFO','uid'));
		$role_query = $this->db->query("SELECT rid,name FROM Role WHERE status = 1");
		$role_data = $role_query->result();
		if($this->input->post()){
			$uid = $this->input->post("uid");
			$fullname = $this->input->post("fullname");
			$email = $this->input->post("email");
			$role = $this->input->post("role");
			$status = $this->input->post("status");
			$password = md5($this->input->post("password"));
			$password2 = md5($this->input->post("password2"));
			if($password==$password2){
				if($uid&&$fullname&&$email&&$password2){
					$query = $this->db->query("SELECT * FROM User WHERE uid = '".$uid."'");
					$data = $query->row_array();
					if(!$data){
						$query = $this->db->query("SELECT * FROM User WHERE email = '".$email."'");
						$data = $query->row_array();
						if(!$data){
							if(!$status){$newstat = "0";}else{$newstat = "1";}
							$sql = "INSERT INTO User (uid,fullname,email,password,rid,status) values('{$uid}','{$fullname}','{$email}' ,'{$password2}','{$role}', '{$status}')";
							$this->db->query($sql);
							success_redirct("info/profile/index","Add successful!");
						}else{
							error_redirct("","The email already exists!");
						}
					}else{
						error_redirct("","The user ID already exists!");
					}
					
				}else{
					error_redirct("","The user's information is not complete!");
				}
			}else{
				error_redirct("","Invalid password!");
			}
		}
		$this->load->view("info/profile/reset",array("role_data"=>$role_data));
	}

}


