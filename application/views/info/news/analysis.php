<?php 

          foreach($news_data as $row){
     	          $news_count[]= $row['news_num'];
        	          $dept_arr[] = array( 
                              "name"=> $row['dept_name'],"y"=>intval($row['user_num']) 
                    ); 
        	}
        	$dept_data = json_encode($dept_arr);
        	

?>
