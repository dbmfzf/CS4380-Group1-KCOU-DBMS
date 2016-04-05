<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC中默认网关页面
 * @author		toryzen
 * @link		http://www.toryzen.com
 */

class Index extends CI_Controller {
	
	function __construct(){
		//$this -> load -> helpers("rbac_helper");
		parent::__construct();
	}
	/**
	 * 主页
	 */
	public function index()
	{
		//验证是否登录
		if(!rbac_conf(array('INFO','uid'))){
			error_redirct($this->config->item('rbac_auth_gateway'),"Please Login First!");
		}else{
			success_redirct($this->config->item('rbac_default_index'),"Success!","1");
		}
		
	}
	/**
	 * 用户登录
	 */
	public function login(){
		$this-> load -> model("rbac_model");
		$username = $this->input->post('uid');
		$password = $this->input->post('password');
		if($username&&$password){
			$STATUS = $this->rbac_model->check_user($username,md5($password));
			if($STATUS===TRUE){
				success_redirct($this->config->item('rbac_default_index'),"Success!");
			}else{
				error_redirct($this->config->item('rbac_auth_gateway'),$STATUS);
				die();
			}
		}else{
			$this->load->view("login");
		}
		
	}
	/*
	 * 用户退出
	 */
	public function logout(){
		session_destroy();
		success_redirct($this->config->item('rbac_auth_gateway'),"Success!",2);
	}

}
