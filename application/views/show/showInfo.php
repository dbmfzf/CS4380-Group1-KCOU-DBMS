<style>
.table td:nth-child(7){width:30%}
.hbox .flex1{width:20%;}
.hbox .flex2{width:10%;}
</style>
<script>
	$(document).ready(function() {
		var rolename = "<?php echo $role_data['rolename'];?>";
		if(rolename != "Manager" || rolename!= "News dept leader"){
			$("#searching").hide();
		}
	})
</script>
<div id = "searching">
<form method = "post">
    <div class="hbox">
	<div class="form-group">
	  <label>Search by show ID or show title</label>
	  <input type="text" name ="shows" class="form-control" placeholder="Enter ID/title here">
	   <!--<input type="text" name ="news" class="form-control" placeholder="Enter ID/title here"> -->
	</div>
	<div class="form-group">
	    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Search</button>
	</div>
  </div>
</form>
<form method = "post">
     <div class="form-group">
	  <label >Advanced search</label>
	  <p>
        	<input value="'Sports'" name="type[]" type="checkbox"> Sports
        	<input value="'Academic'" name="type[]" type = "checkbox"> Academic
        	<input value="'Social'" name="type[]" type="checkbox" > Social
        	<input value="'International'" name="type[]" type="checkbox" > International
        	<input value="'Others'" name= "type[]" type ="checkbox"> Others
         </p>
	<div class="hbox">
		<div class = "flex1"><b>Showing date</b></div>
		<div class = "flex2">from</div>
		<div class = "flex1"><input type = "date" name = "submit_start" class="form-control" ></div>
		<div class = "flex2">to</div>
		<div class = "flex1"><input type = "date" name = "submit_end" class="form-control" ></div>
	</div>
		<p><b>Order by: </b>
			<input value="nid" name="order[]" type="checkbox" > Shows ID
			<input value="title" name="order[]" type="checkbox" > Shows title
	        	<input value="author" name= "order[]" type ="checkbox"> Actor name
	        	<input value="submit_time" name="order[]" type="checkbox"> start time
	        	<input value="last_modified_time" name="order[]" type = "checkbox"> end time
	       
	    </p>
	</div>
	<div class="form-group">
	    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Search</button>
    </div>
</form>
</div>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>Shows ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Description</th>
            <th>Actor</th>
            <th>Start time</th>
            <th>End time</th>
            <th>Action</th>
          </tr>
        </thead>
   <tbody>
	<?php 
	foreach($shows_data as $mb){
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
		</tr>',$mb->show_id,$mb->title,$mb->category,site_url("info/news/edit_content/".$mb->show_id),$mb->actor,$mb->start_time,$mb->end_time,site_url("info/news/edit/".$mb->show_id),site_url("info/news/delete/".$mb->show_id));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("info/news/add").'">Add news</a>'; ?>
<?php echo '<a class="btn btn-primary pull-right" href="'.site_url("info/news/analysis").'">See rankings!</a>'; ?>
