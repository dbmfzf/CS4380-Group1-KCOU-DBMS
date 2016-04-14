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
                <select name="role" id="role" class="form-control" onchange="check()" >
                  	<?php 
    		    		if($data['login_rolename']!= "Manager")
    		    		{
    		    			echo "<option value='4' selected >Volunteer</option>";
    		    		}
    		    		else{
    			    		foreach($role_data as $vo){
    						$select = $data["rid"]==$vo->rid?"selected":"";
    			    			echo "<option value='{$vo->rid}' {$select} >{$vo->name}</option>";
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
            <td><input value="1" name="status" type="checkbox" checked > Enable?</td>
        </tr> 
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/user/index'); ?>">Cancel</a> 
</form>
<script >
    $(document).ready(function() {
    	var login_rolename = "<?php echo $data['login_rolename'] ?>";
        var dept = document.getElementById('dept');
        var role = document.getElementById('role');
        if(login_rolename == "Manager"){
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
        }
    })
    function check(){
        var login_rolename = "<?php echo $data['login_rolename'] ?>";
        var dept = document.getElementById('dept')
        var role = document.getElementById('role');
        if(login_rolename == "Manager"){
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
    }
</script>
