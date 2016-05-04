 <style>
.tableleft{font-weight:bold;background-color:#F5F5F5;}
</style>
<h1>News Info Edit</h1>
<form action="" method="post"> 


    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width = "15%" class="tableleft">Show ID</td>
            <td><input type="text" name="nid" disabled  value="<?php echo $data['show_id'];?>" ></td>
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
		<tr>
			<td width = "15%" class="tableleft">Actor ID</td>
			<td>
			<input type="text" name="actor" value="<?php echo $data['uid'];?>">
			</td>
		</tr>
			<tr>
				<td width = "15%" class="tableleft">Weekday</td>
				<td>
				<select name="weekday" id = "weekday">
					<option value="Monday">Monday</option>
					<option value="Tuesday">Tuesday</option>
					<option value="Wednesday">Wednesday</option>
					<option value="Thursday">Thursday</option>
					<option value="Friday">Friday</option>
					<option value="Saturday">Saturday</option>
					<option value="Sunday">Sunday</option>
				</select></br></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Start Time</td>
				<td><input type = "time" name = "start_time" value="<?php echo $data['start_time'];?>"/></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">End Time</td>
				<td><input type = "time" name = "end_time" value="<?php echo $data['end_time'];?>"></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Attention: Show type</td>
				<td><input type = "text" name = "showType" readonly="readonly" value = "<?php $every = "Every Week"; $date = (($data['date']) == "0000-00-00")?($every):($data['date']); echo $date;?>"></td>
			</tr>
    </table>
    <button type="submit" class="btn btn-success">Submit</button> 
     <a class="btn btn-danger" href="<?php echo site_url('show/showController/index'); ?>">Cancel</a> 
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
	
	 var weekday = "<?php echo $data['weekday'];?>";
	 var opt = document.getElementById('weekday');
	 var tempValue = opt.options[i].value; 
	 for(var i=0;i<leng; i++){  
	        if(tempValue == type)  
	        {  
	            opt.options[i].selected = true;  
	        }
	 }  
 })
</script>
