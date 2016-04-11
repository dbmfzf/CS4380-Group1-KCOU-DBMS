<?php

class Music_model extends CI_Model {

    //Initialize the connection to the database
    public function __construct() {
        
        $config['hostname'] = 'us-cdbr-azure-central-a.cloudapp.net';
        $config['username'] = 'bf22456bcb329e';
        $config['password'] = '';
        $config['database'] = 'cs4380-group1';
        $config['dbdriver'] = 'mysqli';
        $config['dbprefix'] = '';
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';

        $this->load->database($config);
    }
    
    // Input: param songName which is a string
    // Return value: an array of some object that is to be defined later
    public function searchBySong($songName){
        $songName = htmlspecialchars($songName);
        
        //SQL string
        $sql = "SELECT * FROM some_table WHERE id LIKE '%" .  $this->db->escape_like_str($search) . "%'";
        
        //used to prevent sql injection attacks
        $this->db->escape($songName);
        $this->db->escape_like_str($search)
        
        //
        $queryObj = $this->db->query($sql, 'id');
    }
    
    public function searchByArtist($artistName){
        $artistName = htmlspecialchars($songName);
        
    }
    
    public function searchByAlbum($albumName){
        $albumName = htmlspecialchars($albumname);
        
    }
    
    //Searches for album name, artist name, and song name all at once
    public function genericSearch($searchString){
        $searchString = htmlspecialchars($searchString);
    }

}

