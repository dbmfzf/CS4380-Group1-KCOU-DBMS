<style>
.table td:first-child{width:10%}
.table td:nth-child(2){width:20%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>User ID</th>
            <th>Full name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Birthday</th>
            <th>Role</th>
            <th>Department</th>
            <th>Status</th>
            <th>Operation</th>
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
					<td>
						<div class="btn-group  btn-group-xs">
						  <a class="btn btn-default btn-xs" href="%s">Edit</a>
						  <a class="btn btn-danger" href="%s">Delete</a>
						</div>
					</td>
				</tr>',$mb->uid,$mb->fullname,$mb->gender,$mb->email,$mb->phone,$mb->birth,$mb->rolename,$mb->deptnnameame,($mb->status==1?"Enable":"Disable"),site_url("info/user/edit/".$mb->uid),site_url("info/user/delete/".$mb->uid));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("info/user/add").'">Add new user</a>'; ?>
<?php echo $this->pagination->create_links(); ?>
