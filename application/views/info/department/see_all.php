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
	foreach($data as $mb){
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
				</tr>',$mb->dname,$mb->rname,$mb->uid,$mb->uname,$mb->gender,$mb->email,$mb->phone,$mb->birth,($mb->status==1?"Enable":"Disable"),site_url("info/department/user_edit/".$mb->uid),site_url("info/department/user_delete/".$mb->uid));
	}
	?>
  </tbody>
</table>
<hr/>

