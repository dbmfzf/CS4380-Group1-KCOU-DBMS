<?php 

          foreach($news_data as $row){
     	          $news_count[]= $row['news_num'];
     	          $user_name[]= $row['fullname'];
     	          $name = $row['fullname'];
        	          $news_arr[] = array( 
                               'name',  intval($row['news_num']) 
                    ); 
        	}
        	$news_data = json_encode($news_arr);
        	$news_cnt[]= json_encode($news_count);
     	$volunteer_name[]= json_encode($user_name);
        	

?>

<script type="text/javascript" src="<?php echo base_url();?>static/highcharts/js/barchart.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/highcharts/js/exporting.js"></script>

<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

<script>
var arr = <?php echo $volunteer_name[];?>;
var str = JSON.stringify(arr);
var newArr = JSON.parse(str);
while (newArr.length > 0) {
    newArr.pop();
}
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
            data: <?php echo $news_data;?>,
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
/*
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'World\'s largest cities per 2014'
        },
        subtitle: {
            text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>'
        },
        series: [{
            name: 'Population',
            data: [
                ['Shanghai', 23.7],
                ['Lagos', 16.1],
                ['Istanbul', 14.2],
                ['Karachi', 14.0],
                ['Mumbai', 12.5],
                ['Moscow', 12.1],
                ['São Paulo', 11.8],
                ['Beijing', 11.7],
                ['Guangzhou', 11.1],
                ['Delhi', 11.1],
                ['Shenzhen', 10.5],
                ['Seoul', 10.4],
                ['Jakarta', 10.0],
                ['Kinshasa', 9.3],
                ['Tianjin', 9.3],
                ['Tokyo', 9.0],
                ['Cairo', 8.9],
                ['Dhaka', 8.9],
                ['Mexico City', 8.9],
                ['Lima', 8.9]
            ],
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
</script>

