<style>
.table td:nth-child(9){width:15%}
</style>
<script>
	$(document).ready(function() {
		var rolename = "<?php echo $flag['rolename'];?>";
		if(rolename != "Manager"){
			$("#searching").hide();
		}
	})
</script>
<div id = "searching">
<form method = "post">
    <div class="hbox">
	<div class="form-group">
	  <label>Search by ID/email/phone#</label>
	   <input type="text" name = "user_info" class="form-control" placeholder="Enter ID/email/phone number here"> 
	</div>
	<div class="form-group">
	    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Search</button>
	</div>
  </div>
</form>
<form method = "post">
    <div class="hbox">
	<div class="form-group">
	  <p><b>Department:</b>
          	<?php 
			foreach($dept_data as $key){
				$did_string = $key["did"];
				$dname_string = $key["deptname"];
			    echo "<input value='$did_string' name='dept[]' type='checkbox'> $dname_string ";
			}
    	    
          	?>
         </select>
         </p>
         <p><b>Role: </b>
        	<input value="1" name="leader" type="checkbox"> Leader
        	<input value="1" name="volunteer" type = "checkbox"> Volunteer
        </p>
        <p><b>Gender: </b>
        	<input value="1" name="male" type="checkbox" > Male
        	<input value="1" name="female" type="checkbox" > Female
        </p>
        <p><b>Status: </b>
        	<input value="1" name= "enable" type ="checkbox"> Enable
        	<input value="1" name= "disable" type ="checkbox"> Disable
        </p>
        <p><b>Order by: </b>
        	<input value="uid" name="order[]" type="checkbox"> User ID
        	<input value="fullname" name="order[]" type = "checkbox"> Fullname
        	<input value="gender" name="order[]" type="checkbox" > Gender
        	<input value="birth" name="order[]" type="checkbox" > Birthday
        	<input value="name" name= "order[]" type ="checkbox"> Role name
        </p>
	</div>
	<div class="form-group">
	    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Filter</button>
	</div>
  </div>
</form>
</div>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>User ID</th>
            <th>Full name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Birthday</th>
            <th>Role(Department)</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
   <tbody>
	<?php 
	foreach($data as $row){
		if($row->rolename =="Manager"){ 			
			$disable = "disabled"; 		
			
		}else
		{ 
			$disable = ""; 
		}
		printf('<tr>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s(%s)</td>
			<td>%s</td>
			<td>
				<div class="btn-group  btn-group-xs">
				  <a class="btn btn-warning btn-xs" href="%s" %s>Edit</a>
				  <a class="btn btn-danger" href="%s" %s>Delete</a>
				</div>
			</td>
		</tr>',$row->uid,$row->fullname,$row->gender,$row->email,$row->phone,$row->birth,$row->rolename,$row->deptname,($row->status==1?"Enable":"Disable"),site_url("info/user/edit/".$row->uid),$disable,site_url("info/user/delete/".$row->uid),$disable);
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("info/user/add").'">Add new user</a>'; ?>
<?php if($flag['pagination']=="enable"){echo $this->pagination->create_links();} ?>
