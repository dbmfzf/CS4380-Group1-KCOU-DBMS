<?php 

          foreach($news_data as $row){
     	          $news_count[]= $row['news_num'];
        	          $dept_arr[] = array( 
                              "name"=> $row['fullname'],"y"=>intval($row['news_num']) 
                    ); 
        	}
        	$dept_data = json_encode($dept_arr);
        	

?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
<script>
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'World\'s largest cities per 2014'
        },
        subtitle: {
            text: 'TOP CONTRIBUTORS'
        },
        xAxis: {
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
            title: {
                text: 'News Submitted'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Name'
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
            data: [<?php echo $news_data;?>
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
