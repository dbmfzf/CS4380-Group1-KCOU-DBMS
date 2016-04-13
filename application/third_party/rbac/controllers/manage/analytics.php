<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytics extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		$user_dept_query = $this->db->query("SELECT D.name as dept_name, count(*) as user_num FROM User U, Department D, Belongs_to B WHERE B.uid = U.uid AND B.did = D.did GROUP BY D.did");
		$user_dept_data = $user_dept_query->result();
		
		$user_gender_query = $this->db->query("SELECT count(*) as gender_cnt FROM USER GROUP BY gender");
		$user_gender_data = $user_gender_query->result();
		
		$user_role_query = $this->db->query("SELECT count(*) as user_num, R.name as role_name FROM User U, Role R WHERE R.rid = U.rid GROUP BY R.rid");
		$user_role_data = $user_role_query->result();
		
		$this->load->view("manage/analytics",array("user_dept_data"=>$user_dept_data,"user_gender_data"=>$user_gender_data,"user_role_data"=>$user_role_data));
	}

}
