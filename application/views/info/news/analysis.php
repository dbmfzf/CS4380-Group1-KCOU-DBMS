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
      $row['type']) 
    ); 
    
}

$news_data = json_encode($news_arr);
$news_type_data = json_encode($news_type_arr);
echo $news_type_data;

?>

<h1>Rankings!</h1>
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#home" data-toggle="tab">Top3 contributors</a>
   </li>
   <li><a href="#second" data-toggle="tab">Kazuya</a></li>
   <li><a href="#third" data-toggle="tab">Kame</a></li>
</ul>
<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="home">
      <div align ="center" id="container1" style="min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <div align ="center" id="container2" style="min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
   </div>
   <div  class="tab-pane fade" id="third">
      <div align ="center" id="container3" style="min-width: 600px; height: 450px; max-width: 800px; margin: 0 auto; padding-top:5%"></div>
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
            text: 'Stacked column chart'
        },
        xAxis: {
            categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total fruit consumption'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            name: 'John',
            data: [5, 3, 4, 7, 2]
        }, {
            name: 'Jane',
            data: [2, 2, 3, 2, 1]
        }, {
            name: 'Joe',
            data: [3, 4, 4, 2, 5]
        }]
    });
    
    $('#container3').highcharts({
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
    
});

</script>

