<style>
.table td:first-child{width:30%}
.table td:nth-child(2){width:40%}
</style>
<h1>Are you sure to delete this show(<?php echo $data["show_id"]; ?>)?</h1>

<form method="POST" action="">
	<input type="hidden" name="verfiy" value="1" >
	<input class="btn btn-success"  type="submit" value="OK">
	<a class="btn btn-danger" href="<?php echo site_url('show/showController/index'); ?>">Cancel</a>
</form>
