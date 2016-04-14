<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * User index
	 * @param number $page
	 */
	public function index($page=1)
	{
		$login_rid = rbac_conf(array('INFO','rid'));
		
		$query = $this->db->query("SELECT COUNT(1) as cnt FROM User");
		$cnt_data = $query->row_array();
		//page
		$this->load->library('pagination');
		$config['base_url'] = site_url("info/user/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 2;
		$config['uri_segment']= '4';
		$config['num_links']='2';
		$config['first_link'] = 'First';
		$config['last_link'] = 'last';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		
		$role_dept_query = $this->db->query("Select did,name as rolename from Role R WHERE R.rid = '{$login_rid}'");
		$role_dept_data = $role_dept_query->row_array();
		$rolename = $role_dept_data['rolename'];
		$deptid = $role_dept_data['did'];
		
		if($rolename=="Manager"){$where="";} else{$where = "AND D.did = $deptid";}
		$query = $this->db->query("SELECT U.uid,U.fullname,U.gender,U.email,U.phone,U.birth,U.status,R.name as rolename,D.name as deptname FROM Department D, User U, Role R WHERE R.rid = U.rid AND D.did = R.did AND U.rid != '{$login_rid}' ".$where." LIMIT ".(($page-1)*$config['per_page']).",".$config['per_page']."");
		$data = $query->result();
		$this->load->view("info/user",array("data"=>$data));
	}
	/**
	 * Edit users
	 * @param number $uid
	 */
	public function edit($uid){
		
		$user_query = $this->db->query("SELECT uid,fullname,gender,birth,email,phone,status FROM User WHERE uid = '".$uid."' limit 1");
		$user_data = $user_query -> row_array();
		 
		$current_role_dept_query = $this->db->query("SELECT R.rid,R.name as rolename,D.name as deptname FROM Role R, User U, Department D WHERE D.did = R.did AND U.rid = R.rid AND U.uid = '".$uid."' limit 1");
		$current_role_dept_data = $current_role_dept_query -> row_array();
		
		$login_rid = rbac_conf(array('INFO','rid'));
		$login_role_query = $this->db->query("SELECT name as rolename from Role where rid = '{$login_rid}'");
		$login_role = $login_role_query->row_array(); 
		
		$data['uid'] = $user_data['uid'];
		$data['fullname'] = $user_data['fullname'];
		$data['gender'] = $user_data['gender'];
		$data['email'] = $user_data['email'];
		$data['phone'] = $user_data['phone'];
		$data['birth'] = $user_data['birth'];
		$data['status'] = $user_data['status'];
		
		$data['rolename'] = $current_role_dept_data['rolename'];
		$data['rid'] = $current_role_dept_data['rid'];
		$data['deptname'] = $current_role_dept_data['deptname'];
		
		$data['login_rolename'] = $login_role['rolename'];
		
		$role_dept_query = $this->db->query("SELECT rid,R.name AS rolename, D.name AS deptname FROM Role R, Department D WHERE R.did = D.did AND status = 1 order by rid desc");
		$role_dept_data = $role_dept_query->result();
		
		if($data){
			if($this->input->post()){
				$fullname = $this->input->post("fullname");
				$gender = $this->input->post("gender");
				$email = $this->input->post("email");
				$phone = $this->input->post("phone");
				$birth = $this->input->post("birth");
				$role = $this->input->post("role");
				$status = $this->input->post("status");
				$password = $this->input->post("password");
				$password2 = $this->input->post("password2");
				if($uid!=""){
					if($password==$password2){
						if($uid&&$fullname&&$gender&&$email&&$phone&&$birth&&$role){
							if($password){$newpass = ",password='".md5($password2)."'";}else{$newpass="";}
							if($status){$newstat = ",status='1'";}else{$newstat = ",status='0'";}
							$sql = "UPDATE User set fullname='{$fullname}',gender = '{$gender}',email='{$email}',phone = '{$phone}',birth = '{$birth}',rid='{$role}' {$newpass} {$newstat} WHERE uid = '{$uid}'";
							$this->db->query($sql);
							success_redirct("info/user/index","Edit successful!");
						}else{
							error_redirct("","The user's information is not complete!");
						}
					}else{
						error_redirct("","Repeat the wrong password!");
					}
				}else{
					error_redirct("","No user is found!");
				}
			}
			$this->load->view("info/user/edit",array("data"=>$data,"role_dept_data"=>$role_dept_data));
		}else{
			error_redirct("info/user/index","No user is found!");
		}
	}
	
	/**
	 * Add users
	 */
	 
	public function add(){
		
		$role_dept_query = $this->db->query("SELECT rid,R.name as rolename,D.name as deptname FROM Role R, Department D WHERE R.did = D.did AND status = 1 order by rid desc");
		$role_dept_data = $role_dept_query->result();
		
		$login_rid = rbac_conf(array('INFO','rid'));
		$login_role_query = $this->db->query("SELECT name as rolename FROM Role WHERE rid = $login_rid");
		$login_role = $login_role_query->row_array();
		
		$data['login_rolename'] = $login_role['rolename'];
		
		//role and dept info for department leaders;
		
		$role_level_query = $this->db->query("select R.rid,R.name as rolename,D.name as deptname from Role R, Department D where D.did = R.did AND R.rid != $login_rid and D.did = (select did from Role where rid = $login_rid) and level > (select level from Role where rid =$login_rid);");
		$role_level_data = $role_level_query->result();
		
		
		if($this->input->post()){
			$uid = $this->input->post("uid");
			$fullname = $this->input->post("fullname");
			$gender = $this->input->post("gender");
			$email = $this->input->post("email");
			$phone = $this->input->post("phone");
			$birth = $this->input->post("birth");
			$role = $this->input->post("role");
			$status = $this->input->post("status");
			$password = $this->input->post("password");
			$password2 = $this->input->post("password2");
			if($password==$password2){
				if($uid&&$fullname&&$gender&&$email&&$phone&&$birth&&$role){
					$query = $this->db->query("SELECT * FROM User WHERE uid = '".$uid."'");
					$data = $query->row_array();
					if(!$data){
						$query = $this->db->query("SELECT * FROM User WHERE email = '".$email."'");
						$data = $query->row_array();
						if(!$data){
							if(!$status){$newstat = "0";}else{$newstat = "1";}
							$newpass = md5($password2);
							$sql = "INSERT INTO User (uid,fullname,gender,email,phone,birth,password,rid,status) values('{$uid}','{$fullname}','{$gender}','{$email}','{$phone}','{$birth}','{$newpass}','{$role}', '{$newstat}')";
							$this->db->query($sql);
							success_redirct("info/user/index","Add successful!");
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
				error_redirct("","Repeat the wrong password!");
			}
		}
		$this->load->view("info/user/add",array("data"=>$data,"role_dept_data"=>$role_dept_data,"role_level_data"=>$role_level_data));
	}
	/**
	 * Delete users
	 * @param number $id
	 */
	public function delete($uid){
		$query = $this->db->query("SELECT * FROM User WHERE uid = '".$uid."' ");
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM User WHERE uid = '".$uid."' ";
					$this->db->query($sql);
					success_redirct("info/user/index","Delete successful!");
				}else{
					error_redirct("info/user/index","Delete failed!");
				}
			}
			$this->load->view("info/user/delete",array("data"=>$data));
		}else{
			error_redirct("info/user/index","No user is found!");
		}
	}
}

