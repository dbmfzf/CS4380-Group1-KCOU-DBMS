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
		$user_query = $this->db->query("SELECT fullname,gender FROM User WHERE uid = '{$uid}' limit 1");
		$user_data = $user_query -> row_array();
		
		$rid = rbac_conf(array('INFO','rid'));
		$role_dept_query = $this->db->query("SELECT R.name as rolename, D.name as deptname from Role R, Department D where D.did = R.did and R.rid = '".$rid."' limit 1");
		$role_dept_data = $role_dept_query -> row_array();
		
		$login_query = $this->db->query("SELECT * FROM Login_record WHERE uid = '{$uid}' AND log_id != (SELECT MAX(log_id) FROM Login_record WHERE uid = '".$uid."') order by log_id desc limit 1");
		$login_data = $login_query -> row_array();
		
		$recent_query = $this->db->query("SELECT S.title as song_title FROM Search_song SS,Song S WHERE S.sid = SS.sid AND SS.uid = '{$uid}' order by date_time desc limit 1");
		$most_recently_searched = $recent_query->row_array();
		
		$most_query = $this->db->query("SELECT S.title as song_title FROM Search_song S1, Song S WHERE S1.sid = S.sid AND S1.uid = '{$uid}' group by S1.sid having count(*) = (SELECT count(*) as cnt FROM Search_song S2 WHERE S2.uid = '{$uid}' group by S2.sid ORDER BY date_time limit 1) order by S1.date_time desc limit 1");
		$most_searched = $most_query->row_array();
		
		//$message_query = $this->db->query();
		//$manager_message = $message_query -> row_array();
		
		$header = 'Home';
		
		$data['header'] = $header;
		$data['fullname'] = $user_data['fullname'];
		$data['gender'] = $user_data['gender'];
		$data['role_dept'] = $role_dept_data['rolename']."(".$role_dept_data['deptname'].")";
		$login_data['date_time'] ==NULL?$data['last_login_time'] = "First login!":$data['last_login_time'] = $login_data['date_time'];
		$login_data['ip']== NULL?$data['last_login_ip'] = "First login!":$data['last_login_ip'] = $login_data['ip'];
		//$most_recently_searched['song_path'] == NULL?$data['most_rencently_path'] = "":$data['most_rencently_path'] = $most_recently_searched['song_path'];;
		$most_recently_searched['song_title'] == NULL?$data['most_rencently_title'] = "No search record!":$data['most_rencently_title'] = $most_recently_searched['song_title'];
		//$most_searched['song_path'] == NULL?$data['most_path'] = "":$data['most_path'] = $most_recently_searched['song_path'];;
		$most_searched['song_title'] == NULL?$data['most_title'] = "No search record!":$data['most_title'] = $most_recently_searched['song_title'];
		
		$this->load->view("product/index",array("data"=>$data));
	}
}
