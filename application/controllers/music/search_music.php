<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_music extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("music_model");
        $this->load->helper('html');
        $this->load->library('javascript');
    }
    
    public function index(){
        $this->load->view("music/search_music.php");
    }
    
    //Input: get request from the ajax in the search_music view
    //Output: JSON array of the song information
    public function genericSearchHandler(){
        $JSONstring = $this->music_model->genericSearch($this->input->get('searchString'));
        echo"$JSONstring";
        return;
    }
    
    //Input: get request from ajax in the search_music view
    //Output: JSON array of song information
    public function advancedSearchHandler(){
        $JSONArtist = !empty($this->input->get('artistName')) ? $this->music_model->searchByArtist($this->input->get('artistName')): NULL;
        $JSONAlbum = !empty($this->input->get('albumName')) ? $this->music_model->searchByAlbum($this->input->get('albumName')) : NULL;
        $JSONSong = !empty($this->input->get('songName')) ? $this->music_model->searchBySong($this->input->get('songName')) : NULL;
        $JSONGenre = !empty($this->input->get('genreName')) ? $this->music_model->searchByGenre($this->input->get('genreName')) : NULL;
        
        
        echo(json_encode(array_unique(array_merge_recursive($JSONAlbum, $JSONArtist, $JSONGenre, $JSONSong), SORT_REGULAR)));
        return;
    }
}