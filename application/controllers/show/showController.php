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
			
			$news = $this->input->post("news");
			if($this->input->post("type")){$type = implode(',',$this->input->post("type"));}else{$type=null;}
			$submit_start = $this->input->post("submit_start");
			$submit_end = $this->input->post("submit_end");
			if($this->input->post("order")){$order = implode(',',$this->input->post("order"));}else{$order=null;}
			
			if($shows){
				$shows_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time, u.fullname as author FROM news n, submits s，user u WHERE u.uid = s.uid AND n.nid = s.nid AND (n.nid = '{$news}' OR N.title like '%{$news}%') ");
				$shows_data = $shows_query->result();
			}else{
				
				if($type){$where_type = "AND n.type in (".$type.")";}else{$where_type = "";}
				if($submit_start){$where_start = "AND s.submit_time > '{$submit_start}'";}else{$where_start = "";}
				if($submit_end){$where_end = "AND s.submit_time < '{$submit_end}'";}else{$where_end = "";}
				if($order){$order_by = "ORDER BY ".$order."";}else{$order_by = "";}
				$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time, u.fullname as author FROM user u, news n, submits s WHERE u.uid = s.uid AND n.nid = s.nid {$where_type} {$where_start} {$where_end} {$order_by}");
				$news_data = $news_query->result();
			}
			
		}else{
		
			if($login_rname=="Manager"){
				$shows_query = $this->db->query("select s.show_id,title,category,description,u.fullname as actor, r.start_time, r.end_time, day from shows s, responses r, user u where u.uid = r.uid and s.show_id = r.show_id");
				$shows_data = $shows_query->result();
			
			}else if($login_rname=="Shows dept leader"){
				$shows_query = $this->db->query("select s.show_id,title,category,description,u.fullname as actor, r.start_time, r.end_time, day from shows s, responses r, user u where u.uid = r.uid and s.show_id = r.show_id");
				$shows_data = $shows_query->result();
			}else{
				$shows_query = $this->db->query("select s.show_id,title,category,description,u.fullname as actor, r.start_time, r.end_time, day from shows s, responses r, user u where u.uid = r.uid and s.show_id = r.show_id AND r.uid = '{$login_uid}'");
				$shows_data = $shows_query->result();
				
			}
		}
		$this->load->view("show/showInfo",array("shows_data"=>$shows_data,"role_data"=>$role_data));
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
