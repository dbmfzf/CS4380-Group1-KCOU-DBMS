<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>Edit user</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">User ID</td>
            <td><input type="text" name="uid" disabled value="<?php echo $data['uid'];?>"></td>
        </tr>
        <tr>
            <td class="tableleft">Full name</td>
            <td><input name="fullname" type="text" class="form-control" value="<?php echo $data['fullname']; ?>" placeholder="Please input full name here"></td>
        </tr> 
        <tr>
            <td class="tableleft">Gender</td>
            <td>
                <p><input name="gender" type="radio" value="Male" checked = <?php echo $data['gender']=="Male"?"":"checked" ?>>Male
                <input name="gender" type="radio" value="Female" checked = <?php echo $data['gender']=="Female"?"":"checked" ?>>Female</p>
            </td>
        </tr>
        <tr>
            <td class="tableleft">Email</td>
            <td><input name="email" type="email" class="form-control" value="<?php echo $data['email']; ?>" placeholder="Please input email here"></td>
        </tr>
        <tr>
            <td class="tableleft">Phone</td>
            <td><input name="phone" type="number" class="form-control" value="<?php echo $data['phone']; ?>" placeholder="Please input phone number here"></td>
        </tr>
        <tr>
            <td class="tableleft">Birthday</td>
            <td><input name="birth" type="date" class="form-control" value="<?php echo $data['birth']; ?>" placeholder="Please input or select birthday here"></td>
        </tr>
        <tr>
            <td class="tableleft">Role</td>
            <td>
                <select name="role" id="role" onChange="check()"  class="form-control" >
		    	<?php
		    		$rid = $data['rid'];
		    		$rolename = $data['role'];
		    		if($data['login_rolename']!= "Manager")
		    		{
		    			echo "<option value='{$rid}' selected >{$rolename}</option>";
		    		}
		    		else{
			    		foreach($role_dept_data as $key){
						$select = $rid==$key->rid?"selected":"";
						printf('<option value = "%s" %s> %s(%s) </option>',$key->rid,$select,$key->rolename,$key->deptname);
			    		
			    		}
		    		}
		    	?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tableleft">New password</td>
            <td><input name="password" type="password" class="form-control" placeholder="Please input new password here"></td>
        </tr>
        <tr>
            <td class="tableleft">Repeat password</td>
            <td><input name="password2" type="password" class="form-control" placeholder="Please repeat password here"></td>
        </tr>
        <tr>
            <td class="tableleft">Enable</td>
            <td><input value="1" name="status" type="checkbox" <?php if($data['status']){echo "checked";}?>> Enable? </td>
        </tr> 
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/user/index'); ?>">Cancel</a> 
</form>




