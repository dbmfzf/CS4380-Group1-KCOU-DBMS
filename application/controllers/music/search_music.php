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
        $input = $this->input->get(NULL, TRUE); // returns all GET items with XSS filter
        print_r($input);
        $data = array();
        //Call a different search handler based on what get keys are set
        if(array_key_exists('searchString', $input)){
            $data['searchValues'] = $this->genericSearchHandler($input);
        }else if(array_key_exists('artistName', $input) && array_key_exists('albumName', $input) && array_key_exists('songName', $input) && array_key_exists('genreName', $input)){
            $data['searchValues'] = $this->advancedSearchHandler($input);
        }else{
            $data['searchValues'] = NULL;
        }
        print_r($data);
        $this->load->view("music/search_music.php", $data);
    }
    
    //Input: get request from the ajax in the search_music view
    //Output: JSON array of the song information
    private function genericSearchHandler($input){
        $JSONstring = strlen($input['searchString']) > 0 ? $this->music_model->genericSearch($input['searchString']) : "";
        //echo empty($JSONstring) ? "" : "$JSONstring";
        return empty($JSONstring) ? "" : json_encode($JSONstring);
    }
    
    //Input: get request from ajax in the search_music view
    //Output: JSON array of song information
    private function advancedSearchHandler($input){
        //run queries or do nothing if the inputs are empty
        $JSONArtist = strlen($input['artistName']) > 0 ? $this->music_model->searchByArtist($input['artistName']): "";
        $JSONAlbum = strlen($input['albumName']) > 0 ? $this->music_model->searchByAlbum($input['albumName']) : "";
        $JSONSong = strlen($input['songName']) > 0 ? $this->music_model->searchBySong($input['songName']) : "";
        $JSONGenre = strlen($input['genreName']) > 0 ? $this->music_model->searchByGenre($input['genreName']) : "";
        
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
            return;
        }
        
        //Merge all of the query results into $mergedArr if the song is contained in all valid arrays
        $mergedArr = $arrsToMerge[0];
        for($i = 1; $i < sizeof($arrsToMerge); $i++){
            $mergedArr = array_uintersect($mergedArr, $arrsToMerge[$i], function ($a1, $a2) { return $a1 != $a2; });
        }
        
        //echo(json_encode(array_unique($mergedArr, SORT_REGULAR)));
        return json_encode(array_unique($mergedArr, SORT_REGULAR));
    }
}