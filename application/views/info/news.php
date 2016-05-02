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
	  <label>Search by news ID or news title</label>
	   <input type="text" name ="news" class="form-control" placeholder="Enter ID/title here"> 
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
        	<input value="Sports" name="type[]" type="checkbox"> Sports
        	<input value="Academic" name="type[]" type = "checkbox"> Academic
        	<input value="Social" name="type[]" type="checkbox" > Social
        	<input value="International" name="type[]" type="checkbox" > International
        	<input value="Others" name= "type[]" type ="checkbox"> Others
         </p>
	<div class="hbox">
		<div class = "flex1"><b>Submitted date</b></div>
		<div class = "flex2">from</div>
		<div class = "flex1"><input type = "date" name = "submit_start" class="form-control" ></div>
		<div class = "flex2">to</div>
		<div class = "flex1"><input type = "date" name = "submit_end" class="form-control" ></div>
	</div>
	</div>
	<div class="form-group">
	    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Search</button>
    </div>
</form>
</div>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>News ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Content</th>
            <th>Last modified time</th>
            <th>Submit time</th>
            <th>Action</th>
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
<?php echo '<a class="btn btn-primary pull-right" href="'.site_url("info/news/analysis").'">See rankings!</a>'; ?>
