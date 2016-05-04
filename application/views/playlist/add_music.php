 <style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>Add <i><?php echo $song_data['title'];?></i> to a playlist</h1>
<form action="" method="post"> 
<table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="20%" class="tableleft">Choose a playlist</td>
            <td>
              <select name="pid">
              <?php
    		      foreach($playlist_data as $key){
		  	     printf('<option value = "%s"> %s </option>',$key->pid,$key->name);
		  	     
    		      }
		?>
	       </select>
	</td>
        </tr>

    </table>
    <button type="submit" class="btn btn-success">Submit</button> 
     <a class="btn btn-danger" href="<?php echo site_url('playlist/playlist/index'); ?>">Cancel</a> 
</form>
