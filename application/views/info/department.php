<style>
.table td:nth-child(2){width:30%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>Department</th>
            <th>Description</th>
            <th></th>
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
			  <a class="btn btn-warning btn-xs" href="%s">Edit</a>
			  <a class="btn btn-danger" href="%s">Delete</a>
			  <a class="btn btn-info btn-xs" href="%s">See All Volunteers</a>
			</div>
		</td>
		</tr>',$row->dname,$row->description,site_url("info/department/edit/".$row->did),site_url("info/department/delete/".$row->did),site_url("info/department/see_all/".$row->did));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("info/department/add").'">Add new department</a>'; ?>
<?php echo $this->pagination->create_links(); ?>
