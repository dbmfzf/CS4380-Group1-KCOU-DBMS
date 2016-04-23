


        
<script type="text/javascript" src="<?php echo base_url();?>ueditor.config.js"></script>  
<script type="text/javascript" src="<?php echo base_url();?>ueditor.all.min.js"></script>

<script type="text/javascript">UE.getEditor('myEditor');</script>
 <style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>News Content</h1>
<form action="" method="post"> 


    <table class="table table-bordered table-hover definewidth m10">

        <tr>
        	<td>
        	<script type="text/plain" id="myEditor" name="content" >
    		</script>
    		</td>
        </tr>
    </table>
    <button type="submit" class="btn btn-success">Submit</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/news/index'); ?>">Cancel</a> 
</form>