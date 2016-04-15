<h1>Edit role</h1>
<form role="form" action="" method="post">
  <div class="form-group">
    <label>Role level</label>
    <input name="level" type="text" class="form-control" value="<?php echo $data['level']; ?>">
  </div>
  <div class="form-group">
    <label>Role name</label>
    <input name="rolename" type="text" class="form-control" value="<?php echo $data['name']; ?>">
  </div>
  <div class="form-group">
    <label>Department</label>
      <select name="dept" class="form-control" >
        <?php 
	    	foreach($dept_data as $key){
	    	    $select = $data['did']==$key->did?"selected":"";
	    	    printf('<option value ="%s">%s</oprtion>',$key->did,$key->deptname);
	    	}

        ?>
      </select>
  </div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" <?php if($data["status"]){echo "checked";}?>> Enable?
    </label>
  </div>
  <input type="hidden" name="rid" value="<?php echo $data['rid'];?>">
  <button type="submit" class="btn btn-success">Save</button>
  <a class="btn btn-danger" href="<?php echo site_url('manage/role/index'); ?>">Cancel</a>
</form>
