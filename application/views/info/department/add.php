<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>Add new department</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
      <tr>
            <td class="tableleft">Department</td>
            <td><input type="text" name="dname"</td>
        </tr>
        <tr>
         <td class="tableleft">description</td>
            <td><textarea name="description" width = "300px" height = "200px"></textarea></td>
        </tr>
        
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/department/index'); ?>">Cancel</a> 
</form>

