<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function index($uid)
	{
		//cancel rewrite VIEW
		//$this->view_override = FALSE;
		
		$userquery = $this->db->query("SELECT uid,fullname,gender,birthday FROM User WHERE uid = '".$uid."' limit 1");
		$user_data = $userquery -> row_array();
		 
		$rolequery = $this->db->query("SELECT name from Role R, User U where U.rid = R.rid and U.uid = '".$uid."' limit 1");
		$roledata = $rolequery -> row_array();
		
		$loginquery = $this->db->query("SELECT * FROM Login_record WHERE uid = '".$uid."' order by login_id desc limit 1");
		$login_data = $loginquery -> row_array();
		
		
		$header = 'Home';
		
		$data['header'] = $header;
		$data['uid'] = $user_data['uid'];
		$data['fullname'] = $user_data['fullname'];
		$data['gender'] = $user_data['gender'];
		$data['role'] = $roledata['name'];
		$data['last_login_time'] = $logindata['date_time'];
		$data['last_login_ip'] = $logindata['ip'];
		
		$this->load->view("product/index",array("data"=>$data),);
	}

}
