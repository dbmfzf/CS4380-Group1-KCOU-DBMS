<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Rbac {
	
	private $ci_obj;
	
	public function __construct(){
		$this->ci_obj = &get_instance();
		$this->ci_obj->load->helper(array('rbac','url'));
		$this->ci_obj->load->config('rbac');
		if(!isset($this->ci_obj->view_override)){
			//rewrite the view
			$this->ci_obj->view_override = TRUE;
		}
	}
	/*
	 * check privileges
	 */
	public function auto_verify(){
		$directory = substr($this->ci_obj->router->fetch_directory(),0,-1);
		$controller = $this->ci_obj->router->fetch_class();
		$function = $this->ci_obj->router->fetch_method();
		//UURI(MD5)
		$this->ci_obj->uuri = md5($directory.$controller.$function);
		if($directory!=""){
			if($this->ci_obj->config->item('rbac_auth_on')){
				if(!in_array($directory,$this->ci_obj->config->item('rbac_notauth_dirc'))){
					//echo rbac_conf(array('INFO','uid'));
					if(!rbac_conf(array('INFO','uid'))){
						error_redirct($this->ci_obj->config->item('rbac_auth_gateway'),"Please login first!");
						die();
					}
					if($this->ci_obj->config->item('rbac_auth_type')==2){
						$this->ci_obj->load->model("rbac_model");
					
						$STATUS = $this->ci_obj->rbac_model->check_user(rbac_conf(array('INFO','uid')),rbac_conf(array('INFO','password')));
						if($STATUS==FALSE){
							error_redirct($this->config->item('rbac_auth_gateway'),$STATUS);
						}
						
						$this->ci_obj->rbac_model->get_acl(rbac_conf(array('INFO','rid')));
					}
					
					
					if(!rbac_conf(array('ACL',$directory,$controller,$function))){
						error_redirct("","You have no authority to do that!(".$directory."/".$controller."/".$function.")");
						die();
					}
				}
			}
		
			if($this->ci_obj->config->item('rbac_auth_type')==2){
				$this->ci_obj->get_menu = $this->get_menu();
			}else{
				if(rbac_conf(array('MENU'))){
					$this->ci_obj->get_menu = rbac_conf(array('MENU'));
				}else{
					rbac_conf(array('MENU'),$this->get_menu());
					$this->ci_obj->get_menu = rbac_conf(array('MENU'));
				}
			}
		}
	}
		
	/*
	 * rewrite the view
	 */
	public function view_override() {
		$directory = substr($this->ci_obj->router->fetch_directory(),0,-1);
		if(@$this->ci_obj->view_override&&$directory!=""){
			$html = $this->ci_obj->load->view('main', null, true);
		}else{
			$html = $this->ci_obj->output->get_output();
		}
		$this->ci_obj->output->_display($html);
	}
	
	/*
	 * Get menus
	*/
	private function get_menu(){		
		$this->ci_obj->load->database();
		$query = $this->ci_obj->db->query("SELECT M.id,M.title,M.node_id,M.pid, N.directory,N.controller,N.func FROM Menu M left join Node N on M.node_id = N.node_id WHERE M.status = 1 AND M.pid is NULL ORDER BY sort asc");
		$menu_data = $query->result();
		$i = 0;
		while(count($menu_data)>0){
			$id_list = "";
			foreach($menu_data as $vo){
				if($i==2){
					$vo->p_pid = $Tmp_menu[1][$vo->pid]->pid;
				}
				$Tmp_menu[$i][$vo->id] = $vo;
				$id_list .= $vo->id.",";
			}
			$id_list = substr($id_list,0,-1);
			$query = $this->ci_obj->db->query("SELECT M.id,M.title,M.node_id,M.pid, N.directory,N.controller,N.func FROM Menu M left join Node N on M.node_id = N.node_id WHERE M.status = 1 AND M.pid in (".$id_list.") ORDER BY sort asc");
			$menu_data = $query->result();
			$i++;
		}
		$j = 0;
		//show menus according to privileges
		foreach($Tmp_menu as $vo){
			foreach($vo as $cvo){
				$menu['list'][md5($cvo->directory.$cvo->controller.$cvo->func)] = $cvo->title;
				if(rbac_conf(array('ACL',$cvo->directory,$cvo->controller,$cvo->func))||!$cvo->node_id){
					if($j==0){
						if(rbac_conf(array('ACL',$cvo->directory,$cvo->controller,$cvo->func))){
							$menu[$cvo->id]["shown"] = 1;
						}
						$menu[$cvo->id]["self"] = array("title"=>$cvo->title,"uri"=>$cvo->directory?$cvo->directory."/".$cvo->controller."/".$cvo->func:$cvo->controller."/".$cvo->func);
							
					}elseif($j==1){
						if(rbac_conf(array('ACL',$cvo->directory,$cvo->controller,$cvo->func))){
							$menu[$cvo->pid]["shown"] = 1;
							$menu[$cvo->pid]["child"][$cvo->id]["shown"] = 1;
						}
						$menu[$cvo->pid]["child"][$cvo->id]["self"] = array("title"=>$cvo->title,"uri"=>$cvo->directory?$cvo->directory."/".$cvo->controller."/".$cvo->func:$cvo->controller."/".$cvo->func);
							
					}else{
						if(rbac_conf(array('ACL',$cvo->directory,$cvo->controller,$cvo->func))){
							$menu[$cvo->p_pid]["shown"] = 1;
							$menu[$cvo->p_pid]["child"][$cvo->pid]["shown"] = 1;
							$menu[$cvo->p_pid]["child"][$cvo->pid]["child"][$cvo->id]["shown"] = 1;
						}
						$menu[$cvo->p_pid]["child"][$cvo->pid]["child"][$cvo->id]["self"] = array("title"=>$cvo->title,"uri"=>$cvo->directory?$cvo->directory."/".$cvo->controller."/".$cvo->func:$cvo->controller."/".$cvo->func);
					}
				}
			}
			$j++;
		}
		//print_r($menu);
		return $menu;
	}
}
