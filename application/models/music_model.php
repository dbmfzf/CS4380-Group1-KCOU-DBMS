<?php

class Music_model extends CI_Model {

    //Initialize the connection to the database
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Input: param songName which is a string
    // Return value: a json array with the results
    public function searchBySong($songName){
        $songName = htmlspecialchars($songName);
        
        //SQL string
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE s.title LIKE '" . $this->db->escape_like_str($songName) . 
        "%' AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        //used to prevent sql injection attacks
        //$this->db->escape($songName);
        //$this->db->escape_like_str($search)
        
        //gets the return object from the query
        $queryObj = $this->db->query($sql);
        return json_encode($queryObj->result());
    }
    
    public function searchByArtist($artistName){
        $artistName = htmlspecialchars($artistName);
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE ar.name LIKE '%" . $this->db->escape_like_str($artistName) . 
        "%' AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return json_encode($queryObj->result());
    }
    
    public function searchByAlbum($albumName){
        $albumName = htmlspecialchars($albumName);
        
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE al.title LIKE '%" . $this->db->escape_like_str($albumName) . 
        "%' AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return json_encode($queryObj->result());
    }
    
    //Searches for album name, artist name, and song name all at once
    public function genericSearch($searchString){
        $searchString = htmlspecialchars($searchString);
        
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE (al.title LIKE '%" . $this->db->escape_like_str($searchString) . 
        "%' OR ar.name LIKE '%" . $this->db->escape_like_str($searchString) .
        "%' OR s.title LIKE '%" . $this->db->escape_like_str($searchString) . 
        "%') AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return json_encode($queryObj->result());
    }
    //Input: a genre of music that is exact
    public function searchByGenre($genre){
        $genre = htmlspecialchars($genre);
        
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE s.category = '" . $this->db->escape($genre) 
        . "' AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return json_encode($queryObj->result());
    }
    
    //Input: data is an array containing the uid of the user and the string that was searched for
    //Output: none
    public function searchAlbum($data){
        $uid = htmlspecialchars($data['uid']);
        $searchString = htmlspecialchars($data['searchString']);
        $sql = "";
        $this->db->query($sql);
    }
    
    public function searchSong($data){
        $uid = htmlspecialchars($data['uid']);
        $searchString = htmlspecialchars($data['searchString']);
        $sql = "";
        $this->db->query($sql);
    }
    
    public function searchArtist($data){
        $uid = htmlspecialchars($data['uid']);
        $searchString = htmlspecialchars($data['searchString']);
        $sql = "";
        $this->db->query($sql);
    }

}

