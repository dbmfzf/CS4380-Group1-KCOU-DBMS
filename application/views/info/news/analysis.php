<?php 
foreach($news_data as $row){
    $news_arr[] = array( 
      $row['fullname'],  intval($row['news_num']) 
    ); 
}

foreach($news_type_data as $row){
    $news_type_arr[] = array(
        $row['type'],intval($row['news_cnt'])
    );
    
}

$news_data = json_encode($news_arr);
$news_type_data = json_encode($news_type_arr);

?>

<h1>Rankings!</h1>
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#home" data-toggle="tab">Contributors</a>
   </li>
   <li><a href="#second" data-toggle="tab">News types</a></li>
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
            text: 'Top 3 Contributors'
        },
        subtitle:{
            text: '<?php echo date("Y-m-d");?>'  
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
                text: 'Submission amount'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'This user submitted <b>{point.y} piece(s) of news</b>'
        },
        series: [{
            name: 'Name',
            data: <?php echo $news_data; ?>,
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
        subtitle:{
            text: '<?php echo date("Y-m-d");?>'  
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
                text: 'News amount'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'We have{point.y} piece(s) of news in this type</b>'
        },
        series: [{
            name: 'Name',
            data: <?php echo $news_type_data; ?>,
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

