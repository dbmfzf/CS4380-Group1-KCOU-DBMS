<style>
.table td:nth-child(10){width:15%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>Department</th>
            <th>Role</th>
            <th>User ID</th>
            <th>User name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Birthday</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
   <tbody>
	<?php 
	foreach($data as $row){
		if($row->rname =="Manager"){
			$disable = "disabled";
		}
		else{
			$disable = "";
			
		}
		printf('<tr>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>
				<div class="btn-group  btn-group-xs">
				  <a class="btn btn-warning btn-xs" href="%s">Edit</a>
				  <a class="btn btn-danger" href="%s">Delete</a>
				</div>
			</td>
		</tr>',$row->dname,$row->rname,$row->uid,$row->uname,$row->gender,$row->email,$row->phone,$row->birth,($row->status==1?"Enable":"Disable"),site_url("info/department/user_edit/".$row->uid),site_url("info/department/user_delete/".$row->uid));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url('info/department/user_add/'.$department_data['did']).'">Add new user for this department</a>'; ?>




