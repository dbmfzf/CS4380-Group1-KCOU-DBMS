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
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre, al.location AS Location
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE s.title LIKE '%" . $this->db->escape_like_str($songName) . 
        "%' AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        //used to prevent sql injection attacks
        //$this->db->escape($songName);
        //$this->db->escape_like_str($search)
        
        //gets the return object from the query
        $queryObj = $this->db->query($sql);
        return $queryObj->result_array();
    }
    
    public function searchByArtist($artistName){
        $artistName = htmlspecialchars($artistName);
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre, al.location AS Location
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE ar.name LIKE '%" . $this->db->escape_like_str($artistName) . 
        "%' AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return $queryObj->result_array();
    }
    
    public function searchByAlbum($albumName){
        $albumName = htmlspecialchars($albumName);
        
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre, al.location AS Location
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE al.title LIKE '%" . $this->db->escape_like_str($albumName) . 
        "%' AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return $queryObj->result_array();
    }
    
    //Searches for album name, artist name, and song name all at once
    public function genericSearch($searchString){
        $searchString = htmlspecialchars($searchString);
        
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre, al.location AS Location
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE (al.title LIKE '%" . $this->db->escape_like_str($searchString) . 
        "%' OR ar.name LIKE '%" . $this->db->escape_like_str($searchString) .
        "%' OR s.title LIKE '%" . $this->db->escape_like_str($searchString) . 
        "%') AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return $queryObj->result_array();
    }
    //Input: a genre of music that is exact
    public function searchByGenre($genre){
        $genre = htmlspecialchars($genre);
        
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre, al.location AS Location
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE s.category = " . $this->db->escape($genre) 
        . " AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return $queryObj->result_array();
    }
    
    //Input: data is an array containing the uid of the user and the string that was searched for
    //Output: none
    public function searchAlbum($data){
        $uid = htmlspecialchars($data['uid']);
        $albumName = htmlspecialchars($data['albumName']);
        $albumID = "select album_id FROM album WHERE title=" . $this->db->escape($albumName) . ";";
        $albumIDs = $this->db->query($albumID);
        for($i = 0; $i < $albumIDs->num_rows(); $i++){
            $albumID = $albumIDs->row($i)->album_id;
            $sql = "INSERT INTO search_album (uid, album_id, date_time) VALUES (" . $this->db->escape($uid) . ",'" . $albumID . "', NOW());";
            $this->db->query($sql);
        }
    }
    
    public function searchSong($data){
        $uid = htmlspecialchars($data['uid']);
        $songName = htmlspecialchars($data['songName']);
        $songID = "select sid FROM song WHERE title=" . $this->db->escape($songName) . ";";
        $songIDs = $this->db->query($songID);
        for($i = 0; $i < $songIDs->num_rows(); $i++){
            $songID = $songIDs->row($i)->sid;
            $sql = "INSERT INTO search_song (uid, sid, date_time) VALUES (" . $this->db->escape($uid) . ",'" . $songID . "', NOW());";
            $this->db->query($sql);
        }
    }
    
    public function searchArtist($data){
        $uid = htmlspecialchars($data['uid']);
        $artistName = htmlspecialchars($data['artistName']);
        $artistID = "select artist_id FROM artist WHERE name=" . $this->db->escape($artistName) . ";";
        $artistIDs = $this->db->query($artistID);
        for($i = 0; $i < $artistIDs->num_rows(); $i++){
            $artistID = $artistIDs->row($i)->artist_id;
            $sql = "INSERT INTO search_artist (uid, artist_id, date_time) VALUES (" . $this->db->escape($uid) . ",'" . $artistID . "', NOW());";
            $this->db->query($sql);
        }
    }
    
    public function getPopularSongs($number){
        $sql = "SELECT s.title AS Song, al.title AS Album, ar.name AS Artist, s.category AS Genre, count(*) AS count, al.location AS Location FROM search_song sa, song s, produces p, artist ar, releases r, album al
                WHERE s.sid = sa.sid AND ar.artist_id = p.artist_id AND p.sid = s.sid AND r.album_id = al.album_id AND r.artist_id = ar.artist_id GROUP BY s.sid ORDER BY count(*) DESC;";
        $result = $this->db->query($sql)->result();
        $resultArr = array();
        for($i = 0; $i < min(count($result), $number); $i++){
            array_push($resultArr, $result[$i]);
        }
        return $resultArr;
    }
    
    public function getPopularArtists($number){
        $sql = "SELECT a.name AS Artist, count(*) AS count FROM search_artist sa, artist a WHERE sa.artist_id = a.artist_id GROUP BY a.artist_id ORDER BY count(*) DESC;";
        $result = $this->db->query($sql)->result();
        $resultArr = array();
        for($i = 0; $i < min(count($result), $number); $i++){
            array_push($resultArr, $result[$i]);
        }
        return $resultArr;
    }
    
    public function getPopularAlbums($number){
        $sql = "SELECT a.title AS Album, ar.name AS Artist, count(*) AS count, a.location AS Location FROM search_album sa, album a, releases r, artist ar 
                WHERE a.album_id = sa.album_id AND r.artist_id = ar.artist_id GROUP BY a.album_id ORDER BY count(*) DESC;";
        $result = $this->db->query($sql)->result();
        $resultArr = array();
        for($i = 0; $i < min(count($result), $number); $i++){
            array_push($resultArr, $result[$i]);
        }
        return $resultArr;
    }
}

