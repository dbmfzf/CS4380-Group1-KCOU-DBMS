<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * news index
	 */
	public function index($page=1)
	{
		$login_uid = rbac_conf(array('INFO','uid'));
		
		if($uid=="Manager"){
			$where="";
			$cnt_query = $this->db->query("SELECT COUNT(*) as cnt FROM User WHERE rid != $login_rid");
				
		
		}
		else{
			$where = "AND R.did = $deptid AND level > $level";
			$cnt_query = $this->db->query("select count(*) as cnt FROM User U, Role R, Department D where U.rid = R.rid AND D.did = R.did AND D.did = $deptid AND level > $level;");
				
		}
		
		$query = $this->db->query("SELECT COUNT(1) as cnt FROM news n, submits s WHERE s.uid = '{$login_rid}'");
		$cnt_data = $query->row_array();
		//page
		$this->load->library('pagination');
		$config['base_url'] = site_url("info/department/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 5;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid and s.uid = '{$login_uid}'");
		$news_data = $query->result();
		$this->load->view("info/department",array("data"=>$data));
	}
	/**
	 * 	News edit
	 */
	public function edit($nid)
	{
		
		$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = '".$nid."'");
		$news_data = $query->result();
		 
		
		
		$data['nid'] = $news_data['nid'];
		$data['title'] = $news_data['title'];
		$data['type'] = $news_data['type'];
		$data['content'] = $news_data['content'];
		$data['last_modified_time'] = $news_data['last_modified_time'];
		$data['submit_time'] = $news_data['submit_time'];
		


		
		if($data){
			if($this->input->post()){
				$nid = $this->input->post("nid");
				$title = $this->input->post("title");
				$type = $this->input->post("type");
				$content = $this->input->post("content");
				$last_modified_time = $this->input->post("last_modified_time");
				$submit_time = $this->input->post("submit_time");
				

				if($uid!=""){
					if($did&&$name&&$rname){
						$rsql = "UPDATE department, set name='{$dname}' , rid='{$rid}' WHERE did = '{$did}'";
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
		
		$role_query = $this->db->query("SELECT rid,name as rname FROM role order by rid desc");
		$role_data = $role_query->result();
		
		$dept_query = $this->db->query("SELECT did,name as dname FROM department order by did desc");
		$dept_data = $dept_query->result();
		
		if($this->input->post()){
			$dname = $this->input->post("dname");
			
			$rname = $this->input->post("rname");
			$role_dept_query = $this->db->query("SELECT rid from role r WHERE name = ".$rname."");
			$role_dept_data = $role_dept_query->row_array();
			$rid = $role_dept_data['rid'];
		
			if($dname&&$rolename){
				$query = $this->db->query("SELECT * FROM department WHERE did = '".$did."'");
				$data = $query->row_array();
				if(!$data){
					$sql = "INSERT INTO department (name,rid) values('{$dname}','{$rid}')";
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
	public function delete($nid){
		$query = $this->db->query("SELECT * FROM news WHERE nid = '".$nid."' ");
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM news WHERE did = '".$nid."' ";
					$this->db->query($sql);
					success_redirct("info/news/index","Delete successful!");
				}else{
					error_redirct("info/news/index","Delete failed!");
				}
			}
			$this->load->view("info/news/delete",array("data"=>$data));
		}else{
			error_redirct("info/news/index","No department is found!");
		}
	}
}
