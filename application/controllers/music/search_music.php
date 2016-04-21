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
        //run queries or do nothing if the inputs are empty
        $JSONArtist = strlen($this->input->get('artistName')) > 0 ? $this->music_model->searchByArtist($this->input->get('artistName')): "";
        $JSONAlbum = strlen($this->input->get('albumName')) > 0 ? $this->music_model->searchByAlbum($this->input->get('albumName')) : "";
        $JSONSong = strlen($this->input->get('songName')) > 0 ? $this->music_model->searchBySong($this->input->get('songName')) : "";
        $JSONGenre = strlen($this->input->get('genreName')) > 0 ? $this->music_model->searchByGenre($this->input->get('genreName')) : "";
        
        //Add the arrays to merge to arrsToMerge
        $arrsToMerge = array();
        if(!empty($JSONArtist)){
            $arrsToMerge[] = $JSONArtist;
        }if(!empty($JSONAlbum)){
            $arrsToMerge[] = $JSONAlbum;
        }if(!empty($JSONSong)){
            $arrsToMerge[] = $JSONSong;
        }if(!empty($JSONGenre)){
            $arrsToMerge[] = $JSONGenre;
        }
        
        //If all the arrays are empty then we exit
        if(sizeof($arrsToMerge) == 0){
            echo"sizeof(arrsToMerge) == 0";
            return;
        }
        
        //Merge all of the query results into $mergedArr
        $mergedArr = array();
        for($i = 0; $i < sizeof($arrsToMerge); $i++){
            echo(json_encode($arrsToMerge[$i]));
            $mergedArr = array_merge($mergedArr, $arrsToMerge[$i]);
        }
        
        echo(json_encode(array_unique($mergedArr, SORT_REGULAR)));
        return;
    }
}