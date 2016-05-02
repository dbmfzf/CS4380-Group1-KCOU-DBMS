<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
.textarea{ width:500px; height:250px}
</style>
<h1>Edit Playlist</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">Department</td>
            <td><input type="text" name="name" value="<?php echo $name_data['name'];?>"></td>
        </tr>
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('playlist/playlist/index'); ?>">Cancel</a> 
</form>
