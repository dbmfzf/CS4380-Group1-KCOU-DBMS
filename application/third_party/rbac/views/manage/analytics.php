<h1>Distribution of users</h1>
<script>
$(function () {
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
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Microsoft Internet Explorer',
                    y: 56.33
                }, {
                    name: 'Chrome',
                    y: 24.03,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Firefox',
                    y: 10.38
                }, {
                    name: 'Safari',
                    y: 4.77
                }, {
                    name: 'Opera',
                    y: 0.91
                }, {
                    name: 'Proprietary or Undetectable',
                    y: 0.2
                }]
            }]
        });
});
</script>
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#home" data-toggle="tab">By department</a>
   </li>
   <li><a href="#second" data-toggle="tab">By gender</a></li>
   <li><a href="#third" data-toggle="tab">By role</a></li>
</ul>
<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="home">
      <div id="dept" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto; padding-top:10%"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <div id="gender" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto; padding-top:10%"></div>
   </div>
   <div class="tab-pane fade" id="third">
      <div id="role" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto; padding-top:10%"></div>
   </div>
</div>
