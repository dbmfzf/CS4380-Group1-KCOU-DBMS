<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		//cancel rewrite VIEW
		//$this->view_override = FALSE;
		$uid = rbac_conf(array('INFO','uid'));
		$user_query = $this->db->query("SELECT fullname,gender FROM User WHERE uid = '".$uid."' limit 1");
		$user_data = $user_query -> row_array();
		 
		$role_query = $this->db->query("SELECT name from Role R, User U where U.rid = R.rid and U.uid = '".$uid."' limit 1");
		$role_data = $role_query -> row_array();
		
		$dept_query = $this->db->query("SELECT name from Department D, Belongs_to B, User U where U.uid = B.uid and D.did = B.did and U.uid = '".$uid."' limit 1");
		$dept_data = $dept_query -> row_array();
		
		$login_query = $this->db->query("SELECT * FROM Login_record WHERE uid = '".$uid."' order by log_id desc limit 1");
		$login_data = $login_query -> row_array();
		
		$recent_query = $this->db->query("SELECT SS.sid as song_id,S.title as song_title FROM Search_song SS,Song S WHERE S.sid = SS.sid AND SS.uid = '".$uid."' order by date_time desc limit 1");
		$most_recently_searched = $recent_query->row_array();
		
		$most_query = $this->db->query("SELECT S1.sid as song_id, S.title as song_title FROM Search_song S1, Song S WHERE S1.sid = S.sid AND S1.uid = '".$uid."' group by S1.sid having count(*) = (SELECT MAX(S2.sid) FROM Search_song S2 WHERE S2.uid = '".$uid."' group by S2.sid) order by S1.date_time desc limit 1");
		$most_searched = $most_query->row_array();
		
		//$message_query = $this->db->query();
		//$manager_message = $message_query -> row_array();
		
		$header = 'Home';
		
		$data['header'] = $header;
		$data['fullname'] = $user_data['fullname'];
		$data['gender'] = $user_data['gender'];
		$data['role'] = $role_data['name'];
		$dept_data['name'] == NULL?$data['dept'] = "No department!":$data['dept'] = $dept_data['name'];
		$login_data['date_time'] ==NULL?$data['last_login_time'] = "First login!":$data['last_login_time'] = $login_data['date_time'];
		$login_data['ip']== NULL?$data['last_login_ip'] = "First login!":$data['last_login_ip'] = $login_data['ip'];
		$data['most_rencently_sid'] = $most_recently_searched['song_id'];
		$data['most_rencently_title'] = $most_recently_searched['song_title'];
		$data['most_sid'] = $most_searched['song_id'];
		$data['most_title'] = $most_searched['song_title'];
		
		$this->load->view("product/index",array("data"=>$data));
	}

}
