<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Rbac config
|--------------------------------------------------------------------------
*/
$config['rbac_auth_on']	             = TRUE;			      	//Enable access control
$config['rbac_auth_type']	         = '2';			     		
$config['rbac_auth_key']	         = 'MyAuth';		 		//SESSION flag
$config['rbac_auth_gateway']         = 'Index/login';    		//gateway
$config['rbac_default_index']        = 'product/index/index';   //default index
$config['rbac_manage_menu_hidden']   = array('Content Management');		//hidden menu
$config['rbac_manage_node_hidden']   = array('manage');			//hidden
$config['rbac_notauth_dirc']         = array('');	     	    //array("public","manage")
/* End of file rbac.php */
/* Location: ./application/third_party/rbac/config/rbac.php */
