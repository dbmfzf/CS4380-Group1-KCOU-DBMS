<script>
<?php
        foreach($user_gender_data as $key){
		 $gender[]=$key['gender'];
		 $gender_num[]=intval($key['gender_num']);
	}
	$gender_data = array(array("name"=>$gender,"data"=>$gender_num));
	$gender_data = json_encode($gender_data);
	echo $gender_data;
?>
$(function () {
        // Build the chart
        $('#gender').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Gender'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: <?php echo $gender_data; ?>
            }]
        });
});
</script>
<h1>Distribution of users</h1>
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#home" data-toggle="tab">By department</a>
   </li>
   <li><a href="#second" data-toggle="tab">By gender</a></li>
   <li><a href="#third" data-toggle="tab">By role</a></li>
</ul>
<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="home">
      <div id="dept" style="min-width: 310px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <div id="gender" style="min-width: 310px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div class="tab-pane fade" id="third">
      <div id="role" style="min-width: 310px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%"><?php echo $gender_data; ?></div>
   </div>
</div>
