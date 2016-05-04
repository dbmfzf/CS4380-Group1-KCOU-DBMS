<?php 
	foreach($data as $row){
		$login_arr[] = $row["login_date"];
		$count_arr[] = intval($row["cnt"]);
	}
	$login_date = json_encode($login_arr);
	$login_cnt = json_encode($count_arr);
?>
<h1>Usage tracking for the previous 7(at most) days</h1>
<div align ="center" id="container" style="min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
<script>
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Usage tracking for the previous 7 days',
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
            name: 'Tokyo',
            data: <?php echo $login_cnt; ?>
        }]
    });
});
</script>
