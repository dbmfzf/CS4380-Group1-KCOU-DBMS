<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * news index
	 */
	public function index($page=1)
	{
		$login_uid = rbac_conf(array('INFO','uid'));
		$login_rid = rbac_conf(array('INFO','rid'));
		$role_query = $this->db->query("SELECT r.name as rname from role r WHERE r.rid = '".$login_rid."'");
		$role_data = $role_query->row_array();
		$login_rname = $role_data['rname'];
		
		$query = $this->db->query("SELECT COUNT(1) as cnt FROM news n, submits s WHERE s.uid = '{$login_uid}'");
		$cnt_data = $query->row_array();
		//page
		$this->load->library('pagination');
		$config['base_url'] = site_url("info/news/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 5;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		
		if($login_rname=="Manager"){
			$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid");
			$news_data = $news_query->result();
			$this->load->view("info/news",array("news_data"=>$news_data));
		
		}elseif ($login_name=="News dept leader"){
			$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid");
			$news_data = $news_query->result();
			$this->load->view("info/news",array("news_data"=>$news_data));
		}else{
			$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid and s.uid = '{$login_uid}'");
			$news_data = $news_query->result();
			$this->load->view("info/news",array("news_data"=>$news_data));
		}
		

	}
	/**
	 * 	News edit
	 */
	public function edit($nid)
	{
		$login_uid = rbac_conf(array('INFO','uid'));
		$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid and n.nid = '".$nid."'");
		$news_data = $query->row_array();
		 
		
		$data['nid'] = $news_data['nid'];
		$data['title'] = $news_data['title'];
		$data['type'] = $news_data['type'];
		$content = $news_data['content'];
		


		
		if($data){
			if($this->input->post()){
				$title = $this->input->post("title");
				$type = $this->input->post("type");
				$last_modified_time = date('Y-m-d H:i:s',time());
				
						$sql = "update news set title = '{$title}',type = '{$type}',content = '{$content}' where nid = '{$nid}')";
						$this->db->query($sql);
						$sub_sql = "update submits set uid = '{$login_uid}', last_modified_time = '{$last_modified_time}', submit_time = '{$submit_time}' where nid = '{$nid}')";
						$this->db->query($sub_sql);
						success_redirct("info/department/index","Edit successful!");
			}
			$this->load->view("info/news/edit",array("data"=>$data ));
		}else{
			error_redirct("info/news/index","No news is found!");
		}
	}
	/**
	 * Edit Content
	 */
	public function edit_content($nid){
		$login_uid = rbac_conf(array('INFO','uid'));
		if($this->input->post()){
			$content = $this->input->post["content"];
			$last_modified_time = date('Y-m-d H:i:s',time());
			$news_query = $this->db->query("SELECT n.nid, n.title, n.type, s.last_modified_time, s.submit_time FROM news n, submits s WHERE s.nid = n.nid and n.nid = '".$nid."'");
			$news_data = $query->row_array();
			$title = $news_data['title'];
			$type = $news_data['type'];
			$submit_time = $news_data['submit_time'];
			
			//SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid
			$sql = "update news set title = '{$title}',type = '{$type}',content = '{$content}' where nid = '{$nid}')";
			$this->db->query($sql);
			$sub_sql = "update submits set uid = '{$login_uid}', last_modified_time = '{$last_modified_time}', submit_time = '{$submit_time}' where nid = '{$nid}')";
			$this->db->query($sub_sql);
			success_redirct("info/news/index","Edit successful!");
	
		}else{
			$this->load->view("info/news/edit_content");
		}
	}
	/**
	 * Add news
	 */
	public function add(){
		$login_uid = rbac_conf(array('INFO','uid'));
		if($this->input->post()){
			$nid = $this->input->post("nid");
			$title = $this->input->post("title");
			$type = $this->input->post("type");
			$last_modified_time = date('Y-m-d H:i:s',time());
			$submit_time = date('Y-m-d H:i:s',time());
			//SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid
			$sql = "INSERT INTO news (nid, title, type,content) values('{$nid}','{$title}','{$type}','')";
			$this->db->query($sql);
			$sub_sql = "INSERT INTO submits (nid, uid, last_modified_time, submit_time) values('{$nid}', '{$login_uid}','{$last_modified_time}','{$submit_time}')";
			$this->db->query($sub_sql);
			success_redirct("info/news/index","Add successful!");	
	
		}else{
			$this->load->view("info/news/add");
		}
	}
	
	/**
	 * Delete departments
	 */
	public function delete($nid){
		$query = $this->db->query("SELECT * FROM news WHERE nid = '".$nid."' ");
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM news WHERE nid = '".$nid."' ";
					$this->db->query($sql);
					success_redirct("info/news/index","Delete successful!");
				}else{
					error_redirct("info/news/index","Delete cancelled!");
				}
			}
			$this->load->view("info/news/delete",array("data"=>$data));
		}else{
			error_redirct("info/news/index","No department is found!");
		}
	}
}
