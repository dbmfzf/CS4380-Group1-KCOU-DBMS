<?php 
	foreach($data as $row){
		$login_arr[] = $row["login_date"];
	}
	$login_date = json_encode($login_arr);
?>
<h1>Usage tracking for the previous 7 days</h1>
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
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2,]
        }, {
            name: 'New York',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8]
        }, {
            name: 'Berlin',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0]
        }]
    });
});
</script>
