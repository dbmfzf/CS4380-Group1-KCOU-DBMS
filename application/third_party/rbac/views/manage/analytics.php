<?php 
          $today = date("Y-m-d");
     	foreach($user_gender_data as $row){
     	          $gender_cnt[]= $row['user_num'];
        	          $gender_arr[] = array( 
                              "name"=> $row['gender'],"y"=>intval($row['user_num']) 
                    ); 
        	}
        	$gender_data = json_encode($gender_arr);
        	
        	foreach($user_dept_data as $row){
     	          $dept_cnt[]= $row['user_num'];
        	          $dept_arr[] = array( 
                              "name"=> $row['dept_name'],"y"=>intval($row['user_num']) 
                    ); 
        	}
        	$dept_data = json_encode($dept_arr);
?>
<script>
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#gender').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Male:<?php echo $gender_cnt[0];?> Female:<?php echo $gender_cnt[1];?>'
            },
            subtitle: {
                text: '<?php echo $today;?>'
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
                data: <?php echo $gender_data;?>
            }]
        });
        
        $('#dept').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Department'
            },
            subtitle: {
                text: '<?php echo $today;?>'
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
                data: <?php echo $dept_data;?>
            }]
        });
        
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
      <div align ="center" id="dept" style="min-width: 310px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <div align ="center" id="gender" style="min-width: 310px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div  class="tab-pane fade" id="third">
      <div align ="center" id="role" style="min-width: 310px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
</div>
