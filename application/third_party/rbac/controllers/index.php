<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * index
	 */
	public function index()
	{
		//check login status
		if(!rbac_conf(array('INFO','uid'))){
			error_redirct($this->config->item('rbac_auth_gateway'),"Please login first");
		}else{
			success_redirct($this->config->item('rbac_default_index'),"Login successful!","1");
		}
		
	}
	/**
	 * login
	 */
	public function login(){
		
		$this->load->model("rbac_model");
		$uid = $this->input->post('uid');
		$password = $this->input->post('password');
		if($uid&&$password){
			$STATUS = $this->rbac_model->check_user($uid,md5($password));
			if($STATUS===TRUE){
				
				//$date_time = date('Y-m-d H:i:s',time());
				$login_ip = $_SERVER["REMOTE_ADDR"];
				$sql = "INSERT INTO Login_record(uid,date_time,ip) values('{$uid}',NOW(),'{$login_ip}')";
				$this->db->query($sql);

				success_redirct($this->config->item('rbac_default_index'),"Login successful!");

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
		success_redirct($this->config->item('rbac_auth_gateway'),"Logout successful!",2);
	}
}
