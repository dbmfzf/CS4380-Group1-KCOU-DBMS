<h1>Add role</h1>
<form role="form" action="" method="post">
  <div class="form-group">
    <label>Role level</label>
    <input name="level" type="number" class="form-control"  placeholder="Please input role level(a number) here" value="">
  </div>
  <div class="form-group">
    <label>Role name</label>
    <input name="rolename" type="text" class="form-control"  placeholder="Please input role name here" value="">
  </div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" checked > Enable?
    </label>
  </div>
  <button type="submit" class="btn btn-success">Save</button>
  <a class="btn btn-danger" href="<?php echo site_url('manage/role/index'); ?>">Cancel</a>
</form>
