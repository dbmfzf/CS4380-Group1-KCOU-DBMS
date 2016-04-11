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
	 * User index
	 * @param number $page
	 */
	public function index($page=1)
	{
		$query = $this->db->query("SELECT COUNT(1) as cnt FROM User");
		$cnt_data = $query->row_array();
		//page
		$this->load->library('pagination');
		$config['base_url'] = site_url("info/user/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 35;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$query = $this->db->query("SELECT U.uid,U.fullname,U.gender,U.email,U.phone,U.birth,U.status,R.name as rolename,D.name as deptname FROM Belongs_to B, Department D, User U, Role R WHERE R.rid = U.rid AND B.uid = U.uid AND B.did = D.did LIMIT ".(($page-1)*$config['per_page']).",".$config['per_page']."");
		$data = $query->result();
		$this->load->view("info/user",array("data"=>$data));
	}
	/**
	 * Edit users
	 * @param number $uid
	 */
	public function edit($uid){
		$user_query = $this->db->query("SELECT uid,fullname,gender,birth,email,phone FROM User WHERE uid = '".$uid."' limit 1");
		$user_data = $user_query -> row_array();
		 
		$role = $this->db->query("SELECT R.rid,name from Role R, User U where U.rid = R.rid and U.uid = '".$uid."' limit 1");
		$current_role = $role -> row_array();
		
		$dept = $this->db->query("SELECT did,name from Department D, Belongs_to B, User U where U.uid = B.uid and D.did = B.did and U.uid = '".$uid."' limit 1");
		$current_dept = $dept -> row_array();
		
		$data['fullname'] = $user_data['fullname'];
		$data['gender'] = $user_data['gender'];
		$data['email'] = $user_data['email'];
		$data['phone'] = $user_data['phone'];
		$data['birth'] = $user_data['birth'];
		$data['role'] = $current_role['name'];
		$data['rid'] = $current_role['rid'];
		
		$data['dept'] = $current_dept['name'];
		$data['did'] = $current_dept['name'];
		
		$role_query = $this->db->query("SELECT rid,name FROM Role WHERE status = 1 order by rid desc");
		$role_data = $role_query->result();
		$dept_query = $this->db->query("SELECT did,name FROM Department order by did desc");
		$dept_data = $dept_query->result();
		
		if($data){
			if($this->input->post()){
				$fullname = $this->input->post("fullname");
				$gender = $this->input->post("gender");
				$email = $this->input->post("email");
				$phone = $this->input->post("phone");
				$birth = $this->input->post("birth");
				$role = $this->input->post("role");
				$dept = $this->input->post("dept");
				$status = $this->input->post("status");
				$password = $this->input->post("password");
				$password2 = $this->input->post("password2");
				if($uid!=""){
					if($password==$password2){
						if($uid&&$fullname&&$gender&&$email&&$phone&&$birth&&$role&&$dept&&$status){
							if($password){$newpass = ",password='".md5($password2)."'";}else{$newpass="";}
							if($status){$newstat = ",status='1'";}else{$newstat = ",status='0'";}
							if($role){$newrole = ",rid={$role}";}else{$newrole = ",rid=NULL";}
							if($dept){$newdept = ",did={$dept}";}else{$newdept = ",did=NULL";}
							$sql = "UPDATE User set fullname='{$fullname}',gender = '{$gender}',email='{$email}',phone = '{$phone}',birth = '{$birth}' {$newpass} {$newstat} {$newrole} WHERE uid = '{$uid}'";
							$this->db->query($sql);
							$dsql = "UPDATE Belongs_to set {$newdept} WHERE uid = '{$uid}'";
							$this->db->query($dsql);
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
			$this->load->view("info/user/edit",array("data"=>$data,"role_data"=>$role_data,"dept_data"=>$dept_data));
		}else{
			error_redirct("info/user/index","No user is found!");
		}
	}
	/**
	 * Add users
	 */
	public function add(){
		
		$role_query = $this->db->query("SELECT rid,name FROM Role WHERE status = 1 order by rid desc");
		$role_data = $role_query->result();
		
		$dept_query = $this->db->query("SELECT did,name FROM Department order by did desc");
		$dept_data = $dept_query->result();
		
		if($this->input->post()){
			$uid = $this->input->post("uid");
			$fullname = $this->input->post("fullname");
			$gender = $this->input->post("gender");
			$email = $this->input->post("email");
			$phone = $this->input->post("phone");
			$birth = $this->input->post("birth");
			$role = $this->input->post("role");
			$dept = $this->input->post("dept");
			$status = $this->input->post("status");
			$password = $this->input->post("password");
			$password2 = $this->input->post("password2");
			if($password==$password2){
				if($uid&&$fullname&&$gender&&$email&&$phone&&$birth&&$role&&$dept&&$status){
					$query = $this->db->query("SELECT * FROM User WHERE uid = '".$uid."'");
					$data = $query->row_array();
					if(!$data){
						$query = $this->db->query("SELECT * FROM User WHERE email = '".$email."'");
						$data = $query->row_array();
						if(!$data){
							if(!$status){$newstat = "0";}else{$newstat = "1";}
							$sql = "INSERT INTO User (uid,fullname,gender,email,phone,birth,password,rid,status) values('{$uid}','{$fullname}','{$gender}','{$email}','{$phone}','{$birth}','{$password2}','{$role}', '{$status}')";
							$this->db->query($sql);
							$dsql = "INSERT INTO Belongs_to(uid,did) values('{$uid}','{$dept}')";
							$this->db->query($dsql);
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
		$this->load->view("info/user/add",array("role_data"=>$role_data,"dept_data"=>$dept_data));
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

