<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class messageController extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("message_model");
        $this->load->helper('html');
        $this->load->library('javascript');
    }
    
    public function index(){
        $this->load->view("message/messageView.php");
    }
    
    public function genericSearchHandler(){
        $JSONstring = $this->music_model->genericSearch($this->input->get('searchString'));
        echo"$JSONstring";
    }
    
	public function getUnreadMessageCount(){
		$time = $this->input->post('currentTime');
		echo $time;
		return;
	}
    public function getMessageProfile(){
    	
    }
	
	public function getMessageContent(){
		
	}
	
	public function setMessageContent(){
		
	}
	
}