<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>Edit Department</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">Department</td>
            <td><input type="text" name="dname" disabled value="<?php echo $data['dname'];?>"></td>
        </tr>
        <tr>
            <td class="tableleft">Role</td>
            <td>
                <select name="rolename" id="rolename" onChange="check()"  class="form-control" >
		    	<?php 
		    		foreach($data as $vo){
						$select = $data["rid"]==$vo->rid?"selected":"";
		    			echo "<option value='{$vo->rid}' {$select} >{$vo->name}</option>";
		    		}
		    	?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tableleft">Enable</td>
            <td><input value="1" name="status" type="checkbox" <?php if($data['status']){echo "checked";}?>> Enable? </td>
        </tr> 
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/department/index'); ?>">Cancel</a> 
</form>





