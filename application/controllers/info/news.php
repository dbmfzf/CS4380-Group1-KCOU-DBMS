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
		$role_query = $this->db->query("SELECT r.name as rname from role r WHERE r.rid = '{$login_rid}'");
		$role_data = $role_query->row_array();
		$login_rname = $role_data['rname'];
		
		/*
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
		*/
		if($this->input->post()){
			
			$news = $this->input->post("news");
			if($this->input->post("type")){$type = implode(',',$this->input->post("type"));}else{$type=null;}
			$submit_start = $this->input->post("submit_start");
			$submit_end = $this->input->post("submit_end");
			if($this->input->post("order")){$order = implode(',',$this->input->post("order"));}else{$order=null;}
			
			if($news){
				$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time, u.fullname as author FROM news n, submits s，user u WHERE u.uid = s.uid AND n.nid = s.nid AND (n.nid = '{$news}' OR n.title like '%{$news}%' ORFER BY n.nid)");
				$news_data = $news_query->result();
			}else{
				
				if($type){$where_type = "AND n.type in (".$type.")";}else{$where_type = "";}
				if($submit_start){$where_start = "AND s.submit_time >= '{$submit_start}'";}else{$where_start = "";}
				if($submit_end){$where_end = "AND s.submit_time <= '{$submit_end}'";}else{$where_end = "";}
				if($order){$order_by = "ORDER BY ".$order."";}else{$order_by = "";}
				$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time, u.fullname as author FROM user u, news n, submits s WHERE u.uid = s.uid AND n.nid = s.nid {$where_type} {$where_start} {$where_end} {$order_by}");
				$news_data = $news_query->result();
			}
			
		}else{
		
			if($login_rname=="Manager"){
				$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time, u.fullname as author FROM user u, news n, submits s WHERE u.uid = s.uid AND n.nid = s.nid ORDER BY n.nid");
				$news_data = $news_query->result();
			
			}else if($login_rname=="News dept leader"){
				$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time, u.fullname as author FROM user u, news n, submits s WHERE u.uid = s.uid AND n.nid = s.nid ORDER BY n.nid");
				$news_data = $news_query->result();
			}else{
				$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time,u.fullname as author FROM user u, news n, submits s WHERE u.uid =s.uid AND n.nid = s.nid AND s.uid = '{$login_uid}' ORDER BY n.nid");
				$news_data = $news_query->result();
				
			}
		}
		$this->load->view("info/news",array("news_data"=>$news_data,"role_data"=>$role_data));
	}
	/**
	 * 	News edit
	 */
	public function edit($nid)
	{
		$login_uid = rbac_conf(array('INFO','uid'));
		$news_query = $this->db->query("SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid and n.nid = '".$nid."'");
		$news_data = $news_query->row_array();
		 
		$data['nid'] = $news_data['nid'];
		$data['title'] = $news_data['title'];
		$data['type'] = $news_data['type'];
		$submit_time = $news_data['submit_time'];
		$content = $news_data['content'];
		
		if($data){
			if($this->input->post()){
				$title = $this->input->post("title");
				$type = $this->input->post("type");
				$last_modified_time = date('Y-m-d H:i:s',time());
				if($title&&$type&&$last_modified_time){
					$sql = "update news set title = '{$title}',type = '{$type}',content = '{$content}' where nid = '{$nid}'";
					$this->db->query($sql);
					$sub_sql = "update submits set uid = '{$login_uid}', last_modified_time = '{$last_modified_time}', submit_time = '{$submit_time}' where nid = '{$nid}'";
					$this->db->query($sub_sql);
					success_redirct("info/news/index","Edit successful!");
				}else{
					error_redirct("","The news information is not complete!");	
				}
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
		$news_query = $this->db->query("SELECT n.nid, n.content FROM news n WHERE n.nid = '".$nid."'");
		$news_data = $news_query->row_array();
		//$title = $news_data['title'];
		//$type = $news_data['type'];
		//$submit_time = $news_data['submit_time'];
		$login_uid = rbac_conf(array('INFO','uid'));
		
		if($this->input->post()){
			//$content = $this->input->post["content"];
			$last_modified_time = date('Y-m-d H:i:s',time());
			$content = $_POST["content"];
			
			//SELECT n.nid, n.title, n.type, n.content, s.last_modified_time, s.submit_time FROM news n, submits s WHERE n.nid = s.nid
			//$sql = "update news set title = '{$title}',type = '{$type}',content = '{$content}' where nid = '{$nid}'";
			//$this->db->query($sql);
			$sql = "update news set content = '{$content}' where nid = '{$nid}'";
			$this->db->query($sql);
			//$sub_sql = "update submits set uid = '{$login_uid}', last_modified_time = '{$last_modified_time}', submit_time = '{$submit_time}' where nid = '{$nid}'";
			//$this->db->query($sub_sql);
			$sub_sql = "update submits set last_modified_time = '{$last_modified_time}' where nid = '{$nid}'";
			$this->db->query($sub_sql);
			success_redirct("info/news/index","Edit successful!");
	
		}else{
			$this->load->view("info/news/edit_content",array("news_data"=>$news_data));
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
			if($nid&&$title&&$type){
				$query = $this->db->query("SELECT * FROM News WHERE nid = '{$nid}'"); 
				$result = $query->row_array();
				if(!$result){
					$sql = "INSERT INTO news (nid, title, type,content) values('{$nid}','{$title}','{$type}','')";
					$this->db->query($sql);
					$sub_sql = "INSERT INTO submits (nid, uid, last_modified_time, submit_time) values('{$nid}', '{$login_uid}','{$last_modified_time}','{$submit_time}')";
					$this->db->query($sub_sql);
					success_redirct("info/news/index","Add successful!");
		
				}else{
					error_redirct("","The news ID already exists!");
				}
			}else{
				error_redirct("","The news information is not complete!");
			}
	
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
					$sub_sql = "DELETE FROM submits WHERE nid = '".$nid."' ";
					$this->db->query($sub_sql);
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

	public function analysis()
	{
		$news_query = $this->db->query("SELECT u.fullname, count(*) as news_num FROM submits s, user u where u.uid = s.uid GROUP BY s.uid ORDER BY news_num DESC limit 3");
		$news_data = $news_query->result_array();
		
		$news_type = $this->db->query("SELECT type, count(*) as news_cnt FROM News N, Submits S WHERE S.nid = N.nid GROUP BY type ORDER BY news_cnt DESC");
		$news_type_data = $news_type -> result_array();
		
		$this->load->view("info/news/analysis",array("news_data"=>$news_data,"news_type_data"=>$news_type_data));
	}
}

