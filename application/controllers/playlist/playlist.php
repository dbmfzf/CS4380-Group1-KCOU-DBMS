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
	
	public function see_all_songs($pid){
		$query = $this->db->query("");

	}
	 
	public function edit($pid){
		$login_uid = rbac_conf(array('INFO','uid')); 
		$name_query = $this->db->query("SELECT name FROM Playlist WHERE uid = '{$login_uid}'");
		$name_data = $name_query->row_array();
		if($this->input->post()){
			$fullname = $this->input->post("name");
			if($name){
				$query = $this->db->query("SELECT * FROM Playlist WHERE uid = '{$uid}'");
				$data = $query->row_array();
				if(!$data){
					$created_date = date('Y-m-d');
					$sql = "INSERT INTO Playlist (uid,name,created_date) values('{$uid}','{$name}','{$created_date}')";
					$this->db->query($sql);
					success_redirct("playlist/playlist/index","Add successful!");
					
				}else{
					error_redirct("","The playlist's name already exists!");
				}
				
			}else{
				error_redirct("","The playlist's information is not complete!");
			}
		}else{
			$this->load->view("playlist/playlist/edit",array("name_data"=>$info_data));
		}

	}
	
	/**
	 * Add users
	 */
	 
	public function add(){
		$login_uid = rbac_conf(array('INFO','uid'));  
		if($this->input->post()){
			$name = $this->input->post("name");
			if($name){
				$query = $this->db->query("SELECT * FROM Playlist WHERE uid = '{$login_uid}'");
				$data = $query->row_array();
				if(!$data){
					$created_date = date('Y-m-d');
					$sql = "INSERT INTO Playlist (uid,name,created_date) values('{$login_uid}','{$name}','{$created_date}')";
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
