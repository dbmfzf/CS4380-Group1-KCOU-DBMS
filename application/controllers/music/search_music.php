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
        $JSONArtist = $this->music_model->searchByArtist($this->input->get('artistName'));
        $JSONAlbum = $this->music_model->searchByAlbum($this->input->get('albumName'));
        $JSONSong = $this->music_model->searchBySong($this->input->get('songName'));
        $JSONGenre = $this->music_model->searchByGenre($this->input->get('genreName'));
        
        $JSON1 = array_merge($JSONArtist, $JSONAlbum);
        $JSON2 = array_merge($JSONSong, $JSONGenre);
        
        echo(json_encode(array_merge($JSON1, $JSON2)));
        return;
    }
}