<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>Add new department</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">User ID</td>
            <td><input name="dname" type="text" class="form-control" placeholder="Please input department name here"></td>
        </tr>
        
        <tr>
            <td class="tableleft">Role</td>
            <td>
                <select name="rolename" id="role" class="form-control" onchange="check()" >
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
                <select name="dname" id="dept" class="form-control" >
                  	<?php 
                  		foreach($dept_data as $vo){
                  			echo "<option value='{$vo->did}'>{$vo->name}</option>";
                  		}
                  	?>
                </select>
            </td>
        </tr>
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/department/index'); ?>">Cancel</a> 
</form>

