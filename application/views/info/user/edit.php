<h1>用户编辑</h1>
<form role="form" action="" method="post">
  <div class="form-group">
    <label>用户ID</label>
    <input name="uid" type="text" class="form-control" disabled value="<?php echo $data['uid']; ?>">
  </div>
  <div class="form-group">
    <label>名字</label>
    <input name="fullname" type="text" class="form-control" placeholder="在此输入名字" value="<?php echo $data['fullname']; ?>">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input name="email" type="email" class="form-control" placeholder="在此输入Email" value="<?php echo $data['email'];?>">
  </div>
  <div class="form-group">
    <label>角色</label>
    <select name="role"  class="form-control" >
    	<option value=''>暂无角色</option>
    	<?php 
    		foreach($role_data as $vo){
				$select = $data["rid"]==$vo->rid?"selected":"";
    			echo "<option value='{$vo->rid}' {$select} >{$vo->name}</option>";
    		}
    	?>
    </select>
  </div>
  <div class="form-group">
    <label>新密码</label>
    <input name="password" type="password" class="form-control" placeholder="在此输入密码(留空则不修改)" value="">
  </div>
  <div class="form-group">
    <label>确认密码</label>
    <input name="password2" type="password" class="form-control" placeholder="在此确认密码(留空则不修改)" value="">
  </div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" <?php if($data["status"]){echo "checked";}?>> 是否启用
    </label>
  </div>
  <input type="hidden" name="uid" value="<?php echo $data['uid'];?>">
  <button type="submit" class="btn btn-success">确认修改</button>
  <a class="btn btn-danger" href="<?php echo site_url('info/user/index'); ?>">取消修改</a>
</form>
