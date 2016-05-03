<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-77239814-1', 'auto');
  ga('send', 'pageview');

</script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?php echo base_url();?>static/bootstrap/css/bootstrap.min.css">
		<link href="<?php echo base_url();?>static/offcanvas.css" rel="stylesheet">
        <title>KCOU management system</title>
        <script src="<?php echo base_url();?>static/jquery.js"></script>
	<script src="<?php echo base_url();?>static/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>static/bootstrap/js/respond.min.js"></script>
	<script src="<?php echo base_url();?>static/highcharts/js/highcharts.js"></script>
	<script src="<?php echo base_url();?>static/highcharts/js/modules/exporting.js"></script>
    </head>
    <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
         <?php echo isset($header_title)?$header_title:isset($this->get_menu['list'][$this->uuri])?$this->get_menu['list'][$this->uuri]:""; ?>  
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li id="fat-menu" class="dropdown">
              <a href="#" id="user_action" role="button" class="dropdown-toggle" data-toggle="dropdown">Welcome:<?php echo rbac_conf(array('INFO','uid'));?><b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="user_action">
                <li> <?php echo anchor("Index/logout","<span class='glyphicon glyphicon-log-out'></span> Logout"); ?></li>
              </ul>
          </li>
        </ul>
      </div><!-- /.container -->
    </div><!-- /.navbar -->


