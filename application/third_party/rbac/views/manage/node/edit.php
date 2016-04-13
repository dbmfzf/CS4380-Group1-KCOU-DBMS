<h1>Edit node</h1>
<form role="form" action="" method="post">
  <div class="form-group">
    <label>Directoty</label>
    <input name="directory" type="text" class="form-control"  value="<?php echo $data['directory']; ?>" disabled>
  </div>
  <div class="form-group">
    <label>Controller</label>
    <input name="controller" type="text" class="form-control"  value="<?php echo $data['controller']; ?>" disabled>
  </div>
  <div class="form-group">
    <label>Method</label>
    <input name="func" type="text" class="form-control"  value="<?php echo $data['func']; ?>" disabled>
  </div>
  <div class="form-group">
    <label>Memo</label>
    <input name="memo" type="text" class="form-control" placeholder="Please input memo here" value="<?php echo $data['memo']; ?>">
  </div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" <?php if($data['status']){echo "checked";}?>> Enalble?
    </label>
  </div>
  <button type="submit" class="btn btn-success">Save</button>
  <a class="btn btn-danger" href="<?php echo site_url('manage/node/index'); ?>">Cancel</a>
</form>
