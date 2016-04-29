<?php 

          foreach($news_data as $row){
     	          $news_count[]= $row['news_num'];
     	          $user_name[]= $row['fullname'];
        	          $news_arr[] = array( 
                               $row['fullname'],intval($row['news_num']) 
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
            category :[<?php echo $volunteer_name;?>
            ],
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
            data: [<?php echo $news_cnt;?>
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
</script>

