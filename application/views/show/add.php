<script>
function show(div1,div2,box){
	var vis1 = (box.checked) ? "block" : "none";
	var vis2 = (box.checked) ? "none" : "block";
  	document.getElementById(div1).style.display = vis1;
  	document.getElementById(div2).style.display = vis2;
}

</script>

<style>
	.tableleft {
		font-weight: bold;
		background-color: #F5F5F5;
	}
</style>
<h1>Add a new show</h1>
<form>
	<input type="radio" name="showType" id="special" onclick="show('specialShow','normalShow',this)">
	Add a Special Show
	<br>
	<input type="radio" name="showType" id="normal" onclick="show('normalShow','specialShow',this)">
	Add a Normal Show
	<br>
</form>
<div id="specialShow" style="display: none">
	<form action="" method="post">

		<table class="table table-bordered table-hover definewidth m10">
			<tr>
				<td width = "15%" class="tableleft">Special News ID</td>
				<td>
				<input type="text" name="sid" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Special News Title</td>
				<td>
				<input type="text" name="title" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Type</td>
				<td>
				<select name="type">
					<option value="Sports">Sports</option>
					<option value="Academic">Academic</option>
					<option value="Social">Social</option>
					<option value="International">International</option>
				</select></br></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Date</td>
				<td><input type = "date" name = "date" ></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Start Time</td>
				<td><input type = "time" name = "start_time" ></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">End Time</td>
				<td><input type = "time" name = "end_time" ></td>
			</tr>

		</table>
		<button type="submit" class="btn btn-success">
			Submit
		</button>
	</form>
</div>

<div id="normalShow" style="display: none">
	<form action="" method="post" class = "specialShow" disabled="true">

		<table class="table table-bordered table-hover definewidth m10">
			<tr>
				<td width = "15%" class="tableleft">Shows ID</td>
				<td>
				<input type="text" name="nid" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Title</td>
				<td>
				<input type="text" name="title" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Type</td>
				<td>
				<select name="type">
					<option value="Sports">Sports</option>
					<option value="Academic">Academic</option>
					<option value="Social">Social</option>
					<option value="International">International</option>
				</select></br></td>
			</tr>

		</table>
		<button type="submit" class="btn btn-success">
			Submit
		</button>
	</form>
</div>

<a class="btn btn-danger" href="<?php echo site_url('show/showInfo'); ?>">Cancel</a>