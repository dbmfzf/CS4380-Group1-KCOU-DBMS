<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
.textarea{ width:500px; height:250px}
</style>
<h1>Add new user</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">

        <tr>
            <td width = "15%" class="tableleft">Department</td>
            <td><input type="text" name="deptname" disabled value="<?php echo $current_role_dept_data['deptname'];?>"></td>
        </tr>
             <tr>
            <td width = "15%" class="tableleft">User ID</td>
            <td><input type="text" name="uid" ></td>
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
            <td><input name="email" type="email" class="form-control"  placeholder="Please input email here"></td>
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
            <td class="tableleft">Rolename</td>
            <td>
                <select name="role" id="role"  class="form-control" >
		    	<?php
			    		foreach($role_dept_data as $key){
						$select = $rid==$key->rid?"selected":"";
						printf('<option value = "%s" %s> %s </option>',$key->rid,$select,$key->rolename);
			    		
			    		}
		    	?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tableleft">Enable</td>
            <td><input value="1" name="status" type="checkbox" > Enable? </td>
        </tr> 
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/department/see_all/'.$current_role_dept_data['did']); ?>">Cancel</a> 
</form>

