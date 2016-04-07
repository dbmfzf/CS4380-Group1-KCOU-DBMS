<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC后台管理中角色模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Role extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 角色首页
	 * @param number $page
	 */
	public function index($page=1)
	{
		$query = $this->db->query("SELECT COUNT(1) as cnt FROM Role");
		$cnt_data = $query->row_array();
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url("manage/role/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 35;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		
		$query = $this->db->query("SELECT * FROM Role LIMIT ".(($page-1)*$config['per_page']).",".$config['per_page']."");
		$data = $query->result();
		$this->load->view("manage/role",array("data"=>$data));
	}
	
	/**
	 * 角色修改
	 * @param number $id
	 */
	public function edit($id){
		$query = $this->db->query("SELECT * FROM Role WHERE rid = ".$id);
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$rolename = $this->input->post("rolename");
				$status = $this->input->post("status")?1:0;
				if($rolename){
					$sql = "UPDATE rbac_role set name='{$rolename}',status='{$status}' WHERE rid = {$id}";
					$this->db->query($sql);
					success_redirct("manage/role/index","角色信息修改成功！");
				}else{
					error_redirct("","信息填写不全！");
				}
			}
			$this->load->view("manage/role/edit",array("data"=>$data));
		}else{
			error_redirct("manage/role/index","未找到此角色");
		}
	}
	
	/**
	 * 角色新增
	 * @param number $id
	 */
	public function add(){
		if($this->input->post()){
			$rolename = $this->input->post("rolename");
			$status = $this->input->post("status")?1:0;
			if($rolename){
				$query = $this->db->query("SELECT * FROM Role WHERE name = '".$rolename."'");
				$data = $query->row_array();
				if(!$data){
					$sql = "INSERT INTO Role(name,status) values('{$rolename}','{$status}')";
					$this->db->query($sql);
					success_redirct("manage/role/index","角色新增成功！");
				}else{
					error_redirct("","此角色名已存在！");
				}
				
			}else{
				error_redirct("","信息填写不全！");
			}
		}
		$this->load->view("manage/role/add");
	}
	
	/**
	 * 角色删除
	 * @param number $id
	 */
	public function delete($id){
		$query = $this->db->query("SELECT * FROM Role WHERE rid = ".$id);
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM Role WHERE rid = ".$id." ";
					$this->db->query($sql);
					$sql = "DELETE FROM Authorizes WHERE rid = ".$id." ";
					$this->db->query($sql);
					success_redirct("manage/role/index","角色删除成功");
				}else{
					error_redirct("manage/role/index","操作失败");
				}
	
			}
			$this->load->view("manage/role/delete",array("data"=>$data));
		}else{
			error_redirct("manage/role/index","未找到此角色");
		}
	}
	
	/**
	 * 角色赋权
	 * @param number $id
	 */
	public function action($id,$node_id=NULL){
		if(!$id){error_redirct("manage/role/index","未找到此角色");}
		if($node_id!=NULL){
			$query = $this->db->query("SELECT node_id FROM Authorizes WHERE node_id= {$node_id} AND rid={$id}");
			$data = $query->row_array();
			if($data){
				$sql = "DELETE FROM Authorizes WHERE node_id= {$node_id} AND rid={$id}";
			}else{
				$sql = "INSERT INTO Authorizes (node_id,rid) values('{$node_id}','{$id}')";
			}
			$this->db->query($sql);
			success_redirct("","节点操作成功",1);
			
		}
		$rbac_where = "";
		$node_hidden_array = $this->config->item('rbac_manage_node_hidden');
		if(!empty($node_hidden_array)){
			$rbac_where = "WHERE ";
			foreach($node_hidden_array as $node_hidden){
				$rbac_where.= "dirc != '$node_hidden' AND ";
			}
			$rbac_where = substr($rbac_where,0,-4);
		}
		$query = $this->db->query("SELECT * FROM Node {$rbac_where} ORDER BY directory,controller,func");
		$data = $query->result();
		foreach($data as $vo){
			$node_list[$vo->dirc][$vo->cont][$vo->func] = $vo;
		}
		$query = $this->db->query("SELECT node_id,directory,controller,func FROM Node WHERE node_id in (SELECT node_id FROM Authrizes WHERE rid = ".$id.")");
		$role_data = $query->result();
		foreach($role_data as $vo){
			$role_node_list[$vo->directory][$vo->controller][$vo->func] = TRUE;
		}
		$this->load->view('manage/role/action',array('rid'=>$id,'node'=>$node_list,'rnl'=>$role_node_list));
	}
	
}
