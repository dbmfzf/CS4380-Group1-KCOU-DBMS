<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class showController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model("show_model");
		$this -> load -> helper('html');
		$this -> load -> helper('url');
		$this -> load -> library('javascript');
	}

	public function index() {
		$login_uid = rbac_conf(array('INFO','uid'));
		$login_rid = rbac_conf(array('INFO','rid'));
		$role_query = $this->db->query("SELECT r.name as rname from role r WHERE r.rid = '".$login_rid."'");
		$role_data = $role_query->row_array();
		$login_rname = $role_data['rname'];
		
		if($this->input->post()){
			
			$shows = $this->input->post("shows");
			if($this->input->post("type")){$type = implode(',',$this->input->post("type"));}else{$type=null;}
			//if($this->input->post("day")){$day = implode(',',$this->input->post("day"));}else{$day=null;}
			$day =  $this->input->post("day");
			if($this->input->post("order")){$order = implode(',',$this->input->post("order"));}else{$order=null;}
			
			if($shows){
				$shows_query = $this->db->query("SELECT s.show_id, s.title, s.category, description, u.fullname as actor, r.start_time, r.end_time, showdate, day FROM shows s, responses r,user u where u.uid = r.uid AND s.show_id = r.show_id AND (s.show_id = '{$shows}' OR s.title like '%{$shows}%') ");
				$shows_data = $shows_query->result();
			}else{
				
				if($type){$where_type = "AND s.category in (".$type.")";}else{$where_type = "";}
				if($day){$where_day = "AND day in (".$day.")";}else{$where_day = "";}
				if($order == "start_time" | $order == "end_time"){$order_by = "ORDER BY ".$order." desc";}else if ($order){$order_by = "ORDER BY ".$order."";}else{$order_by = "";}
				$shows_query = $this->db->query("SELECT s.show_id, s.title, s.category, description, u.fullname as actor, r.start_time, r.end_time,showdate,day FROM shows s, responses r,user u where u.uid = r.uid AND s.show_id = r.show_id {$where_type} {$where_day} {$order_by}");
				$shows_data = $shows_query->result();
			}
			
		}else{
		
			if($login_rname=="Manager"){
				$shows_query = $this->db->query("select s.show_id,title,category,description,u.fullname as actor, r.start_time, r.end_time, showdate, day from shows s, responses r, user u where u.uid = r.uid and s.show_id = r.show_id");
				$shows_data = $shows_query->result();
			
			}else if($login_rname=="Shows dept leader"){
				$shows_query = $this->db->query("select s.show_id,title,category,description,u.fullname as actor, r.start_time, r.end_time, showdate, day from shows s, responses r, user u where u.uid = r.uid and s.show_id = r.show_id");
				$shows_data = $shows_query->result();
			}else{
				$shows_query = $this->db->query("select s.show_id,title,category,description,u.fullname as actor, r.start_time, r.end_time, showdate, day from shows s, responses r, user u where u.uid = r.uid and s.show_id = r.show_id AND r.uid = '{$login_uid}'");
				$shows_data = $shows_query->result();
				
			}
		}
		$this->load->view("show/showInfo",array("shows_data"=>$shows_data,"role_data"=>$role_data));
	}
