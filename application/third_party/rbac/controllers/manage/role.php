<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * role index
	 * @param number $page
	 */
	public function index($page=1)
	{
		$query = $this->db->query("SELECT COUNT(1) as cnt FROM Role");
		$cnt_data = $query->row_array();
		//page settings
		$this->load->library('pagination');
		$config['base_url'] = site_url("manage/role/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 35;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		
		$query = $this->db->query("SELECT * FROM Role ORDER BY level LIMIT ".(($page-1)*$config['per_page']).",".$config['per_page']."");
		$data = $query->result();
		$this->load->view("manage/role",array("data"=>$data));
	}
	
	/**
	 * Edit role
	 * @param number $rid
	 */
	public function edit($rid){
		$query = $this->db->query("SELECT * FROM Role R WHERE rid = ".$rid);
		$data = $query->row_array();
		$dept_query = $this->db->query("SELECT D.did, D.name as deptname  Department D");
		$dept_data = $dept_query->result();
		if($data){
			if($this->input->post()){
				$level = $this->input->post("level");
				$rolename = $this->input->post("rolename");
				$dept = $this->input->post("dept");
				$status = $this->input->post("status")?1:0;
				
				if($data){
					if($rolename&&$level){
						$query = $this->db->query("SELECT * FROM Role WHERE name = '".$rolename."'");
						$result = $query->row_array();
						if(!$result){
							$sql = "UPDATE Role set did = '{$dept}',level = '{$level}',name='{$rolename}',status='{$status}' WHERE rid = {$rid}";
							$this->db->query($sql);
							success_redirct("manage/role/index","Edit successful!");
						}else{
							error_redirct("","The role's name already exists!");
						}
						
					}else{
						error_redirct("","The role's information is not complete!");
					}
				}
				
			}
			$this->load->view("manage/role/edit",array("data"=>$data,"dept_data"=>$dept_data));
		}else{
			error_redirct("manage/role/index","No roles is found!");
		}
	}
	
	/**
	 * add role
	 * @param number $rid
	 */
	public function add(){
		$dept_query = $this->db->query("SELECT D.did, D.name as deptname FROM Department");
		$dept_data = $dept_query->result();
		if($this->input->post()){
			$level = $this->input->post("level");
			$rolename = $this->input->post("rolename");
			$dept = $this->input->post("dept");
			$status = $this->input->post("status")?1:0;
			$dname_query = $this->db->query("SELECT name as dept_name FROM Department WHERE did = '{$dept}'");
			$dname_data = $query->row_array();
			$dname = $dname_data['dept_name'];
			if($rolename&&$level){
				$query = $this->db->query("SELECT * FROM Role WHERE name = '".$rolename."'");
				$result = $query->row_array();
				if(!$result){
					$sql = "INSERT INTO Role(name,status,level,did,dname) values('{$rolename}','{$status}','{$level}','{$dept}','{$dname}')";
					$this->db->query($sql);
					success_redirct("manage/role/index","Add successful!");
				}else{
					error_redirct("","The role's name already exists!");
				}
				
			}else{
				error_redirct("","The role's information is not complete!");
			}
		}
		$this->load->view("manage/role/add",array("dept_data"=>$dept_data));
	}
	
	/**
	 * delete role
	 * @param number $rid
	 */
	public function delete($rid){
		$query = $this->db->query("SELECT * FROM Role WHERE rid = ".$rid);
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM Role WHERE rid = ".$rid." ";
					$this->db->query($sql);
					$sql = "DELETE FROM Authorizes WHERE rid = ".$rid." ";
					$this->db->query($sql);
					success_redirct("manage/role/index","Delete successful!");
				}else{
					error_redirct("manage/role/index","Failed to delete!");
				}
	
			}
			$this->load->view("manage/role/delete",array("data"=>$data));
		}else{
			error_redirct("manage/role/index","No roles is found!");
		}
	}
	
	/**
	 * Authorize
	 * @param number $rid
	 */
	public function action($rid,$node_id=NULL,$role_node_list=NULL){
		if(!$rid){error_redirct("manage/role/index","No roles is found!");}
		if($node_id!=NULL){
			$query = $this->db->query("SELECT node_id FROM Authorizes WHERE node_id= {$node_id} AND rid={$rid}");
			$data = $query->row_array();
			if($data){
				$sql = "DELETE FROM Authorizes WHERE node_id= {$node_id} AND rid={$rid}";
			}else{
				$sql = "INSERT INTO Authorizes (node_id,rid) values('{$node_id}','{$rid}')";
			}
			$this->db->query($sql);
			success_redirct("","Authorize successful!",1);
			
		}
		$rbac_where = "";
		$node_hidden_array = $this->config->item('rbac_manage_node_hidden');
		if(!empty($node_hidden_array)){
			$rbac_where = "WHERE ";
			foreach($node_hidden_array as $node_hidden){
				$rbac_where.= "directory != '$node_hidden' AND ";
			}
			$rbac_where = substr($rbac_where,0,-4);
		}
		$query = $this->db->query("SELECT * FROM Node {$rbac_where} ORDER BY directory,controller,func");
		$data = $query->result();
		foreach($data as $vo){
			$node_list[$vo->directory][$vo->controller][$vo->func] = $vo;
		}
		$query = $this->db->query("SELECT N.node_id,N.directory,N.controller,N.func FROM Node N, Authorizes A WHERE N.node_id = A.node_id AND rid = '{$rid}'");
		$role_data = $query->result();
		foreach($role_data as $vo){
			$role_node_list[$vo->directory][$vo->controller][$vo->func] = TRUE;
		}
		$this->load->view('manage/role/action',array('rid'=>$rid,'node'=>$node_list,'rnl'=>$role_node_list));
	}
	
}
