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
		$dept_query = $this->db->query("Select did, name as dname,description from department d");
		$data = $dept_query->result();
		$this->load->view("info/department",array("data"=>$data));
	}
	
	
	public function see_all($did)
	{
		$department_query = $this->db->query("SELECT d.did,d.name as dname,d.description, r.rid, r.name as rname, u.uid, u.fullname as uname, u.gender, u.birth, u.email, u.phone FROM department d, role r, user u WHERE d.did = '".$did."' and d.did = r.did and r.rid = u.rid limit 1");
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
	
	
		if($department_data){
			$dept_query = $this->db->query("SELECT d.did,d.name as dname,d.description, r.rid, r.name as rname, u.uid, u.fullname as uname, u.gender, u.birth, u.email, u.phone, u.status FROM department d, role r, user u WHERE d.did = '".$did."' and d.did = r.did and r.rid = u.rid ");
			$data = $dept_query->result();
			$this->load->view("info/department/see_all",array("data"=>$data));
			//$rname = $this->input->post("rname");
	
			//$role_dept_query = $this->db->query("SELECT rid from role WHERE rname = ".$rname."");
			//$role_dept_data = $role_dept_query->row_array();
			//$rid = $role_dept_data['rid'];
	
		}else{
			error_redirct("info/department/index","No user in this department!");
		}
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
						$sql = "UPDATE department set name='{$dname}' , description='{$description}' WHERE did = '{$did}'";
						$this->db->query($sql);
						success_redirct("info/department/index","Edit successful!");
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
					$sql = "INSERT INTO department (name,description) values('{$dname}','{$description}')";
					$this->db->query($sql);
					success_redirct("info/department/index","Add successful!");
					}else{
						error_redirct("","The department already exists!");
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
					error_redirct("info/department/index","Delete failed!");
				}
			}
			$this->load->view("info/department/delete",array("data"=>$data));
		}else{
			error_redirct("info/department/index","No department is found!");
		}
	}
	
	public function user_edit($uid){
	
		$user_query = $this->db->query("SELECT uid,fullname,gender,birth,email,phone,status FROM User WHERE uid = '".$uid."' limit 1");
		$user_data = $user_query -> row_array();
			
		$current_role_dept_query = $this->db->query("SELECT R.rid,R.name as rolename,D.name as deptname FROM Role R, User U, Department D WHERE D.did = R.did AND U.rid = R.rid AND U.uid = '".$uid."' limit 1");
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
	
		$role_dept_query = $this->db->query("SELECT rid,R.name AS rolename, D.name AS deptname FROM Role R, Department D WHERE R.did = D.did and D.did = '".$did."' AND status = 1 order by rid desc");
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
						$sql = "UPDATE User set fullname='{$fullname}',gender = '{$gender}',email='{$email}',phone = '{$phone}',birth = '{$birth}',rid='{$role}',{$newstat} WHERE uid = '{$uid}'";
						$this->db->query($sql);
						success_redirct("info/department/see_all","Edit successful!");
					}else{
						error_redirct("","The user's information is not complete!");
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
	 * Delete departments
	 */
	public function user_delete($uid){
		$query = $this->db->query("SELECT * FROM user u WHERE u.uid = '".$uid."' ");
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM user WHERE uid = '".$uid."' ";
					$this->db->query($sql);
					success_redirct("info/department/see_all","Delete successful!");
				}else{
					error_redirct("info/department/see_all","Delete failed!");
				}
			}
			$this->load->view("info/department/user_delete",array("data"=>$data));
		}else{
			error_redirct("info/department/see_all","No department is found!");
		}
	}
	}
	
	