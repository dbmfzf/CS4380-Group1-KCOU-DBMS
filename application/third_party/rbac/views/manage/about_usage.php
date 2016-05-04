<?php for($i=1;$i<=7;$i++){ 
			$temp_date = date("Y-m-d",strtotime("-$i day"));
 			$date[]= "'{$temp_date}'";
 			
		} 
			$date_string = implode(",", $date);
			echo $date_string;
?>
