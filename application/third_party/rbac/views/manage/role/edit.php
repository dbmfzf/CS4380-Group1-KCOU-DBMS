<h1>角色编辑</h1>
<form role="form" action="" method="post">
  <div class="form-group">
    <label>角色名</label>
    <input name="rolename" type="text" class="form-control" value="<?php echo $data['name']; ?>">
  </div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" <?php if($data["status"]){echo "checked";}?>> 是否启用
    </label>
  </div>
  <input type="hidden" name="rid" value="<?php echo $data['rid'];?>">
  <button type="submit" class="btn btn-success">确认修改</button>
  <a class="btn btn-danger" href="<?php echo site_url('manage/role/index'); ?>">取消修改</a>
</form>