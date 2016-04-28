<style>
.table td:nth-child(7){width:30%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>News ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Content</th>
            <th>Last modified time</th>
            <th>Submit time</th>
            <th></th>
          </tr>
        </thead>
   <tbody>
	<?php 
	foreach($news_data as $mb){
		printf('<tr>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>
						<div class="btn-group  btn-group-xs">
						  <a class="btn btn-info btn-xs" href="%s">Edit Content</a>
						</div>
					</td>
					<td>%s</td>
					<td>%s</td>
					<td>
						<div class="btn-group  btn-group-xs">
						  <a class="btn btn-warning btn-xs" href="%s">Edit</a>
						  <a class="btn btn-danger" href="%s">Delete</a> 
						</div>
					</td>
				</tr>',$mb->nid,$mb->title,$mb->type,site_url("info/news/edit_content/".$mb->nid),$mb->last_modified_time,$mb->submit_time,site_url("info/news/edit/".$mb->nid),site_url("info/news/delete/".$mb->nid));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("info/news/add").'">Add news</a>'; ?>
<?php echo '<a class="btn btn-primary pull-left" href="'.site_url("info/news/analysis").'">Top 3 contributors</a>'; ?>
