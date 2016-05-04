<?php 
foreach($normal_data as $row){
    $normal_arr[] = array( 
      $row['day'],  intval($row['shows_num']) 
    ); 
}

foreach($special_type_data as $row){
    $special_type_arr[] = array(
        $row['type'],intval($row['shows_cnt'])
    );
    
}

$shows_data = json_encode($normal_arr);
$special_type_data = json_encode($special_type_arr);

?>

<h1>Rankings!</h1>
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#home" data-toggle="tab">Normal Weekdays Distribution</a>
   </li>
   <li><a href="#second" data-toggle="tab">Special Shows Date Distribution</a></li>
</ul>
<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="home">
      <div align ="center" id="container1" style="width: 800px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <div align ="center" id="container2" style="width: 800px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
</div>

<script>

$(function () {
    $('#container1').highcharts({
        chart: {
            type: 'column',
            //width: 600
        },
        title: {
            text: 'Weekdays Distribution'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: 0,
                style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            allowDecimals:false,
            title: {
                text: 'Shows amount'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'On this weekday we have <b>{point.y} piece(s) of normal shows</b>'
        },
        series: [{
            name: 'Name',
            data: <?php echo $shows_data; ?>,
            dataLabels: {
                enabled: true,
                color: '#FFFFFF',
                align: 'center',
                //format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
    
    
    $('#container2').highcharts({
        chart: {
            type: 'column',
            //width: 600
        },
        title: {
            text: 'News types'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: 0,
                style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            allowDecimals:false,
            title: {
                text: 'Special Shows'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'We have{point.y} piece(s) of shows in this day</b>'
        },
        series: [{
            name: 'Name',
            data: <?php echo $special_type_data; ?>,
            dataLabels: {
                enabled: true,
                color: '#FFFFFF',
                align: 'center',
                //format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '18px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
    
});

</script>

