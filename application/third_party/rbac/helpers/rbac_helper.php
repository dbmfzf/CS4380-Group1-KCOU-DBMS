<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//MEMCACHED unique id
if(!function_exists('mem_id')){
	function mem_id(){
		return $_SERVER['HTTP_HOST']."|".md5($_SERVER['SCRIPT_NAME'].session_id());
	}
}

//MEMCACHED call method
if(!function_exists('mem_inst')){
	function mem_inst(){
		$ci_obj = &get_instance();
		$ci_obj->config->load('memcached',TRUE);
		if($ci_obj->config->item('flag','memcached')===FALSE) return FALSE;
		$ci_obj->load->library('memcached');
		static $static_memc;
		if($static_memc)return $static_memc;
		$memc = new memcached($ci_obj->config->item('config','memcached'));
		$static_memc = $memc;
		return $static_memc;
	}
}

//Get and set rbac data[base on SESSION|MEMCACHED]
if(!function_exists('rbac_conf')){
	function rbac_conf($arr_key,$value=NULL){
		$ci_obj = &get_instance();
		//get
		if(mem_inst()){
			if(!$config = mem_inst()->get(mem_id())){
				$config = $_SESSION[$ci_obj->config->item('rbac_auth_key')];
			}
		}else{
			$config = @$_SESSION[$ci_obj->config->item('rbac_auth_key')];
		}
		$conf[-1] = &$config;
		foreach($arr_key as $k=>$ar){
			$conf[$k] = &$conf[$k-1][$ar];
		}
		if($value !==NULL){
			$conf[count($arr_key)-1] = $value;
		}
		//set
		if(mem_inst()){
			if(!mem_inst()->set(mem_id(),$config)){
				$_SESSION[$ci_obj->config->item('rbac_auth_key')] = $config;
			}
		}else{
			$_SESSION[$ci_obj->config->item('rbac_auth_key')] = $config;
		}
		return isset($conf[count($arr_key)-1])?$conf[count($arr_key)-1]:FALSE;
	}
}
//logout
if(!function_exists('rbac_logout')){
	function rbac_logout($arr_key,$value=NULL){
		if(mem_inst()){
			mem_inst()->delete(mem_id());
		}
		session_destroy();
	}
}

//error_redirect
if(!function_exists("error_redirct")){
	function error_redirct($url="",$contents="Error",$time = 3){
		
		$ci_obj = &get_instance();
		if($url!=""){
			$url = base_url("index.php/".$url);
		}else{
			$url = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]: site_url();
		}
		$data['url'] = $url;
		$data['time'] = $time;
		$data['type'] = "error";
		$data['contents'] = $contents;
		$ci_obj->load->view("redirect",$data);
		$ci_obj->output->_display($ci_obj->output->get_output());
		die();
	}
}

//success redirect
if(!function_exists("success_redirct")){
	function success_redirct($url,$contents="Success!",$time = 3){
		$ci_obj = &get_instance();
		if($url!=""){
			$url = base_url("index.php/".$url);
		}else{
			$url = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:site_url();
		}
		$data['url'] = $url;
		$data['time'] = $time;
		$data['type'] = "success";
		$data['contents'] = $contents;
		$ci_obj->load->view("redirect",$data);
		$ci_obj->output->_display($ci_obj->output->get_output());
		die();
	}
}
