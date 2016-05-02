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
		$this -> load -> view("show/show_calander.php");
	}

	public function genericSearchHandler() {
		$startdate = $this->load->get("start");
		$enddate = $this->load->get("end");
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
