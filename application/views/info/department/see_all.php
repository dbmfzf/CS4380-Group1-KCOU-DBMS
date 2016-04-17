<style>
.table td:nth-child(10){width:15%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>Department</th>
            <th>Volunteers' ID</th>
            <th>Volunteers' name</th>
            <th>Volunteers' role</th>
            <th>Gender</th>
            <th>Birth</th>
            <th>Email</th>
            <th>Phone</th>
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
						  <a class="btn btn-warning btn-xs" href="%s">Edit</a>
						  <a class="btn btn-danger" href="%s">Delete</a>
						</div>
					</td>
				</tr>',$mb->dname,$mb->uid,$mb->uname,$mb->rname,$mb->gender,$mb->birth,$mb->email,$mb->phone,site_url("info/department/user_edit/".$mb->did),site_url("info/department/user_delete/".$mb->did));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo $this->pagination->create_links(); ?>
