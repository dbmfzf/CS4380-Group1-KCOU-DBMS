<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC后台管理中节点模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Node extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 节点首页
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
	 * 新增节点
	 * @param string $dirc
	 * @param string $cont
	 * @param string $func
	 */
	public function add($dirc=NULL,$cont=NULL,$func=NULL){
		if($this->input->post()){
			$dirc = $this->input->post("dirc")?$this->input->post("dirc"):$dirc;
			$cont = $this->input->post("cont")?$this->input->post("cont"):$cont;
			$func    = $this->input->post("func");
			$memo   = $this->input->post("memo");
			$status   = $this->input->post("status")==1?1:0;
			if($dirc&&$cont&&$func&&$memo){
				$query = $this->db->query("SELECT node_id FROM Node WHERE directory = '".$dirc."' AND controller = '".$cont."' AND func = '".$func."'");
				$data = $query->row_array();
				if(!$data){
					$sql = "INSERT INTO Node (directory,controller,func,status,memo) values('{$dirc}','{$cont}','{$func}','{$status}','{$memo}')";
					//echo $sql;die();
					$this->db->query($sql);
					success_redirct('manage/node/index','节点添加成功！');
				}else{
					error_redirct('',"该节点已存在！");
				}
			}else{
				error_redirct('',"信息填写不全！");
			}
		}
		$this->load->view('manage/node/add',array('dirc'=>$dirc,'cont'=>$cont,'func'=>$func));
	}
	/**
	 * 删除节点
	 * @param string $dirc
	 * @param string $cont
	 * @param string $func
	 */
	public function delete($dirc=NULL,$cont=NULL,$func=NULL){
		if($dirc==NULL){error_redirct("manage/node/index","操作失败");}
		if($this->input->post()){
			$verfiy = $this->input->post("verfiy");
			if($verfiy){
				$where_dirc = "directory = '{$dirc}'";
				$where_cont = $cont==NULL?"":" AND controller = '{$cont}'";
				$where_func = $func==NULL?"":" AND func = '{$func}'";
				$query = $this->db->query("SELECT GROUP_CONCAT(node_id) as nodeid FROM Node WHERE {$where_dirc} {$where_cont} {$where_func}");
				$node_list = $query->row_array();
				$sql = "UPDATE Menu SET node_id = NULL WHERE node_id in (".$node_list['nodeid'].")";
				$this->db->query($sql);
				$sql = "DELETE FROM Node WHERE {$where_dirc} {$where_cont} {$where_func} ";
				$this->db->query($sql);
				success_redirct("manage/node/index","删除成功");
			}else{
				error_redirct("manage/node/index","操作失败");
			}
		
		}
		$this->load->view('manage/node/delete',array('dirc'=>$dirc,'cont'=>$cont,'func'=>$func));
	}
	/**
	 * 修改节点
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
					success_redirct("manage/node/index","节点修改成功");
				}else{
					error_redirct('',"信息填写不全！");
				}
			}
			$this->load->view("manage/node/edit",array('data'=>$data));
		}else{
			error_redirct("manage/node/index","未找到此节点");
		}
	}

}
