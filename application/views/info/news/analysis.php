<?php 
foreach($news_data as $row){
    //$news_count[]= $row['news_num'];
    //$user_name[]= $row['fullname'];
    //$name = $row['fullname'];
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
   <li class="active"><a href="#home" data-toggle="tab">Top3 contributors</a>
   </li>
   <li><a href="#second" data-toggle="tab">News types</a></li>
</ul>
<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="home">
      <div align ="center" id="container1" style="width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <div align ="center" id="container2" style="width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
</div>

<script>

$(function () {
    $('#container1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Top3 Contributors'
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
                text: 'News submission'
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
            type: 'column'
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
                text: 'Amount'
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

