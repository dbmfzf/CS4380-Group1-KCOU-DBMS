<style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
.textarea{ width:500px; height:250px}
</style>
<h1>Add new playlist</h1>
<form action="" method="post"> 
    <table class="table table-bordered table-hover definewidth m10">
      <tr>
            <td class="tableleft">Name</td>
            <td><input type="text" name="name"</td>
      </tr>
     <tr>
            <td class="tableleft">Memo</td>
            <td><textarea class= "textarea" name="memo" > </textarea></td>
      </tr> 
    </table>
    <button type="submit" class="btn btn-success">Save</button> 
     <a class="btn btn-danger" href="<?php echo site_url('playlist/playlist/index'); ?>">Cancel</a> 
</form>
