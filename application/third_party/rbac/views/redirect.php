<?php $this->load->view('head');?>

	<div class="container">
		<div class="row" style="padding-top:100px">
		
			<div class="col-sm-offset-3 col-sm-6">
					<div class="panel panel-<?php if($type=="error")echo "danger";else echo "success";?>">
						<div class="panel-heading"><?php if($type=="error")echo "Error";else echo "Success!";?></div>
						<div class="panel-body">
						
						<h1><?php echo $contents; ?></h1>
    					<h4>Please wait for <span id="cnt"><?php echo $time; ?></span> seconds【<a href="<?php echo $url; ?>">No wait!</a>】</h4>
						<br/>
						
						</div>
					</div>
					</div>
				</div>
			</div>
			<script>
				var i = <?php echo $time-1; ?>;
				function countTime(){
					document.getElementById("cnt").innerHTML = i;
					if(i==0){
						window.location.href='<?php echo $url; ?>';
					}
					i--;
					setTimeout('countTime()',1000);
				}
				window.onload =function() {
				    countTime();
				};
			</script>
<?php $this->load->view("foot");?>
