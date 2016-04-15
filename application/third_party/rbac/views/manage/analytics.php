          <?php 
                //$genderarr =array(); 
        		//$numberarr =array(); 
               		foreach($user_gender_data as $row){ 
        			$arr[] = array( 
                                       "name"=> $row['gender'],"y"=>intval($row['user_num']) 
                              ); 
        		}
        		$arr = json_encode($arr); 
        		echo $arr;
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
                text: 'Browser market shares January, 2015 to May, 2015'
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
            series: <?php echo $arr; ?>
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
      <div id="role" style="min-width: 310px; height: 600px; max-width: 800px; margin: 0 auto; padding-top:5%">

      </div>
   </div>
</div>
