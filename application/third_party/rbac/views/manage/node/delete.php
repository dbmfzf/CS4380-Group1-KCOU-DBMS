<style>
.table td:first-child{width:30%}
.table td:nth-child(2){width:40%}
</style>
<h1>Are you sure to delete the node?</h1>
<h4>Please think twice!</h4>
Tips:
<ul>
    	<li>Delete the directory will also delete all the controllers and methods in it.</li>
    	<li>Delete the controller will also delete all the methods in it.</li>
    	<li>Delete the node will also unlink the menu that was linked to it.</li>
  	</ul>
<hr/>
<form method="POST" action="">
	<input type="hidden" name="verfiy" value="1" >
	<input class="btn btn-success"  type="submit" value="OK">
	<a class="btn btn-danger" href="<?php echo site_url('manage/node/index'); ?>">Cancel</a>
</form>
