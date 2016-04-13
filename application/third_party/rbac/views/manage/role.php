<style>
.table td:first-child{width:10%}
.table td:nth-child(2){width:40%}
</style>
<table class="table table-bordered well">
	<thead>
          <tr>
            <th>Role ID</th>
            <th>Role name</th>
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
					<td>
						<div class="btn-group  btn-group-xs  pull-right">
						  <a class="btn btn-info btn-xs" href="%s">Authorize</a>
						  <a class="btn btn-warning btn-xs" href="%s">Edit</a>
						  <a class="btn btn-danger" href="%s">Delete</a>
						</div>
					</td>
				</tr>',$mb->rid,$mb->name,($mb->status==1?"Enable":"Disable"),site_url("manage/role/edit/".$mb->rid),site_url("manage/role/action/".$mb->rid),site_url("manage/role/delete/".$mb->rid));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("manage/role/add").'">Add new role</a>'; ?>
<?php echo $this->pagination->create_links(); ?>
