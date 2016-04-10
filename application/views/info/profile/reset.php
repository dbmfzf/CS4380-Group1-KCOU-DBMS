<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h2>Reset password</h2>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "20%" class="tableleft">User ID</td>
            <td><p><?php echo rbac_conf(array('INFO','uid'));?></p></td>
        </tr>     
        <tr>
            <td class="tableleft">Old password</td>
            <td><input name="password" type="password"  class="form-control" ></td>
        </tr>
        <tr>
            <td class="tableleft">New password</td>
            <td><input name="password1" type="password" class="form-control" ></td>
        </tr>
        <tr>
            <td class="tableleft">Repeat new password</td>
            <td><input name="password2" type="password" class="form-control" ></td>
        </tr>
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/profile/index'); ?>">Cancel</a> 
</form>
