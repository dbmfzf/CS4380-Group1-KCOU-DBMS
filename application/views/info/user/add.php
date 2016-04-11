<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>Add new user</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">User ID</td>
            <td><input name="uid" type="text" class="form-control" placeholder="Please input user ID here"></td>
        </tr>
        <tr>
            <td class="tableleft">Full name</td>
            <td><input name="fullname" type="text" class="form-control" placeholder="Please input full name here"></td>
        </tr> 
        <tr>
            <td class="tableleft">Gender</td>
            <td>
                <p><input name="gender" type="radio" value="Male" >Male
                <input name="gender" type="radio" value="Female" >Female</p>
            </td>
        </tr>
        <tr>
            <td class="tableleft">Email</td>
            <td><input name="email" type="email" class="form-control" placeholder="Please input email here"></td>
        </tr>
        <tr>
            <td class="tableleft">Phone</td>
            <td><input name="phone" type="number" class="form-control" placeholder="Please input phone number here"></td>
        </tr>
        <tr>
            <td class="tableleft">Birthday</td>
            <td><input name="birth" type="date" class="form-control" placeholder="Please input or select birthday here"></td>
        </tr>
        <tr>
            <td class="tableleft">Role</td>
            <td>
                <select name="role" id="role" class="form-control" >
                  	<?php 
                  		foreach($role_data as $vo){
                  			echo "<option value='{$vo->rid}'>{$vo->name}</option>";
                  		}
                  	?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tableleft">Department</td>
            <td>
                <select name="dept" id="dept" disabled=true class="form-control" >
                  	<?php 
                  		foreach($dept_data as $vo){
                  			echo "<option value='{$vo->did}'>{$vo->name}</option>";
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
            <td><input value="1" name="status" type="checkbox" checked > Enable?</td>
        </tr> 
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/user/index'); ?>">Cancel</a> 
</form>
<script >
    $(document).ready(function() {
        var role = document.getElementByID("role").value;
        if(role!=31)
        document.getElementById("dept").disabled=true;
    })
</script>
