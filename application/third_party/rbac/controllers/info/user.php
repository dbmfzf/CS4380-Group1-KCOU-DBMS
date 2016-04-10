<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI RBAC
 * RBAC管理后台中用户模块
 * @author		toryzen
 * @link		http://www.toryzen.com
 */
class User extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/**
	 * 人员列表
	 * @param number $page
	 */
	public function index($page=1)
	{
		$query = $this->db->query("SELECT COUNT(1) as cnt FROM User");
		$cnt_data = $query->row_array();
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url("info/user/index");
		$config['total_rows'] = $cnt_data['cnt'];
		$config['per_page']   = 35;
		$config['uri_segment']= '4';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$query = $this->db->query("SELECT U.*,name FROM User U LEFT JOIN Role R ON R.rid = U.rid LIMIT ".(($page-1)*$config['per_page']).",".$config['per_page']."");
		$data = $query->result();
		$this->load->view("info/user",array("data"=>$data));
	}
	/**
	 * 人员修改
	 * @param number $uid
	 */
	public function edit($uid){
		$query = $this->db->query("SELECT U.*,name FROM User U LEFT JOIN Role R ON R.rid = U.rid WHERE U.uid = '".$uid."'");
		$data = $query->row_array();
		$role_query = $this->db->query("SELECT rid,name FROM Role WHERE status = 1");
		$role_data = $role_query->result();
		if($data){
			if($this->input->post()){
				$uid = $this->input->post("uid");
				$fullname = $this->input->post("fullname");
				$email = $this->input->post("email");
				$role = $this->input->post("role");
				$status = $this->input->post("status");
				$password = $this->input->post("password");
				$password2 = $this->input->post("password2");
				if($uid!=""){
					if($password==$password2){
						if($uid){
							if($password){$newpass = ",password='".md5($password2)."'";}else{$newpass="";}
							if($status){$newstat = ",status='1'";}else{$newstat = ",status='0'";}
							if($role){$newrole = ",rid={$role}";}else{$newrole = ",rid=NULL";}
							$sql = "UPDATE User set fullname='{$fullname}',email='{$email}' {$newpass} {$newstat} {$newrole} WHERE uid = '{$uid}'";
							$this->db->query($sql);
							success_redirct("info/user/index","Edit successful!");
						}else{
							error_redirct("","The user's information is not complete!");
						}
					}else{
						error_redirct("","Invaild password!");
					}
				}else{
					error_redirct("","No user is found!");
				}
			}
			$this->load->view("info/user/edit",array("data"=>$data,"role_data"=>$role_data));
		}else{
			error_redirct("info/user/index","No user is found!");
		}
	}
	/**
	 * 人员增加
	 */
	public function add(){
		$role_query = $this->db->query("SELECT rid,name FROM Role WHERE status = 1");
		$role_data = $role_query->result();
		if($this->input->post()){
			$uid = $this->input->post("uid");
			$fullname = $this->input->post("fullname");
			$email = $this->input->post("email");
			$role = $this->input->post("role");
			$status = $this->input->post("status");
			$password = md5($this->input->post("password"));
			$password2 = md5($this->input->post("password2"));
			if($password==$password2){
				if($uid&&$fullname&&$email&&$password2){
					$query = $this->db->query("SELECT * FROM User WHERE uid = '".$uid."'");
					$data = $query->row_array();
					if(!$data){
						$query = $this->db->query("SELECT * FROM User WHERE email = '".$email."'");
						$data = $query->row_array();
						if(!$data){
							if(!$status){$newstat = "0";}else{$newstat = "1";}
							$sql = "INSERT INTO User (uid,fullname,email,password,rid,status) values('{$uid}','{$fullname}','{$email}' ,'{$password2}','{$role}', '{$status}')";
							$this->db->query($sql);
							success_redirct("info/user/index","Add successful!");
						}else{
							error_redirct("","The email already exists!");
						}
					}else{
						error_redirct("","The user ID already exists!");
					}
					
				}else{
					error_redirct("","The user's information is not complete!");
				}
			}else{
				error_redirct("","Invalid password!");
			}
		}
		$this->load->view("info/user/add",array("role_data"=>$role_data));
	}
	/**
	 * 人员删除
	 * @param number $id
	 */
	public function delete($uid){
		$query = $this->db->query("SELECT * FROM User WHERE uid = '".$uid."' ");
		$data = $query->row_array();
		if($data){
			if($this->input->post()){
				$verfiy = $this->input->post("verfiy");
				if($verfiy){
					$sql = "DELETE FROM User WHERE uid = '".$uid."' ";
					$this->db->query($sql);
					success_redirct("info/user/index","Delete successful!");
				}else{
					error_redirct("info/user/index","Delete faild!");
				}
			}
			$this->load->view("info/user/delete",array("data"=>$data));
		}else{
			error_redirct("info/user/index","No user is found!");
		}
	}

}


