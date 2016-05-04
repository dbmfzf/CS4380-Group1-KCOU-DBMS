<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytics extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function user()
	{
		$user_dept_query = $this->db->query("SELECT D.name as dept_name, count(*) as user_num FROM User U, Department D, Role R WHERE R.rid = U.rid AND R.did = D.did GROUP BY D.did");
		$user_dept_data = $user_dept_query->result_array();
		
		$user_gender_query = $this->db->query("SELECT gender,count(*) as user_num FROM USER GROUP BY gender");
		$user_gender_data = $user_gender_query->result_array();

		$user_role_query = $this->db->query("SELECT count(*) as user_num, R.name as role_name FROM User U, Role R WHERE R.rid = U.rid GROUP BY R.rid");
		$user_role_data = $user_role_query->result_array();
		
		$this->load->view("manage/about_user",array("user_dept_data"=>$user_dept_data,"user_gender_data"=>$user_gender_data,"user_role_data"=>$user_role_data));
	}
	
	public function usage(){
		
		for($i=1;$i<=7;$i++){ 
			$temp_date = date("Y-m-d",strtotime("-$i day"));
 			$date[]= "'{$temp_date}'";
 			
 			$total_query = $this->db->query("SELECT count(*) as cnt,substr(date_time,1,10) as login_date FROM login_record WHERE substr(date_time,1,10) = '{$temp_date}'");
			$total_data = $total_query->row_array;
			$total_arr[] = $total_data['cnt'];
			
		} 
		$date_string = implode(",", $date);
		//echo $date_string;
		$query=$this->db->query("SELECT count(*) as cnt,substr(date_time,1,10) as login_date FROM login_record WHERE substr(date_time,1,10) IN ($date_string) GROUP BY substr(date_time,1,10) ORDER BY substr(date_time,1,10)");
		$data = $query->result_array();
		$this->load->view("manage/about_usage",array("data"=>$data,"$total_data"=>$total_arr));
		
	}

}
