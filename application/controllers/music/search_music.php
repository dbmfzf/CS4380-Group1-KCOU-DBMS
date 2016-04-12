<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class search_music extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("music_model");
        $this->load->library('javascript');
    }
    
    public function index(){
        
        $this->load->view("music/search_music.php");
    }
}