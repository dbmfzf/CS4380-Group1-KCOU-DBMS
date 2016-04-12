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
		$did = rbac_conf(array('INFO','did'));
		$query = $this->db->query("SELECT COUNT(1) as cnt FROM department");
		$cnt_data = $query->row_array();
		//page
		$this->load->library('pagination');
		$config['base_url'] = site_url("info/user/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 35;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$role_dept_query = $this->db->query("Select d.did, d.name as dname, d.rid, r.name as rname from department d, role r WHERE r.rid = d.rid and d.did = '{$did}'");
		$role_dept_data = $role_dept_query->row_array();
		$rolename = $role_dept_data['rname'];
		if(($rolename="Manager")or($rolename="Volunteer")){$where="";} else{$where = "AND D.did ='".$did."'";}
		$query = $this->db->query("SELECT d.name as dname, r.name as rname FROM department d, role r WHERE r.rid = d.rid  ".$where." LIMIT ".(($page-1)*$config['per_page']).",".$config['per_page']."");
		$data = $query->result();
		$this->load->view("info/department",array("data"=>$data));
	}
	/**
	 * Edit departments
	 */
	public function edit($did){
		$department_query = $this->db->query("SELECT d.did,d.name as dname,d.rid FROM department d WHERE d.did = '".$did."' limit 1");
		$department_data = $department_query -> row_array();
		 
		$rolename = $this->db->query("SELECT r.rid, r.name as rname from role r, department d where d.rid = R.rid and d.did = '".$did."' limit 1");
		$current_role = $rolename -> row_array();
		
		
		$data['did'] = $department_data['did'];
		$data['name'] = $department_data['dname'];
		
		$data['rolename'] = $current_role['rname'];
		$data['rid'] = $current_role['rid'];


		
		if($data){
			if($this->input->post()){
				$name = $this->input->post("dname");
				$rolename = $this->input->post("rname");
				
				$role_dept_query = $this->db->query("SELECT rid from role WHERE rname = ".$rolename."");
				$role_dept_data = $role_dept_query->row_array();
				$rid = $role_dept_data['rid'];

				if($uid!=""){
					if($did&&$name&&$rolename){
						$rsql = "UPDATE department, set name='{$rolename}' name='{$rolename}' WHERE uid = '{$uid}'";
						$this->db->query($sql);
						$sql = "UPDATE Belongs_to set did = $dept WHERE uid = '{$uid}'";
						$this->db->query($dsql);
						success_redirct("info/department/index","Edit successful!");
					}else{
						error_redirct("","The department's information is not complete!");
					}
				}else{
					error_redirct("","No user is found!");
				}
			}
			$this->load->view("info/department/edit",array("data"=>$data,"role_data"=>$role_data,"dept_data"=>$dept_data));
		}else{
			error_redirct("info/department/index","No user is found!");
		}
	}
	/**
	 * Add departments
	 */
	public function add(){
		
		$role_query = $this->db->query("SELECT rid,name FROM role order by rid desc");
		$role_data = $role_query->result();
		
		$dept_query = $this->db->query("SELECT did,name FROM department order by did desc");
		$dept_data = $dept_query->result();
		
		if($this->input->post()){
			$dname = $this->input->post("dname");
			
			$rolename = $this->input->post("rolename");
			$role_dept_query = $this->db->query("SELECT d.did from department d, role r WHERE d.rid = r.rid and r.name = ".$rolename."");
			$role_dept_data = $role_dept_query->row_array();
			$did = $role_dept_data['did'];
		
			if($dname&&$rolename){
				$query = $this->db->query("SELECT * FROM department WHERE did = '".$did."'");
				$data = $query->row_array();
				if(!$data){
					$query = $this->db->query("SELECT * FROM User WHERE email = '".$email."'");
						$data = $query->row_array();
						if(!$data){
							if(!$did){$newdept = $did;}else{$newdept = $dept;}
							if(!$status){$newstat = "0";}else{$newstat = "1";}
							$sql = "INSERT INTO User (uid,fullname,gender,email,phone,birth,password,rid,status) values('{$uid}','{$fullname}','{$gender}','{$email}','{$phone}','{$birth}','{$password2}','{$role}', '{$newstat}')";
							$this->db->query($sql);
							$dsql = "INSERT INTO Belongs_to(uid,did) values('{$uid}','{$newdept}')";
							$this->db->query($dsql);
							success_redirct("info/department/index","Add successful!");
					}else{
						error_redirct("","The department already exists!");
					}
					
				}else{
					error_redirct("","The user's information is not complete!");
			}
		}
		$this->load->view("info/department/add",array("role_data"=>$role_data,"dept_data"=>$dept_data));
	}
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
			error_redirct("info/department/index","No user is found!");
		}
	}
}
