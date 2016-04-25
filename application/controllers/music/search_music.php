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
        /*$data['artist'] = strlen($this->input->get('artistName')) > 0 ? $this->input->get('artistName') : "";
        $data['album'] = strlen($this->input->get('albumName')) > 0 ? $this->input->get('albumName') : "";
        $data['song'] = strlen($this->input->get('songName')) > 0 ? $this->input->get('songName') : "";
        $data['genre'] = strlen($this->input->get('genreName')) > 0 ? $this->input->get('genreName') : "";
        
        $advSearch = $this->music_model->advancedSearch($data);
        */
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
        
        //Merge all of the query results into $mergedArr if the song is contained in all valid arrays
        $mergedArr = $arrsToMerge[0];
        echo("array at index 0: " . json_encode($mergedArr) . "\n");
        for($i = 1; $i < sizeof($arrsToMerge); $i++){
            echo("array at index $i: " . json_encode($arrsToMerge[$i]) . "\n");
            $mergedArr = array_intersect_assoc($mergedArr, $arrsToMerge[$i]);
        }
        
        echo(json_encode(array_unique($mergedArr, SORT_REGULAR)));
        return;
    }
}