/*add*/

	public function add(){
		$login_uid = rbac_conf(array('INFO','uid'));
		if($this->input->post()){
			$sid = $this->input->post("sid");
			$title = $this->input->post("title");
			$type = $this->input->post("type");
			$actor = $this->input->post("actor");
			//$date = $this->input->post("date");
			$start_time = $this->input->post("start_time");
			$end_time = $this->input->post("end_time");
			$weekday = $this->input->post("weekday");
			//$last_modified_time = date('Y-m-d H:i:s',time());
			//$submit_time = date('Y-m-d H:i:s',time());
			//SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid
			if($sid&&$title&&$type&&$actor&&$start_time&&$end_time){
				$query = $this->db->query("SELECT * FROM responses r WHERE r.show_id = '{$sid}'"); 
				$result = $query->row_array();
				$actorQuery = $this->db->query("SELECT * FROM user WHERE uid = '{$actor}'"); 
				$actorResult = $query->row_array();
				if(!$result){
					$showType = $this->input->post("showType");
					if($showType == "Special show"){
						$date = $this->input->post("date");
						$queryString = "select * from responses 
						where showdate = '{$date}' and ((start_time <'{$start_time}' and end_time> '{$start_time}') 
						or (start_time <'{$end_time}' and end_time> '{$end_time}') 
						or (start_time >= '{$start_time}' and end_time <= '{$end_time}'));";
						$query = $this->db->query($queryString); 
						$specialConflit = $query->row_array();
						if(!$specialConflit){
							$queryString = "select * from responses 
										where showdate = '0000-00-00' and ((start_time <'{$start_time}' and end_time> '{$start_time}') 
										or (start_time <'{$end_time}' and end_time> '{$end_time}') 
										or (start_time >= '{$start_time}' and end_time <= '{$end_time}'));";
							$query = $this->db->query($queryString); 
							$normalConflit = $query->row_array();
							//insertion
							$sub_sql = "INSERT INTO shows values('{$sid}', '{$title}','{$type}','')";
							$this->db->query($sub_sql);
							$sql = "INSERT INTO responses values('{$sid}','{$actor}','{$start_time}','{$end_time}','{$weekday}','{$date}')";
							$this->db->query($sql);
							
							if(!$normalConflit){
								success_redirct("show/showController/index","Add successful!");
							}else{
								success_redirct("show/showController/index","Time conflict with a normal show. we already add your show, but please schule your time with this normal show or delete your show");
							}
						}else{
							error_redirct("","Time conflict with a special show, please check your time");
						}
					}else if($showType == "Normal show"){
						$queryString = "select * from responses 
										where day = '{$weekday}' and showdate = '0000-00-00' and ((start_time <'{$start_time}' and end_time> '{$start_time}') 
										or (start_time <'{$end_time}' and end_time> '{$end_time}') 
										or (start_time >= '{$start_time}' and end_time <= '{$end_time}'));";
						$query = $this->db->query($queryString); 
						$normalConflit = $query->row_array();
						if(!$normalConflit){
							$queryString = "select * from responses 
										where day = '{$weekday}' and showdate <> '0000-00-00' and ((start_time <'{$start_time}' and end_time> '{$start_time}') 
										or (start_time <'{$end_time}' and end_time> '{$end_time}') 
										or (start_time >= '{$start_time}' and end_time <= '{$end_time}'));";
							$query = $this->db->query($queryString); 
							$specialConflit = $query->row_array();
							//insertion
							$sub_sql = "INSERT INTO shows values('{$sid}', '{$title}','{$type}','')";
							$this->db->query($sub_sql);
							$sql = "INSERT INTO responses values('{$sid}','{$actor}','{$start_time}','{$end_time}','{$weekday}','0000-00-00')";
							$this->db->query($sql);
							if(!$specialConflit){
								success_redirct("show/showController/index","Add successful!");
							}else {
								success_redirct("show/showController/index","Time conflict with a sepcial show. we already add your show, normal show have the highest priority!");
							}
						}else {
							error_redirct("","Time conflict with another normal show, please check your time");
						}
					}else{
						error_redirct("","Show Type error");
					}
				}else{
					error_redirct("","The show ID already exists or the user name is invalid!");
				}
			}else{
				error_redirct("","The news information is not complete!");
			}
	
		}else{
			$this->load->view("show/add");
		}
	}
	
	//shows edit
	public function edit($sid)
	{
		$login_uid = rbac_conf(array('INFO','uid'));
		$shows_query = $this->db->query("SELECT s.sid, s.title, s.category as type, s.description as content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid and n.nid = '".$nid."'");
		$news_data = $shows_query->row_array();
		 
		$data['nid'] = $news_data['nid'];
		$data['title'] = $news_data['title'];
		$data['type'] = $news_data['type'];
		$submit_time = $news_data['submit_time'];
		$content = $news_data['content'];
		
		if($data){
			if($this->input->post()){
				$title = $this->input->post("title");
				$type = $this->input->post("type");
				$last_modified_time = date('Y-m-d H:i:s',time());
				if($title&&$type&&$last_modified_time){
					$sql = "update news set title = '{$title}',type = '{$type}',content = '{$content}' where nid = '{$nid}'";
					$this->db->query($sql);
					$sub_sql = "update submits set uid = '{$login_uid}', last_modified_time = '{$last_modified_time}', submit_time = '{$submit_time}' where nid = '{$nid}'";
					$this->db->query($sub_sql);
					success_redirct("info/news/index","Edit successful!");
				}else{
					error_redirct("","The news information is not complete!");	
				}
			}
				$this->load->view("info/news/edit",array("data"=>$data ));
		}else{
			error_redirct("info/news/index","No news is found!");
		}
	}

	//edit content
	public function edit_content($sid){
		$shows_query = $this->db->query("SELECT s.show_id, s.description as content FROM shows s WHERE show_id = '".$sid."'");
		$shows_data = $shows_query->row_array();
		//$title = $news_data['title'];
		//$type = $news_data['type'];
		//$submit_time = $news_data['submit_time'];
		$login_uid = rbac_conf(array('INFO','uid'));
		
		if($this->input->post()){
			//$content = $this->input->post["content"];
			//$last_modified_time = date('Y-m-d H:i:s',time());
			$content = $_POST["content"];
			
			//SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid
			//$sql = "update news set title = '{$title}',type = '{$type}',content = '{$content}' where nid = '{$nid}'";
			//$this->db->query($sql);
			$sql = "update shows set description = '{$content}' where show_id = '{$sid}'";
			$this->db->query($sql);
			//$sub_sql = "update submits set uid = '{$login_uid}', last_modified_time = '{$last_modified_time}', submit_time = '{$submit_time}' where nid = '{$nid}'";
			//$this->db->query($sub_sql);
			//$sub_sql = "update submits set last_modified_time = '{$last_modified_time}' where nid = '{$nid}'";
			//$this->db->query($sub_sql);
			success_redirct("show/showController/index","Edit successful!");
	
		}else{
			$this->load->view("show/edit_content",array("shows_data"=>$shows_data));
		}
	}

	//delete
	public function delete($sid){
		$query = $this->db->query("SELECT * FROM shows WHERE show_id = '".$sid."' ");
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM responses WHERE show_id = '".$sid."' ";
					$this->db->query($sql);
					$sub_sql = "DELETE FROM shows WHERE show_id = '".$sid."' ";
					$this->db->query($sub_sql);
					
					success_redirct("show/showController/index","Delete successful!");
				}else{
					error_redirct("show/showController/index","Delete cancelled!");
				}
			}
			$this->load->view("show/delete",array("data"=>$data));
		}else{
			error_redirct("show/showController/index","No show found!");
		}
	}
	
	public function genericSearchHandler() {
		$startdate = parseDateTime($this->input->get("start",TRUE));
		$enddate = parseDateTime($this->input->get("end",TRUE));
		echo json_encode($startdate.$enddate);
		return;
		/*require base_url() . 'static/full-calendar/utils.php';

		// Short-circuit if the client did not give us a date range.
		if (!isset($_GET['start']) || !isset($_GET['end'])) {
			die("Please provide a date range.");
		}

		// Parse the start/end parameters.
		// These are assumed to be ISO8601 strings with no time nor timezone, like "2013-12-29".
		// Since no timezone will be present, they will parsed as UTC.
		$range_start = parseDateTime($_GET['start']);
		$range_end = parseDateTime($_GET['end']);

		// Parse the timezone parameter if it is present.
		$timezone = null;
		if (isset($_GET['timezone'])) {
			$timezone = new DateTimeZone($_GET['timezone']);
		}

		// Read and parse our events JSON file into an array of event data arrays.
		$jsondata = base_url().'static/full-calendar/events.json';
		$json = file_get_contents($jsondata);
		$input_arrays = json_decode($json, true);

		// Accumulate an output array of event data arrays.
		$output_arrays = array();
		foreach ($input_arrays as $array) {

			// Convert the input array into a useful Event object
			$event = new Event($array, $timezone);

			// If the event is in-bounds, add it to the output
			if ($event -> isWithinDayRange($range_start, $range_end)) {
				$output_arrays[] = $event -> toArray();
			}
		}

		// Send JSON to the client.
		echo json_encode($output_arrays);
		return;*/
		
	}

	public function getUnreadMessageCount() {
		$time = $this -> input -> post('currentTime');
		$count = $this -> message_model -> searchMessageCount($time);
		echo $count;
		return;
	}

	public function getMessageProfile() {

	}

	public function getMessageContent() {

	}

	public function setMessageContent() {

	}

}
