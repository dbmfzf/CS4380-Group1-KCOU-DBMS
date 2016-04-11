<h1>新增节点</h1>
<form role="form" action="" method="post">
  <div class="form-group">
    <label>目录</label>
    <input name="directory" type="text" class="form-control" placeholder="在此输入目录" value="<?php if(isset($directory)){echo $directory;} ?>" <?php if(isset($directory)){echo "disabled";} ?>>
  </div>
  <div class="form-group">
    <label>控制器</label>
    <input name="controller" type="text" class="form-control" placeholder="在此输入控制器" value="<?php if(isset($controller)){echo $controller;} ?>" <?php if(isset($controller)){echo "disabled";} ?>>
  </div>
  <div class="form-group">
    <label>方法</label>
    <input name="func" type="text" class="form-control" placeholder="在此输入方法" value="<?php if(isset($func)){echo $func;} ?>" <?php if(isset($func)){echo "disabled";} ?>>
  </div>
  <div class="form-group">
    <label>备注</label>
    <input name="memo" type="text" class="form-control" placeholder="在此输入备注" value="">
  </div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" checked> 是否启用
    </label>
  </div>
  <button type="submit" class="btn btn-success">确认新增</button>
  <a class="btn btn-danger" href="<?php echo site_url('manage/node/index'); ?>">取消操作</a>
</form>