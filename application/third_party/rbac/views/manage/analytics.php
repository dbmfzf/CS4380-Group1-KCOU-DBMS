<?php 

          $today = date("Y-m-d");
          foreach($user_dept_data as $row){
     	          $dept_cnt[]= $row['user_num'];
        	          $dept_arr[] = array( 
                              "name"=> $row['dept_name'],"y"=>intval($row['user_num']) 
                    ); 
        	}
        	$dept_data = json_encode($dept_arr);
          
     	foreach($user_gender_data as $row){
     	          $gender_cnt[]= $row['user_num'];
        	          $gender_arr[] = array( 
                              "name"=> $row['gender'],"y"=>intval($row['user_num']) 
                    ); 
        	}
        	$gender_data = json_encode($gender_arr);
        	
        	foreach($user_role_data as $row){
     	          $role_cnt[]= $row['user_num'];
        	          $role_arr[] = array( 
                              "name"=> $row['role_name'],"y"=>intval($row['user_num']) 
                    ); 
        	}
        	$role_data = json_encode($role_arr);
        	

?>
<script>
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#dept').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'KCOU'
            },
            subtitle: {
                text: '<?php echo $today;?>'
            },
            tooltip: {
                 formatter: function() {
                         return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.y, 0, ',');
                 }
            },
            plotOptions: {
                pie: {
                    size:60%,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: <?php echo $dept_data;?>
            }]
        });
        
        $('#role').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true,
                type: 'pie'
            },
            title: {
                text: 'KCOU'
            },
            subtitle: {
                text: '<?php echo $today;?>'
            },
            tooltip: {
                 formatter: function() {
                         return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.y, 0, ',');
                 }
            },
            plotOptions: {
                pie: {
                    size:60%,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: <?php echo $role_data;?>
            }]
        });
        
                $('#gender').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: true,
                type: 'pie'
            },
            title: {
                text: 'KCOU'
            },
            subtitle: {
                text: '<?php echo $today;?>'
            },
            tooltip: {
                 formatter: function() {
                         return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.y, 0, ',');
                 }
            },
            plotOptions: {
                pie: {
                    size:60%,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: <?php echo $gender_data;?>
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
      <div align ="center" id="dept" style="width: 600px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <div align ="center" id="gender" style="width: 600px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div  class="tab-pane fade" id="third">
      <div align ="center" id="role" style="width: 600px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
</div>
