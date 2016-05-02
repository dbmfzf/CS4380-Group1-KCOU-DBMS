<style>
.table td:nth-child(10){width:15%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>Name</th>
            <th>Created date</th>
            <th>Songs</th>
            <th>Action</th>
          </tr>
        </thead>
   <tbody>
	<?php 
	foreach($data as $row){
		printf('<tr>
					<td>%s</td>
					<td>%s</td>
					<td>
						<div class="btn-group  btn-group-xs">
						  <a class="btn btn-warning btn-xs" href="%s">View all</a>
						</div>
					</td>
					<td>
						<div class="btn-group  btn-group-xs">
						  <a class="btn btn-warning btn-xs" href="%s">Edit</a>
						  <a class="btn btn-danger" href="%s">Delete</a>
						</div>
					</td>
				</tr>',$row->name,$row->created_date,site_url("playlist/playlist/see_all_songs/".$row->pid),site_url("playlist/playlist/edit/".$row->pid),site_url("playlist/playlist/delete/".$row->pid));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("playlist/playlist/add").'">Add new playlist</a>'; ?>
<?php echo $this->pagination->create_links(); ?>