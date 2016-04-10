<style>
.tableleft{font-weight:bold;}
</style>
<h2>Profile</h2>
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "10%" class="tableleft">User ID</td>
            <td><p><?php echo rbac_conf(array('INFO','uid'));?></p></td>
        </tr>     
        <tr>
            <td class="tableleft">Full name</td>
            <td><p><?php echo $data['fullname'];?></p></td>
        </tr>
        <tr>
            <td class="tableleft">Gender</td>
            <td><p><?php echo $data['gender'];?></p></td>
        </tr>
        <tr>
            <td class="tableleft">Email</td>
            <td><p><?php echo $data['email'];?></p></td>
        </tr>
        <tr>
            <td class="tableleft">Phone</td>
            <td><p><?php echo $data['phone'];?></p></td>
        </tr>
        <tr>
            <td class="tableleft">Birthday</td>
            <td><p><?php echo $data['birth'];?></p></td>
        </tr>
        <tr>
            <td class="tableleft">Role</td>
            <td><p><?php echo $data['role'];?></p></td>
        </tr>
         <tr>
            <td class="tableleft">Department</td>
            <td><p><?php echo $data['dept'];?></p></td>
        </tr>
         <tr>
            <td class="tableleft">Last login time</td>
            <td><p><?php echo $data['last_login_time'];?></p></td>
        </tr>
        <tr>
            <td class="tableleft">Last login ip</td>
            <td><p><?php echo $data['last_login_ip'];?></p></td>
        </tr>
    </table>
<hr/>
<a class="btn btn-warning pull-right" href="<?php echo '.site_url("info/profile/reset").';?>">Reset password</a>
&nbsp;&nbsp;&nbsp;
<a class="btn btn-success pull-right" href="<?php echo '.site_url("info/profile/edit").';?>">Edit profile</a>
&nbsp;&nbsp;&nbsp;
