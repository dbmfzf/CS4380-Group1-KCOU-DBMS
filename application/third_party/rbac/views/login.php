<?php $this->load->view("head");?>
	<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><?php echo $this->config->item('project_name'); ?></a>
        </div>
      </div><!-- /.container -->
    </div><!-- /.navbar -->

	<div class="container">
		<div class="row" style="padding-top:100px">
		
			<div class="col-sm-offset-4 col-sm-4">
					<div class="panel panel-primary">
						<div class="panel-heading">User login</div>
						<div class="panel-body">
						
						<form class="form-horizontal" role="form"  action="" method="post">
							<div class="input-group">
							  <span class="input-group-addon">User ID</span>
							  <input type="text" class="form-control" placeholder="Please input your user id" name="uid">
							</div>
							<br/>
							<div class="input-group">
							  <span class="input-group-addon">Password</span>
							  <input type="password" class="form-control" placeholder="please input your password" name="password">
							</div>
							<br/>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-8">
									<input type="hidden" name="foward" value="null"/>
									<button type="submit" class="btn btn-primary btn-block" data-loading-text="Please wait...">Login</button>
								</div>
							</div>
							</form>
						</div>
					</div>
					<div class="alert alert-success">Test accout（ID:admin PWD:admin）</div>
					</div>
				</div>
			</div>
			
<?php $this->load->view("foot");?>
