<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h2>Edit profile</h2>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "20%" class="tableleft">User ID</td>
            <td><p><?php echo rbac_conf(array('INFO','uid'));?></p></td>
        </tr>     
        <tr>
            <td class="tableleft">Gender</td>
            <td>
                <label><input name="gender" type="radio" value="Male" checked = <?php echo $data['gender']=="Male"?"":"checked" ?>/>Male</label>
                <label><input name="gender" type="radio" value="Female" checked = <?php echo $data['gender']=="Male"?"":"checked" ?>/>Female</label>
            </td>
        </tr>
        <tr>
            <td class="tableleft">Email</td>
            <td><input name="email" type="text" class="form-control" value="<?php echo $data['email']; ?>"></td>
        </tr>
        <tr>
            <td class="tableleft">Phone</td>
            <td><input name="phone" type="text" class="form-control" value="<?php echo $data['phone']; ?>"></td>
        </tr>
        <tr>
            <td class="tableleft">Birthday</td>
            <td><input name="birth" type="text" class="form-control" value="<?php echo $data['birth']; ?>"></td>
        </tr>
    </table>
    <button type="submit" class="btn btn-success">确认修改</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/profile/index'); ?>">取消修改</a> 
</form>

