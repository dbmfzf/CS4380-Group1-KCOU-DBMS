<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * node index
	 */
	public function index()
	{
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
		$this->load->view('manage/node',array('node'=>$node_list));
	}
	/**
	 * Add node
	 * @param string $directory
	 * @param string $controller
	 * @param string $func
	 */
	public function add($directory=NULL,$controller=NULL,$func=NULL){
		if($this->input->post()){
			$directory = $this->input->post("directory")?$this->input->post("directory"):$directory;
			$controller = $this->input->post("controller")?$this->input->post("controller"):$controller;
			$func    = $this->input->post("func");
			$memo   = $this->input->post("memo");
			$status   = $this->input->post("status")==1?1:0;
			if($directory&&$controller&&$func&&$memo){
				$query = $this->db->query("SELECT node_id FROM Node WHERE directory = '".$directory."' AND controller = '".$controller."' AND func = '".$func."'");
				$data = $query->row_array();
				if(!$data){
					$sql = "INSERT INTO Node (directory,controller,func,status,memo) values('{$directory}','{$controller}','{$func}','{$status}','{$memo}')";
					//echo $sql;die();
					$this->db->query($sql);
					success_redirct('manage/node/index','Add successful!');
				}else{
					error_redirct('',"The node already exists!");
				}
			}else{
				error_redirct('',"The node's information is not complete!");
			}
		}
		$this->load->view('manage/node/add',array('directory'=>$directory,'controller'=>$controller,'func'=>$func));
	}
	/**
	 * Delete node
	 * @param string $directory
	 * @param string $controller
	 * @param string $func
	 */
	public function delete($directory=NULL,$controller=NULL,$func=NULL){
		if($directory==NULL){error_redirct("manage/node/index","Failed to delete!");}
		if($this->input->post()){
			$verfiy = $this->input->post("verfiy");
			if($verfiy){
				$where_dirc = "directory = '{$directory}'";
				$where_cont = $controller==NULL?"":" AND controller = '{$controller}'";
				$where_func = $func==NULL?"":" AND func = '{$func}'";
				$query = $this->db->query("SELECT GROUP_CONCAT(node_id) as nodeid FROM Node WHERE {$where_dirc} {$where_cont} {$where_func}");
				$node_list = $query->row_array();
				$sql = "UPDATE Menu SET node_id = NULL WHERE node_id in (".$node_list['nodeid'].")";
				$this->db->query($sql);
				$sql = "DELETE FROM Node WHERE {$where_dirc} {$where_cont} {$where_func} ";
				$this->db->query($sql);
				success_redirct("manage/node/index","Delete successful!");
			}else{
				error_redirct("manage/node/index","Failed to delete!");
			}
		
		}
		$this->load->view('manage/node/delete',array('directory'=>$directory,'controller'=>$controller,'func'=>$func));
	}
	/**
	 * Edit node
	 * @param unknown $id
	 */
	public function edit($id){
		$query = $this->db->query("SELECT * FROM Node WHERE node_id = ".$id);
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$memo   = $this->input->post("memo");
				$status   = $this->input->post("status")==1?1:0;
				if($memo){
					$sql = "UPDATE Node set memo='{$memo}',status = '{$status}' WHERE node_id = {$id}";
					$this->db->query($sql);
					success_redirct("manage/node/index","Edit node successful!");
				}else{
					error_redirct('',"The node's information is not complete!");
				}
			}
			$this->load->view("manage/node/edit",array('data'=>$data));
		}else{
			error_redirct("manage/node/index","No nodes is found!");
		}
	}

}
