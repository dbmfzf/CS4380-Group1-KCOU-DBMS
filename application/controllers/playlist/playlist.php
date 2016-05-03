<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Playlist extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * User index
	 * @param number $page
	 */
	public function index($page=1)
	{
		$login_uid = rbac_conf(array('INFO','uid')); 

		$cnt_query = $this->db->query("SELECT COUNT(*) AS cnt FROM Playlist WHERE uid = '{$login_uid}'");
		$cnt_data = $cnt_query->row_array();
		//page
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("playlist/playlist/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 10;
		$config['uri_segment']= '4';
		$config['num_links']='2';
		$config['first_link'] = 'First';
		$config['last_link'] = 'last';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		
		$query = $this->db->query("SELECT * FROM Playlist WHERE uid = '{$login_uid}' LIMIT ".(($page-1)*$config['per_page']).",".$config['per_page']."");
		$data = $query->result();
		
		$this->load->view("playlist/index",array("data"=>$data));
	}
	/**
	 * Edit users
	 * @param number $uid
	 */
	 
	public function add_music($sid){
		$login_uid = rbac_conf(array('INFO','uid'));
		$song_query = $this -> db ->query("SELECT title FROM Song WHERE sid = '{$sid}'");
		$song_data = $song_query-> row_array();
		$playlist_query = $this -> db ->query("SELECT pid,name FROM playlist P, User U WHERE P.uid = U.uid AND U.uid = '{$login_uid}'");
		$playlist_data = $playlist_query ->result();
		if($this->input->post()){
			$pid = $this->input->post("pid");
			echo $pid;
			if($pid){
				$query = $this->db->query("SELECT * FROM Playlist P, User U, Song_in_playlist S WHERE S.pid = P.pid AND P.uid = U.uid AND P.pid ={$pid} AND U.uid = '{$login_uid}' AND S.sid = '{$sid}'");
				$data = $query->row_array();
				if(!$data){
					$sql = "INSERT INTO Song_in_playlist(pid,sid) values('{$pid}','{$sid}')";
					$this->db->query($sql);
					success_redirct("playlist/playlist/index","Add successful!");
					
				}else{
					error_redirct("","The song has already been added to this playlist!");
				}
			
			}else{
				error_redirct("","The playlist doesn't exist!");
			}
		}else{
			$this->load->view("playlist/add_music",array("playlist_data"=>$playlist_data,"song_data"=>$song_data));
		}
	}
	
	public function see_all_songs($pid){
		if($pid){
			$query = $this->db->query("SELECT s.title AS Song_title, ar.name AS Artist, al.title AS Album, s.category AS Genre, al.location AS Location 
			FROM song s,produces aps,artist ar,releases r,album al,playlist p
			WHERE aps.sid = s.sid AND ar.artist_id = aps.artist_id AND ar.artist_id = r.artist_id AND al.album_id = r.album_id and p.sid = s.sid and p.pid = '{$pid}'; ");
			$this->load->view("playlist/see_all_songs",array("song_data"=>$data));
		}else{
			error_redirct("","The playlist doesn't exist!");
		}

	}
	 
	public function edit($pid){
		$login_uid = rbac_conf(array('INFO','uid')); 
		$query = $this->db->query("SELECT name,memo FROM Playlist WHERE uid = '{$login_uid}'");
		$data = $query->row_array();
		if($this->input->post()){
			$name = $this->input->post("name");
			$memo = $this->input->post("memo");
			if($name){
				$query = $this->db->query("SELECT * FROM Playlist WHERE uid = '{$login_uid}' AND name = '{$name}' AND pid!='{$pid}'");
				$data = $query->row_array();
				if(!$data){
					$created_date = date('Y-m-d');
					$sql = "update Playlist set name = '{$name}',memo = '{$memo}'";
					$this->db->query($sql);
					success_redirct("playlist/playlist/index","Add successful!");
					
				}else{
					error_redirct("","The playlist's name already exists!");
				}
				
			}else{
				error_redirct("","The playlist's information is not complete!");
			}
		}else{
			$this->load->view("playlist/edit",array("data"=>$data));
		}

	}
	
	/**
	 * Add users
	 */
	 
	public function add(){
		$login_uid = rbac_conf(array('INFO','uid'));  
		if($this->input->post()){
			$name = $this->input->post("name");
			$memo = $this->input->post("memo");
			if($name){
				$query = $this->db->query("SELECT * FROM Playlist WHERE uid = '{$login_uid}' AND name = '{$name}'");
				$data = $query->row_array();
				if(!$data){
					$created_date = date('Y-m-d');
					$sql = "INSERT INTO Playlist (uid,name,memo,created_date) values('{$login_uid}','{$name}',{$memo},'{$created_date}')";
					$this->db->query($sql);
					success_redirct("playlist/playlist/index","Add successful!");
					
				}else{
					error_redirct("","The playlist's name already exists!");
				}
				
			}else{
				error_redirct("","The playlist's information is not complete!");
			}
		}
		else{
			$this->load->view("playlist/add");
		}
	}
	/**
	 * Delete playlists
	 * @param number $id
	 */
	public function delete($pid){
		$query = $this->db->query("SELECT * FROM Playlist WHERE pid = '{$pid}'");
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM Playlist WHERE pid = '{$pid}'";
					$this->db->query($sql);
					success_redirct("playlist/playlist/index","Delete successful!");
				}else{
					error_redirct("playlist/playlist/index","Delete failed!");
				}
			}
			$this->load->view("playlist/delete",array("data"=>$data));
		}else{
			error_redirct("playlist/playlist/index","No playlist is found!");
		}
	}
}
