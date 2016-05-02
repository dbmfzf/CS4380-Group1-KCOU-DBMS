<style>
.table td:nth-child(9){width:10%}
</style>
<div id = "Searching">
<form method = "post">
    <div class="hbox">
	<div class="form-group">
	  <label>Search by user ID</label>
	   <input type="text" name = "uid" class="form-control" placeholder="Enter ID here"> 
	</div>
	<div class="form-group">
	    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Search</button>
	</div>
  </div>
</form>
<form method = "post">
    <div class="hbox">
	<div class="form-group">
	  <label >Advanced search</label>
	  <p>
          <select name="dept" class="form-control" >
          	<option value = ""> Not selected </option>
          	<?php 
			foreach($dept_data as $key){
			    printf('<option value ="%s">%s</oprtion>',$key->did,$key->deptname);
			}
    	    
          	?>
         </select>
         </p>
         <p>
        	<input value="1" name="leader" type="checkbox"> Leader
        	<input value="1" name="volunteer" type = "checkbox"> Volunteer
        	<input value="1" name="male" type="checkbox" > Male
        	<input value="1" name="female" type="checkbox" > Female
        	<input value="1" name= "enable" type ="checkbox"> Enable
        	<input value="1" name= "disable" type ="checkbox"> Disable
        </p>
	</div>
	<div class="form-group">
	    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Search</button>
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
		if($key->name =="Manager"){ 			
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
<>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("info/user/add").'">Add new user</a>'; ?>
<?php if($flag['pagination']=="enable") echo $this->pagination->create_links(); ?>
