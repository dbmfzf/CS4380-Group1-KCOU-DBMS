<style>
.table td:nth-child(10){width:15%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>News ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Content</th>
            <th></th>
          </tr>
        </thead>
   <tbody>
	<?php 
	foreach($data as $mb){
		printf('<tr>
					<td>%s</td>
					<td>%s</td>
					<td>
						<div class="btn-group  btn-group-xs">
						  <a class="btn btn-warning btn-xs" href="%s">Edit</a>
						  <a class="btn btn-danger" href="%s">Delete</a>
						</div>
					</td>
				</tr>',$mb->dname,$mb->rname,site_url("info/department/edit/".$mb->did),site_url("info/department/delete/".$mb->did));
	}
	?>
  </tbody>
</table>
<hr/>
<?php echo '<a class="btn btn-success pull-right" href="'.site_url("info/news/add").'">Add new news</a>'; ?>
<?php echo $this->pagination->create_links(); ?>
</body>
</html>