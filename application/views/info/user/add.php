<h1>Add new user</h1>
<form role="form" action="" method="post">
  <div class="form-group">
    <label>User serID</label>
    <input name="uid" type="text" class="form-control"  placeholder="Please input user ID here" value="">
  </div>
  <div class="form-group">
    <label>Full name</label>
    <input name="fullname" type="text" class="form-control" placeholder="Please input the full name here" value="">
  </div>
  <div class="form-group">
    <label>Gender</label>
    <label><input name="gender" type="radio" class="form-control" value="Male">Male</label>
    <label><input name="gender" type="radio" class="form-control" value="Female">Female</label>
  </div>
  <div class="form-group">
    <label>Email</label>
    <input name="email" type="email" class="form-control" placeholder="Please input the email here" value="">
  </div>
  <div class="forn-group">
    <label>Phone</label>
    <input name="phone" type="number" class="form-control" placeholder="Please input the phone number here" value="">
  </div>
  <div class="form-group">
    <label>Birthday</label>
    <input name="birth" type="date" class="form-control" placeholder="Please input or select the birthday here" value="">
  </div>
  <div class="form-group">
    <label>Role</label>
    <select name="role"  class="form-control" >
    	<?php 
    		foreach($role_data as $vo){
    			echo "<option value='{$vo->rid}'>{$vo->name}</option>";
    		}
    	?>
    </select>
  </div>
  <div class="form-group">
    <label>Department</label>
    <select name="role"  class="form-control" >
    	<?php 
    		foreach($dept_data as $vo){
    			echo "<option value='{$vo->did}'>{$vo->name}</option>";
    		}
    	?>
    </select>
  </div>
  <div class="form-group">
    <label>New password</label>
    <input name="password" type="password" class="form-control" placeholder="Please input the new password here" value="">
  </div>
  <div class="form-group">
    <label>Repeat the password</label>
    <input name="password2" type="password" class="form-control" placeholder="Please repeat the new password here" value="">
  </div>
  <div class="checkbox">
    <label>
      <input value="1" name="status" type="checkbox" checked > Enable?
    </label>
  </div>
  <button type="submit" class="btn btn-success">Save</button>
  <a class="btn btn-danger" href="<?php echo site_url('info/user/index'); ?>">Cancel</a>
</form>
