<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
.textare{ width:500px; height:250px}
</style>
<h1>Edit Department</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">Department</td>
            <td><input type="text" name="dname" value="<?php echo $data['dname'];?>"></td>
        </tr>
        <tr>
            <td class="tableleft">Description</td>
            <td><textarea name="description" > <?php echo $data['description'];?></textarea></td>
            
        </tr>
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/department/index'); ?>">Cancel</a> 
</form>





