<style>
.table td:first-child{width:30%}
.table td:nth-child(2){width:40%}
</style>
<h1>Are you sure to delete this role(<?php echo $data["name"]; ?>)?</h1>
<h4>All the role's previliges will be deleted when you delete the role, please think twice!</h4>

<form method="POST" action="">
	<input type="hidden" name="verfiy" value="1" >
	<input class="btn btn-success"  type="submit" value="OK">
	<a class="btn btn-danger" href="<?php echo site_url('manage/role/index'); ?>">Cancel</a>
</form>
