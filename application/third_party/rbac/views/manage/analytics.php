<h1>Distribution of users</h1>
<script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../../../Public/Js/HighCharts/highcharts.js"></script>
<script type="text/javascript">
<?php
	include("../../conn.php");
	$openid=$_COOKIE["openid"];
	$tpo=$_GET[tpo];
	$rsql = "select number,score,adddate from history where openid='$openid' and tpo='$tpo' and flag='reading' order by number;";
	$rresult=mysql_query($rsql,$conn);
	while($rrow = mysql_fetch_array($rresult))
	{
		 $readdate[]=$rrow['adddate'];
		 $readnum[]=intval($rrow['number']);
		 $reading[]=intval($rrow['score']);
	}
	$rn = json_encode($readnum);
	$rdata = array(array("name"=>$readdate,"data"=>$reading));
	$rdata = json_encode($rdata);
	
	$lsql = "select number,score,adddate from history where openid='$openid' and flag='listening' and tpo='$tpo' order by number;";
	$lresult=mysql_query($lsql,$conn);
	while($lrow = mysql_fetch_array($lresult))
	{
		 $listendate[]=$lrow['adddate'];
		 $lnumber[]=intval($lrow['number']);
		 $listening[]=intval($lrow['score']);
	}
	$ln = json_encode($lnumber);
	$ldata = array(array("name"=>$listendate,"data"=>$listening));
	$ldata = json_encode($ldata);
?>
$(function () {
    $(document).ready(function () {
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
</script>
<ul id="myTab" class="nav nav-tabs">
   <li class="active"><a href="#home" data-toggle="tab">By department</a>
   </li>
   <li><a href="#second" data-toggle="tab">By gender</a></li>
   <li><a href="#third" data-toggle="tab">By role</a></li>
</ul>
<div id="myTabContent" class="tab-content">
   <div class="tab-pane fade in active" id="home">
      <div id="dept" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
   </div>
   <div class="tab-pane fade" id="second">
      <p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和 Apple 
      TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS 是苹果的移动版本。</p>
   </div>
   <div class="tab-pane fade" id="third">
      <p>jMeter 是一款开源的测试软件。它是 100% 纯 Java 应用程序，用于负载和性能测试。</p>
   </div>
</div>
