<?php

class Show_model extends CI_Model {

    //Initialize the connection to the database
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
	public function index()
	{
		$login_uid = rbac_conf(array('INFO','uid'));
		$login_rid = rbac_conf(array('INFO','rid'));
		$role_query = $this->db->query("SELECT r.name as rname from role r WHERE r.rid = '".$login_rid."'");
		$role_data = $role_query->row_array();
		$login_rname = $role_data['rname'];
		
		if($this->input->post()){
			
			$news = $this->input->post("news");
			if($this->input->post("type")){$type = implode(',',$this->input->post("type"));}else{$type=null;}
			$submit_start = $this->input->post("submit_start");
			$submit_end = $this->input->post("submit_end");
			if($this->input->post("order")){$order = implode(',',$this->input->post("order"));}else{$order=null;}
			
			if($news){
				$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time, u.fullname as author FROM news n, submits s，user u WHERE u.uid = s.uid AND n.nid = s.nid AND (n.nid = '{$news}' OR N.title like '%{$news}%') ");
				$news_data = $news_query->result();
			}else{
				
				if($type){$where_type = "AND n.type in (".$type.")";}else{$where_type = "";}
				if($submit_start){$where_start = "AND s.submit_time > '{$submit_start}'";}else{$where_start = "";}
				if($submit_end){$where_end = "AND s.submit_time < '{$submit_end}'";}else{$where_end = "";}
				if($order){$order_by = "ORDER BY ".$order."";}else{$order_by = "";}
				$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time, u.fullname as author FROM user u, news n, submits s WHERE u.uid = s.uid AND n.nid = s.nid {$where_type} {$where_start} {$where_end} {$order_by}");
				$news_data = $news_query->result();
			}
			
		}else{
		
			if($login_rname=="Manager"){
				$news_query = $this->db->query("select s.show_id,title,category,description,u.fullname as actor, r.start_time, r.end_time, day from shows s, responses r, user u where u.uid = r.uid and s.show_id = r.show_id");
				$news_data = $news_query->result();
			
			}else if($login_rname=="Shows dept leader"){
				$news_query = $this->db->query("select s.show_id,title,category,description,u.fullname as actor, r.start_time, r.end_time, day from shows s, responses r, user u where u.uid = r.uid and s.show_id = r.show_id");
				$news_data = $news_query->result();
			}else{
				$news_query = $this->db->query("select s.show_id,title,category,description,u.fullname as actor, r.start_time, r.end_time, day from shows s, responses r, user u where u.uid = r.uid and s.show_id = r.show_id AND r.uid = '{$login_uid}'");
				$news_data = $news_query->result();
				
			}
		}
		$this->load->view("info/news",array("news_data"=>$news_data,"role_data"=>$role_data));
	}
    public function searchBySong($songName){
        $songName = htmlspecialchars($songName);
        
        //SQL string
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre
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
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE ar.name LIKE '%" . $this->db->escape_like_str($artistName) . 
        "%' AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return $queryObj->result_array();
    }
    
    public function searchByAlbum($albumName){
        $albumName = htmlspecialchars($albumName);
        
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre
        FROM song s, produces aps, artist ar, releases r,  album al
        WHERE al.title LIKE '%" . $this->db->escape_like_str($albumName) . 
        "%' AND aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id;";
        
        $queryObj = $this->db->query($sql);
        return $queryObj->result_array();
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
        return $queryObj->result_array();
    }
    //Input: a genre of music that is exact
    public function searchByGenre($genre){
        $genre = htmlspecialchars($genre);
        
        $sql = "SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre
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
    
    /*public function advancedSearch($data){
        switch($data){
            case
        }
    }*/

}

