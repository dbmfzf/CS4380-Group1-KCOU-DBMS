<?php for($i=1;$i<=7;$i++){ 
 			$date[]=date("Y-m-d",strtotime("-$i day"));
 			
		} 
			$date_string = implode("OR date_time = ", "'{$date}'");
			echo $date_string;
?>
