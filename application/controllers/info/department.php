<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * Department index
	 */
	public function index($page=1)
	{
		$query = $this->db->query("SELECT COUNT(1) as cnt FROM department");
		$cnt_data = $query->row_array();
		//page
		$this->load->library('pagination');
		$config['base_url'] = site_url("info/department/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 5;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$dept_query = $this->db->query("Select did, name as dname,description from department ORDER BY dname");
		$data = $dept_query->result();
		$this->load->view("info/department",array("data"=>$data));
	}
	/**
	 * See all users
	 */
	
	public function see_all($did)
	{
		$department_query = $this->db->query("SELECT d.did,d.name as dname FROM department d WHERE d.did = '".$did."' limit 1");
		$department_data = $department_query -> row_array();
	
		//$data['did'] = $department_data['did'];
		//$data['dname'] = $department_data['dname'];
		//$data['description'] = $department_data['description'];
		//$data['rid'] = $department_data['rid'];
		//$data['rname'] = $department_data['rname'];
		//$data['uid'] = $department_data['uid'];
		//$data['uname'] = $department_data['uname'];
		//$data['gender'] = $department_data['gender'];
		//$data['birth'] = $department_data['birth'];
		//$data['email'] = $department_data['email'];
		//$data['phone'] = $department_data['phone'];
	
	
		//if($department_data){
			$dept_query = $this->db->query("SELECT d.did,d.name as dname,d.description, r.rid, r.name as rname, u.uid, u.fullname as uname, u.gender, u.birth, u.email, u.phone, u.status FROM department d, role r, user u WHERE d.did = '".$did."' and d.did = r.did and r.rid = u.rid ORDER BY U.uid");
			$data = $dept_query->result();
			//if ($data)
			//{
				$this->load->view("info/department/see_all",array("data"=>$data, "department_data"=>$department_data));
		//	}else{
				//error_redirct("info/department/index","No user in this department!");
			//}
			//$rname = $this->input->post("rname");
	
			//$role_dept_query = $this->db->query("SELECT rid from role WHERE rname = ".$rname."");
			//$role_dept_data = $role_dept_query->row_array();
			//$rid = $role_dept_data['rid'];
	
		//}else{
			//error_redirct("info/department/index","No user in this department!");
		//}
	}
	
	/**
	 * Edit departments
	 */
	public function edit($did){
		$department_query = $this->db->query("SELECT d.did,d.name as dname,d.description FROM department d WHERE d.did = '".$did."' limit 1");
		$department_data = $department_query -> row_array();
		 
		//$rolename = $this->db->query("SELECT r.rid, r.name as rname from role r, department d where d.rid = R.rid and d.did = '".$did."' limit 1");
		//$current_role = $rolename -> row_array();
		
		
		$data['did'] = $department_data['did'];
		$data['dname'] = $department_data['dname'];
		$data['description'] = $department_data['description'];
		
		//$data['rname'] = $current_role['rname'];
		//$data['rid'] = $current_role['rid'];


		
		if($data){
			if($this->input->post()){
				$dname = $this->input->post("dname");
				$description = $this->input->post("description");
				//$rname = $this->input->post("rname");
				
				//$role_dept_query = $this->db->query("SELECT rid from role WHERE rname = ".$rname."");
				//$role_dept_data = $role_dept_query->row_array();
				//$rid = $role_dept_data['rid'];

				if($did!=""){
					if($did&&$dname){
						$query = $this->db->query("SELECT * FROM department WHERE name = '{$dname}' and did != '{$did}'");
						$result = $query -> row_array();
						if(!$result){
							$sql = "UPDATE department set name='{$dname}' , description='{$description}' WHERE did = '{$did}'";
							$this->db->query($sql);
							$sql = "UPDATE role set dname = '{$dname}' WHERE did = '{$did}'";
							$this->db->query($sql);
							success_redirct("info/department/index","Edit successful!");
						}else{
							error_redirct("","The department's name already exist!");
						}
					}else{
						error_redirct("","The department's information is not complete!");
					}
				}else{
					error_redirct("","No department is found!");
				}
			}

			$this->load->view("info/department/edit",array("data"=>$data ));
		}else{
			error_redirct("info/department/index","No department is found!");
		}
	}
	/**
	 * Add departments
	 */
	public function add(){
		
		//$role_query = $this->db->query("SELECT rid,name as rname FROM role order by rid desc");
		//$role_data = $role_query->result();
		
		$dept_query = $this->db->query("SELECT did,name as dname,description FROM department order by did desc");
		$dept_data = $dept_query->result();
		
		if($this->input->post()){
			$dname = $this->input->post("dname");
			$description = $this->input->post("description");
			
			//$rname = $this->input->post("rname");
			//$role_dept_query = $this->db->query("SELECT rid from role r WHERE name = ".$rname."");
			//$role_dept_data = $role_dept_query->row_array();
			//$rid = $role_dept_data['rid'];
		
			if($dname){
				$query = $this->db->query("SELECT * FROM departments WHERE dname = '{$dname}'");
				$result = $query -> row_array();
				if(!$result){
					$sql = "INSERT INTO department (name,description) values('{$dname}','{$description}')";
					$this->db->query($sql);
					success_redirct("info/department/index","Add successful!");
				}else{
					error_redirct("","The department's name already exists!");
				}
			}
		}
		$this->load->view("info/department/add",array("dept_data"=>$dept_data));
	}
	/**
	 * Delete departments
	 */
	public function delete($did){
		$query = $this->db->query("SELECT * FROM department WHERE did = '".$did."' ");
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM department WHERE did = '".$did."' ";
					$this->db->query($sql);
					success_redirct("info/department/index","Delete successful!");
				}else{
					error_redirct("info/department/index","Failed to delete!");
				}
			}
			$this->load->view("info/department/delete",array("data"=>$data));
		}else{
			error_redirct("info/department/index","No department is found!");
		}
	}
	/**
	 * User edit
	 */
	
	public function user_edit($uid){
	
		$user_query = $this->db->query("SELECT uid,fullname,gender,birth,email,phone,status FROM User WHERE uid = '".$uid."' limit 1");
		$user_data = $user_query -> row_array();
			
		$current_role_dept_query = $this->db->query("SELECT R.rid,R.name as rolename,D.name as deptname, D.did FROM Role R, User U, Department D WHERE D.did = R.did AND U.rid = R.rid AND U.uid = '".$uid."' limit 1");
		$current_role_dept_data = $current_role_dept_query -> row_array();

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
		$data['did'] = $current_role_dept_data['did'];
		
		$role_dept_query = $this->db->query("SELECT rid,R.name AS rolename, D.name AS deptname FROM Role R, Department D WHERE R.did = D.did and D.did = '".$data['did']."' AND status = 1 order by rid desc");
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
				if($uid!=""){
					if($uid&&$fullname&&$gender&&$email&&$phone&&$birth&&$role){
						if($status){$newstat = ",status='1'";}else{$newstat = ",status='0'";}
						$sql = "UPDATE User set fullname='{$fullname}',gender = '{$gender}',email='{$email}',phone = '{$phone}',birth = '{$birth}',rid='{$role}'{$newstat} WHERE uid = '{$uid}'";
						$this->db->query($sql);
						success_redirct("info/department/see_all/".$data['did']."","Edit successful!");
					}else{
						error_redirct("","The user's information is not complete!");
					}
				}else{
					error_redirct("","No user is found!");
				}
			}
			$this->load->view("info/department/user_edit",array("data"=>$data,"role_dept_data"=>$role_dept_data));
		}else{
			error_redirct("info/department/see_all","No user is found!");
		}
	}
	/**
	 * Add users
	 */
	public function user_add($did){
	
		//$role_query = $this->db->query("SELECT rid,name as rname FROM role order by rid desc");
		//$role_data = $role_query->result();
			
		$current_role_dept_query = $this->db->query("SELECT D.name as deptname, D.did FROM Department D WHERE D.did = '".$did."' limit 1");
		$current_role_dept_data = $current_role_dept_query -> row_array();
	
		$role_dept_query = $this->db->query("SELECT r.rid,r.name as rolename from role r WHERE r.did = '".$did."'");
		$role_dept_data = $role_dept_query->result();
		if($this->input->post()){
			$uid = $this->input->post("uid");
			$uname = $this->input->post("fullname");
			$gender = $this->input->post("gender");
			$email = $this->input->post("email");
			$phone = $this->input->post("phone");
			$birth = $this->input->post("birth");
			$rolename = $this->input->post("rolename");
			$status = $this->input->post("status");
			$user_query = $this->db->query("SELECT * from user WHERE uid = '".$uid."'");
			$user_data = $user_query->result();
			if ($user_data)
			{
				error_redirct("","The user already exists!");
			}
	
			if($uid&&$fullname&&$gender&&$email&&$phone&&$birth&&$role){
				if(!$status){$newstat = "0";}else{$newstat = "1";}
				
				$sql = "INSERT INTO User (uid,fullname,gender,email,phone,birth,rid,status) values('{$uid}','{$fullname}','{$gender}','{$email}','{$phone}','{$birth}','{$rid}', '{$newstat}')";
				$this->db->query($sql);
				success_redirct("info/department/see_all/".$data['did']."","Add successful!");
			}else{
				error_redirct("","The user information is not completed!");
			}
		}
		$this->load->view("info/department/user_add",array("role_dept_data"=>$role_dept_data,"current_role_dept_data"=>$current_role_dept_data));
	}
	
	
	
	/**
	 * Delete users
	 */
	public function user_delete($uid){
		$query = $this->db->query("SELECT * FROM user u WHERE u.uid = '".$uid."' ");
		$data = $query->row_array();
		$department_query = $this->db->query("SELECT d.did,d.name as dname,d.description, r.rid, r.name as rname, u.uid, u.fullname as uname, u.gender, u.birth, u.email, u.phone FROM department d, role r, user u WHERE d.did = r.did and r.rid = u.rid and u.uid = '".$uid."' limit 1");
		$department_data = $department_query -> row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM user WHERE uid = '".$uid."' ";
					$this->db->query($sql);
					success_redirct("info/department/see_all/'".$department_data['did']."'","Delete successful!");
				}else{
					error_redirct("","Failed to delete!");
				}
			}
			$this->load->view("info/department/user_delete",array("data"=>$data,"department_data"=>$department_data));
		}else{
			error_redirct("info/department/index","No department is found!");
		}
	}
	}
	
	/*sad*/
