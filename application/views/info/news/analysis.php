<?php 

          $today = date("Y-m-d");
          foreach($user_dept_data as $row){
     	          $dept_cnt[]= $row['user_num'];
        	          $dept_arr[] = array( 
                              "name"=> $row['dept_name'],"y"=>intval($row['user_num']) 
                    ); 
        	}
        	$dept_data = json_encode($dept_arr);
        	

?>
