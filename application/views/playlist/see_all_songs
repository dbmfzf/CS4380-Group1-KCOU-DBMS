<style>
.table td:nth-child(5){width:20%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
          	<th>Song</th>
          	<th>Artist</th>
            <th>Album</th>
            <th>Genre</th>
            <th>Location</th>
            <th>Action</th>
          </tr>
        </thead>
   <tbody>
	<?php 
	foreach($data as $row){
		printf('<tr>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>
						<div class="btn-group  btn-group-xs">
						  <a class="btn btn-danger" href="%s">Delete</a>
						</div>
					</td>
				</tr>',$row->Song_title,$row->Artist,$row->Album,$row->Genre,$row->Location,site_url("playlist/playlist/delete".$row->pid));
	}
	?>
  </tbody>
</table>
<hr/>
