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
        echo $news_arr;
?>

<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

<script>
  var arr = <?php echo $news_data;?>;
  var ds=[]
  for(var k in arr){
      ds.push( typeof(arr[k])=='object'?arr[k]:[k,arr[k]])
  }
//var str = JSON.stringify(arr);
//var newArr = JSON.parse(str);
//while (newArr.length > 0) {
  //  newArr.pop();
//}
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
                ['Lagos', 16.1]
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

