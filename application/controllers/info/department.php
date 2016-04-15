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
		$config['per_page']   = 35;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$dept_query = $this->db->query("Select did, name as dname,description from department d");
		$data = $dept_query->result();
		$this->load->view("info/department",array("data"=>$data));
	}
	/**
	 * Edit departments
	 */
	public function edit($did){
		$department_query = $this->db->query("SELECT d.did,d.name as dname,description FROM department d WHERE d.did = '".$did."' limit 1");
		$department_data = $department_query -> row_array();
		 
		//$rolename = $this->db->query("SELECT r.rid, r.name as rname from role r, department d where d.rid = R.rid and d.did = '".$did."' limit 1");
		//$current_role = $rolename -> row_array();
		
		
		$data['did'] = $department_data['did'];
		$data['dname'] = $department_data['dname'];
		$data['description'] = $department_data['dsecription'];
		
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
						$rsql = "UPDATE department, set name='{$dname}' , description='{$description}' WHERE did = '{$did}'";
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
			error_redirct("info/department/index","No user is found!");
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
				$query = $this->db->query("SELECT * FROM department WHERE did = '".$did."'");
				$data = $query->row_array();
				if(!$data){
					$sql = "INSERT INTO department (name,description) values('{$dname}','{$description}')";
					$this->db->query($sql);
					success_redirct("info/department/index","Add successful!");
					}else{
						error_redirct("","The department already exists!");
					}		
				}else{
					error_redirct("","The department's information is not complete!");
			}
		}
		$this->load->view("info/department/add",array("role_data"=>$role_data,"dept_data"=>$dept_data));
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
}
