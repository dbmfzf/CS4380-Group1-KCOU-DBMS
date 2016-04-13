<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_music extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("music_model");
    }
    
    public function index(){
        
        $this->load->view("music/search_music.php");
    }
    
    public function genericSearchHandler(){
        $JSONstring = $this->music_model->genericSearch($this->input->get('searchString'));
        echo"$JSONstring";
    }
    
    public function advancedSearchHandler(){
        
    }
}