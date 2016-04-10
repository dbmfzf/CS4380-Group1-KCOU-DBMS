<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC中默认网关页面
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 主页
	 */
	public function index()
	{
		//验证是否登录
		if(!rbac_conf(array('INFO','uid'))){
			error_redirct($this->config->item('rbac_auth_gateway'),"Please login first");
		}else{
			success_redirct($this->config->item('rbac_default_index'),"Login successful!","1");
		}
		
	}
	/**
	 * 用户登录
	 */
	public function login(){
		
		$this->load->model("rbac_model");
		$uid = $this->input->post('uid');
		$password = $this->input->post('password');
		if($uid&&$password){
			$STATUS = $this->rbac_model->check_user($uid,md5($password));
			if($STATUS===TRUE){
				
				$date_time = date('y-m-d h:i:s',time());
				$login_ip = $_SERVER["REMOTE_ADDR"];
				$sql = "INSERT INTO Login_record(uid,date_time,ip) values('{$uid}','{$date_time}','{$login_ip}')";
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
	 * 用户退出
	 */
	public function logout(){
		session_destroy();
		success_redirct($this->config->item('rbac_auth_gateway'),"Logout successful!",2);
	}
}
