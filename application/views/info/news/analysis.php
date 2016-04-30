<?php 

foreach($news_data as $row){
               $news_count[]= $row['news_num'];
               $user_name[]= $row['fullname'];
               $name = $row['fullname'];
                  $news_arr[] = array( 
                     $row['fullname'],  intval($row['news_num']) 
          ); 
        }
        $news_data = json_encode($news_arr);
        $news_cnt[]= json_encode($news_count);
        $volunteer_name[]= json_encode($user_name);
?>

<h1>Rankings!</h1>
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#home" data-toggle="tab">By department</a>
   </li>
   <li><a href="#second" data-toggle="tab">By gender</a></li>
   <li><a href="#third" data-toggle="tab">By role</a></li>
</ul>
<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="home">
      <div align ="center" id="container" style="min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <div align ="center" id="gender" style="min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div  class="tab-pane fade" id="third">
      <div align ="center" id="role" style="min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
</div>

<script>
/*
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Top Contributors'
        },
        xAxis: {
            type: 'category',
            category: ['admin', 'aa']
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
            title: {
                text: 'Name'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'News Submitted'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'This volunteer submitted <b>{point.y:.1f} piece(s) of news</b>'
        },
        series: [{
            name: 'News submission',
            data: [2, 1],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
*/

$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Top3 Contributor'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: 0,
                style: {
                    fontSize: '13px',
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
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});

</script>

