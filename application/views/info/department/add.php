<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>Add new department</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">User ID</td>
            <td><input name="uid" type="text" class="form-control" placeholder="Please input department name here"></td>
        </tr>
        
        <tr>
            <td class="tableleft">Role</td>
            <td>
                <select name="role" id="role" class="form-control" onchange="check()" >
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
                <select name="dept" id="dept" class="form-control" >
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
        var dept = document.getElementById('dept');
        var role = document.getElementById('role');
        var index = role.selectedIndex;
        var rolename = role.options[index].text;
        if(rolename!="Volunteer"){
            dept.style.display='none';
            dept.disabled = true;
        }
        else{
            dept.getElementById('dept').style.display='block';
            dept.disabled = false;
        }
    })
    function check(){
        var dept = document.getElementById('dept')
        var role = document.getElementById('role');
        var index = role.selectedIndex;
        var rolename = role.options[index].text;
        if(rolename!="Volunteer"){
            dept.style.display='none';
            dept.disabled = true;
        }
        else{
            dept.style.display='block';
            dept.disabled = false;
        }
    }
</script>
