<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
	/**
	 * index
	 */
	public function index()
	{
		//check login status
		$this -> load -> helpers("rbac_helper");
		if(!rbac_conf(array('INFO','uid'))){
			error_redirct('Index/login',"Please login first");
		}else{
			success_redirct($this->config->item('rbac_default_index'),"Success！","1");
		}
		
	}
	/**
	 * login
	 */
	public function login(){
		$this -> load -> helpers("rbac_helper");
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
	 * logout
	 */
	public function logout(){
		session_destroy();
		$this -> load -> helpers("rbac_helper");
		success_redirct($this->config->item('rbac_auth_gateway'),"Success！",2);
	}

}
