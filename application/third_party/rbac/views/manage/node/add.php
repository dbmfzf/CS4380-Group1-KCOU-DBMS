<h1>Add new node</h1>
<form role="form" action="" method="post">
  <div class="form-group">
    <label>Directory</label>
    <input name="directory" type="text" class="form-control" placeholder="Please input directory here" value="<?php if(isset($directory)){echo $directory;} ?>" <?php if(isset($directory)){echo "disabled";} ?>>
  </div>
  <div class="form-group">
    <label>Controller</label>
    <input name="controller" type="text" class="form-control" placeholder="please input controller here" value="<?php if(isset($controller)){echo $controller;} ?>" <?php if(isset($controller)){echo "disabled";} ?>>
  </div>
  <div class="form-group">
    <label>Method</label>
    <input name="func" type="text" class="form-control" placeholder="please input method here" value="<?php if(isset($func)){echo $func;} ?>" <?php if(isset($func)){echo "disabled";} ?>>
  </div>
  <div class="form-group">
    <label>Memo</label>
    <input name="memo" type="text" class="form-control" placeholder="Please input memo here" value="">
  </div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" checked> Enable?
    </label>
  </div>
  <button type="submit" class="btn btn-success">Save</button>
  <a class="btn btn-danger" href="<?php echo site_url('manage/node/index'); ?>">Cancel</a>
</form>
