<?php 
	foreach($data as $row){
		$login_arr[] = $row["login_date"];
		$count_arr[] = intval($row["cnt"]);
	}
	$login_date = json_encode($login_arr);
	$login_cnt = json_encode($count_arr);
	
	for($i=1;$i<=7;$i++){ 
		$date_arr[] = date("Y-m-d",strtotime("-$i day"));
		$total_arr[] = intval($total_data[$i-1]);
	}
	$total_cnt = json_encode(array_reverse($total_arr));
	$date_data = json_encode(array_reverse($date_arr));
?>
<h1>Usage tracking for the previous 7(at most) days</h1>
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#home" data-toggle="tab">General</a>
   </li>
   <li><a href="#second" data-toggle="tab">Specific</a></li>
</ul>
<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="home">
      <div align ="center" id="general" style="min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <div align ="center" id="specific" style="min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
</div>
<script>
$(function () {
    $('#general').highcharts({
        title: {
            text: 'General usage(ignore the day having no login record)',
            x: -20 //center
        },
        subtitle: {
            text: '<?php echo date("Y-m-d"); ?>',
            x: -20
        },
        xAxis: {
            categories: <?php echo $login_date; ?>
        },
        yAxis: {
            title: {
                text: 'Login Record'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'item(s)'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Total',
            data: <?php echo $login_cnt; ?>
        }]
    });
        $('#specific').highcharts({
        title: {
            text: 'Specific usage(for different roles)',
            x: -20 //center
        },
        subtitle: {
            text: '<?php echo date("Y-m-d"); ?>',
            x: -20
        },
        xAxis: {
            categories: <?php echo $date_data; ?>
        },
        yAxis: {
            title: {
                text: 'Login Record'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'item(s)'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Total',
            data: <?php echo $total_cnt; ?>
        }]
    });
});
</script>
