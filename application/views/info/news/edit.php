 <style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>News Info Edit</h1>
<form action="" method="post"> 


    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">News ID</td>
            <td><input type="text" name="nid" disabled  value="<?php echo $data['nid'];?>" ></td>
        </tr>
        <tr>
            <td width = "15%" class="tableleft">Title</td>
            <td><input type="text" name="title" value="<?php echo $data['title'];?>"></td>
        </tr>
        <tr>
            <td width = "15%" class="tableleft">Type</td>
            <td>
            <select name="type" id = "type">
  			<option value="Sports">Sports</option>
  			<option value="Academic">Academic</option>
	  		<option value="Social">Social</option>
	  		<option value="International">International</option>
	  		<option value="Others">Others</option>
		</select></br></td>
        </tr>

    </table>
    <button type="submit" class="btn btn-success">Submit</button> 
     <a class="btn btn-danger" href="<?php echo site_url('info/news/index'); ?>">Cancel</a> 
</form>
<script>
 $(document).ready(function() {
	 var type = "<?php echo $data['type'];?>";
	 var opt = document.getElementById('type');
	 var leng= opt.options.length;
	 for(var i=0;i<leng; i++){  
        	var tempValue = opt.options[i].value;  
	        if(tempValue == type)  
	        {  
	            opt.options[i].selected = true;  
	        }  
    }  
	
 })
</script>
