<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC中默认网关页面
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
$gateway = "Index/login";
$index = "product/index/index";
class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	/**
	 * 主页
	 */
	public function index()
	{
		//验证是否登录
		$this -> load -> helpers("rbac_helper");
		if(!rbac_conf(array('INFO','uid'))){
			error_redirct($gateway,"Please Login First!");
		}else{
			success_redirct($index,"Success!","1");
		}
		
	}
	/**
	 * 用户登录
	 */
	public function login(){
		$this -> load -> helpers("rbac_helper");
		$this-> load -> model("rbac_model");
		$username = $this->input->post('uid');
		$password = $this->input->post('password');
		if($username&&$password){
			$STATUS = $this->rbac_model->check_user($username,md5($password));
			if($STATUS===TRUE){
				success_redirct($index,"Success!");
			}else{
				error_redirct($gateway,$STATUS);
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
		$this -> load -> helpers("rbac_helper");
		success_redirct($gateway,"Success!",2);
	}

}
