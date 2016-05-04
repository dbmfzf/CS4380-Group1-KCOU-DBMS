<script>
function show(div1,div2,box){
	var vis1 = (box.checked) ? "block" : "none";
	var vis2 = (box.checked) ? "none" : "block";
  	document.getElementById(div1).style.display = vis1;
  	document.getElementById(div2).style.display = vis2;
}

function getWeekDay(){
	var s = document.getElementById("date").value;   
	var d = new Date(Date.parse(s.replace(/-/g,   "/"))); 
	var weekday = new Array(7);
		weekday[0]=  "Sunday";
		weekday[1] = "Monday";
		weekday[2] = "Tuesday";
		weekday[3] = "Wednesday";
		weekday[4] = "Thursday";
		weekday[5] = "Friday";
		weekday[6] = "Saturday";
	document.getElementById("weekday").value = weekday[d.getDay()];
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
				<td width = "15%" class="tableleft">Special Show ID</td>
				<td>
				<input type="text" name="sid" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Special Show Title</td>
				<td>
				<input type="text" name="title" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Category</td>
				<td>
				<select name="type">
					<option value="Sports">Sports</option>
					<option value="Academic">Academic</option>
					<option value="Social">Social</option>
					<option value="International">International</option>
				</select></br></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Actor ID</td>
				<td>
				<input type="text" name="actor" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Date</td>
				<td>
					<input type="text" name="date" id = "date">
				</td>
				</td>
				<td>
					<input type="text" name="weekday" id = "weekday" readonly="readonly" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft"">Start Time</td>
				<td><input type = "time" name = "start_time"  onclick="getWeekDay()" /></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">End Time</td>
				<td><input type = "time" name = "end_time" ></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Attention: Show type</td>
				<td><input type = "text" name = "showType" readonly="readonly" value = "Special show"></td>
			</tr>

		</table>
		<button type="submit" class="btn btn-success">
			Submit
		</button>
	</form>
</div>

<div id="normalShow" style="display: none">
	<form action="" method="post">

		<table class="table table-bordered table-hover definewidth m10">
			<tr>
				<td width = "15%" class="tableleft">Normal Show ID</td>
				<td>
				<input type="text" name="sid" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Normal Show Title</td>
				<td>
				<input type="text" name="title" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Category</td>
				<td>
				<select name="type">
					<option value="Sports">Sports</option>
					<option value="Academic">Academic</option>
					<option value="Social">Social</option>
					<option value="International">International</option>
				</select></br></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Actor ID</td>
				<td>
				<input type="text" name="actor" >
				</td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Weekday</td>
				<td>
				<select name="weekday">
					<option value="Monday">Monday</option>
					<option value="Tuesday">Tuesday</option>
					<option value="Wednesday">Wednesday</option>
					<option value="Thursday">Thursday</option>
					<option value="Friday">Friday</option>
					<option value="Saturday">Saturday</option>
					<option value="Sunday">Sunday</option>
				</select></br></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft"">Start Time</td>
				<td><input type = "time" name = "start_time"/></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">End Time</td>
				<td><input type = "time" name = "end_time" ></td>
			</tr>
			<tr>
				<td width = "15%" class="tableleft">Attention: Show type</td>
				<td><input type = "text" name = "showType" readonly="readonly" value = "Normal show"></td>
			</tr>

		</table>
		<button type="submit" class="btn btn-success">
			Submit
		</button>
	</form>
</div>

<a class="btn btn-danger" href="<?php echo site_url('show/showController/index'); ?>">Cancel</a>