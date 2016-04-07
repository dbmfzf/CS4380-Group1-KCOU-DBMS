<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC管理后台中菜单模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Menu extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 菜单主页
	 */
	public function index()
	{
		$menu_data = $this->get_menu_list();
		$this->load->view("manage/menu",$menu_data);
	}
	
	/**
	 * 菜单删除
	 */
	public function delete($id){
		$query = $this->db->query("SELECT M.id,M.title,M.node_id,M.pid,M.sort,M.status,M.memo FROM Menu M left join Node N on M.node_id = N.node_id WHERE M.id =".$id);
		$data = $query->row_array();
		if($data){
			//获取当前节点及其子节点
			$menu_data = $this->get_menu_list($id);
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				$sql = "DELETE FROM Menu WHERE id in (".$menu_data["id_list"].") ";
				$this->db->query($sql);
				success_redirct("manage/menu/index","菜单删除成功");
			}
			$this->load->view("manage/menu/delete",$menu_data);
		}else{
			error_redirct("manage/menu/index","未找到此菜单");
		}
	}
	/**
	 * 菜单新增
	*/
	public function add($id,$level,$pid="NULL"){
		if($this->input->post()){
			$title = $this->input->post("title");
			$sort = $this->input->post("sort");
			$node = $this->input->post("node");
			$level = $this->input->post("level");
			if($id&&$level){
				if($title){
					$pid   = $this->input->post("pid");
					$status = $this->input->post("status")==""?"0":"1";
					$sql = "INSERT INTO Menu (status,title,sort,node_id,pid) values( '{$status}','{$title}','{$sort}','{$node}',{$pid})";
					$this->db->query($sql);
					success_redirct("manage/menu/index","新增菜单成功！");
				}else{
					error_redirct("","标题不能为空！");
				}
			}else{
				error_redirct("","参数不正确！");
			}
		}
		$rbac_where = "";
		$node_hidden_array = $this->config->item('rbac_manage_node_hidden');
		if(!empty($node_hidden_array)){
			foreach($node_hidden_array as $node_hidden){
				$rbac_where.= "AND directory != '$node_hidden' ";
			}
		}
		$node_query = $this->db->query("SELECT * FROM Node WHERE status = 1 {$rbac_where} ORDER BY directory,controller");
		$node_data = $node_query->result();
		$this->load->view("manage/menu/add",array("node"=>$node_data,"level"=>$level,"pid"=>$pid));
	}
	/**
	 * 菜单修改
	 */
	public function edit($id,$level,$pid="NULL"){
		if($this->input->post()){
			$id = $this->input->post("id");
			$title = $this->input->post("title");
			$sort = $this->input->post("sort");
			$node = $this->input->post("node");
			$level = $this->input->post("level");
			if($id&&$level){
				if($title){
					$pid   = $this->input->post("pid")=="NULL"?"pid = NULL":"pid='{$pid}'";
					$status = $this->input->post("status")==""?"status='0'":"status='1'";
					$sql = "UPDATE Menu SET status ='{$status}',title='{$title}',sort='{$sort}',node_id='{$node}',pid ='{$pid}' WHERE id = '{$id}'";
					$this->db->query($sql);
					success_redirct("manage/menu/index","菜单修改成功！");
				}else{
					error_redirct("","标题不能为空！");
				}
			}else{
				error_redirct("","参数不正确！");
			}
		}
		$query = $this->db->query("SELECT M.id,M.title,M.node_id,M.pid,M.sort,M.status,N.memo FROM Menu M left join Node N on M.node_id = N.node_id WHERE M.id =".$id);
		$data = $query->row_array();
		if($data){
			$rbac_where = "";
			$node_hidden_array = $this->config->item('rbac_manage_node_hidden');
			if(!empty($node_hidden_array)){
				foreach($node_hidden_array as $node_hidden){
					$rbac_where.= "AND directory != '$node_hidden' ";
				}
			}
			$node_query = $this->db->query("SELECT * FROM Node WHERE status = 1 {$rbac_where} ORDER BY directory,controller");
			$node_data = $node_query->result();
			$this->load->view("manage/menu/edit",array("data"=>$data,"node"=>$node_data,"level"=>$level,"pid"=>$pid));
		}else{
			error_redirct("manage/menu/index","未找到此菜单");
		}
	}
	
	/**
	 * 获取菜单页
	 * @param string $id
	 * @return array($id_list,$menu)
	 */
	private function get_menu_list($id = NULL){
		$rbac_where = "";
		$menu_hidden_array = $this->config->item('rbac_manage_menu_hidden');
		if(!empty($menu_hidden_array)){
			foreach($menu_hidden_array as $menu_hidden){
				$rbac_where.= "AND title != '$menu_hidden' ";
			}
		}
		$query = $this->db->query("SELECT M.*,N.memo,concat(' [',N.directory,'/',N.controller,'/',N.func,']') as dcf FROM Menu M left join Node N on M.node_id = N.node_id WHERE ".($id==NULL?"M.pid  is NULL":"M.id  = '".$id."'")." {$rbac_where} ORDER BY sort asc");
		$menu_data = $query->result();
		$i = 0;
		$all_id_list = "";
		while(count($menu_data)>0){
			$id_list = "";
			foreach($menu_data as $vo){
				if($i==2){
					$vo->p_pid = $Tmp_menu[1][$vo->pid]->pid;
				}
				$Tmp_menu[$i][$vo->id] = $vo;
				$id_list .= $vo->id.",";
				$all_id_list .= $vo->id.",";
			}
			$id_list = substr($id_list,0,-1);
			$query = $this->db->query("SELECT M.*,N.memo,concat(' [',N.directory,'/',N.controller,'/',N.func,']') as dcf FROM Menu M left join Node N on M.node_id = N.node_id WHERE M.pid in (".$id_list.") ORDER BY sort asc");
			$menu_data = $query->result();
			$i++;
		}
		$j = 0;
		foreach($Tmp_menu as $vo){
			foreach($vo as $cvo){
				if($j==0){
					$menu[$cvo->id]["self"] = $cvo;
				}elseif($j==1){
					$menu[$cvo->pid]["child"][$cvo->id]["self"] = $cvo;
				}else{
					$menu[$cvo->p_pid]["child"][$cvo->pid]["child"][$cvo->id]["self"] =$cvo;
				}
			}
			$j++;
		}
		$return["id_list"] = substr($all_id_list,0,-1);
		$return["menu"]    = $menu;
		return $return;
	}
}
