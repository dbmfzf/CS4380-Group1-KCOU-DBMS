<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC管理后台中用户模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class Profile extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * profiles
	 * 
	 */
	public function index()
	{
		$uid = rbac_conf(array('INFO','uid'));
		
		$user_query = $this->db->query("SELECT fullname,gender,birth,email,phone FROM User WHERE uid = '".$uid."' limit 1");
		$user_data = $user_query -> row_array();
		 
		$role_query = $this->db->query("SELECT name from Role R, User U where U.rid = R.rid and U.uid = '".$uid."' limit 1");
		$role_data = $role_query -> row_array();
		
		$dept_query = $this->db->query("SELECT name from Department D, Belongs_to B, User U where U.uid = B.uid and D.did = B.did and U.uid = '".$uid."' limit 1");
		$dept_data = $dept_query -> row_array();
		
		$login_query = $this->db->query("SELECT * FROM Login_record WHERE uid = '".$uid."' AND log_id != (SELECT MAX(log_id) FROM Login_record WHERE uid = '".$uid."') order by log_id desc limit 1");
		$login_data = $login_query -> row_array();
		
		$data['fullname'] = $user_data['fullname'];
		$data['gender'] = $user_data['gender'];
		$data['email'] = $user_data['email'];
		$data['phone'] = $user_data['phone'];
		$data['role'] = $role_data['name'];
		$data['birth'] = $user_data['birth'];
		$dept_data['name'] == NULL?$data['dept'] = "No department!":$data['dept'] = $dept_data['name'];
		$login_data['date_time'] ==NULL?$data['last_login_time'] = "First login!":$data['last_login_time'] = $login_data['date_time'];
		$login_data['ip']== NULL?$data['last_login_ip'] = "First login!":$data['last_login_ip'] = $login_data['ip'];
		
		$this->load->view("info/profile",array("data"=>$data));
	}
	/**
	 * edit profile
	 * 
	 */
	public function edit(){
		$uid = rbac_conf(array('INFO','uid')); 
		$query = $this->db->query("SELECT fullname,gender,email,phone,birth FROM User WHERE uid = '{$uid}'");
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$gender = $this->input->post("gender");
				$email = $this->input->post("email");
				$phone = $this->input->post("phone");
				$birth = $this->input->post("birth");
				if($uid!=""){
					if($uid&&$gender&&$email&&$phone&&$birth){
						$sql = "UPDATE User set gender = '{$gender}', email='{$email}', phone='{$phone}',birth = '{$birth}' WHERE uid = '{$uid}'";
						$this->db->query($sql);
						success_redirct("info/profile/index","Edit successful!");
					}else{
						error_redirct("","The user's information is not complete!");
					}
				}else{
					error_redirct("","No user is found!");
				}
			}
			$this->load->view("info/profile/edit",array("data"=>$data));
		}else{
			error_redirct("info/profile/index","No user is found!");
		}
	}
	/**
	 * reset password
	 */
	public function reset(){
		$uid = rbac_conf(array('INFO','uid'));
		$query = $this->db->query("SELECT password FROM User WHERE uid = '".$uid."'");
		$data = $query->row_array();
		if($uid!=""){
			$password = $data['password'];
			$password1 = md5($this->input->post("password1"));
			$password2 = md5($this->input->post("password2"));
			if($password==$password1){
				if($password1==$password2){
					$sql = "UPDATE User SET password = '{$password1}' WHERE uid = '".$uid."'";
					$this->db->query($sql);
					success_redirct("info/profile/index","Reset successful!");
				}else{
					error_redirct("","Repeat the wrong password!");
				}
			}else{
				error_redirct("","Old password doesn't match!");
			}
		}else{
			error_redirct("","No user is found!");
		}
		
		$this->load->view("info/profile/reset",array("data"=>$data));
	}

}


