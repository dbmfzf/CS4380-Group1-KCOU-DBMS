<?php 
foreach($final_data as $row){
    $normal_arr[] = array( 
      $row['day'],  intval($row['shows_num']) 
    ); 
}

$shows_data = json_encode($normal_arr);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='<?php echo base_url();?>static/full-calendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url();?>static/full-calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo base_url();?>static/full-calendar/lib/moment.min.js'></script>
<script src='<?php echo base_url();?>static/full-calendar/lib/jquery.min.js'></script>
<script src='<?php echo base_url();?>static/full-calendar/fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month'
			},
			defaultDate: '2016-05-01',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: {
				{
					title: 'All Day Event',
					start: '2016-01-01'
				},
				{
					title: 'Long Event',
					start: '2016-01-07',
					end: '2016-01-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-01-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-01-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2016-01-11',
					end: '2016-01-13'
				},
				{
					title: 'Meeting',
					start: '2016-01-12T10:30:00',
					end: '2016-01-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2016-01-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2016-01-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2016-01-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2016-01-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2016-01-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2016-01-28'
				}
			},
			loading: function(bool) {
				$('#loading').toggle(bool);
			}
		});
		
	});

</script>
<style>

	body {
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#script-warning {
		display: none;
		background: #eee;
		border-bottom: 1px solid #ddd;
		padding: 0 10px;
		line-height: 40px;
		text-align: center;
		font-weight: bold;
		font-size: 12px;
		color: red;
	}

	#loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}

	#calendar {
		max-width: 900px;
		margin: 40px auto;
		padding: 0 10px;
	}

</style>
</head>
<body>

	<div id='script-warning'>
		<code>php/get-events.php</code> must be running.
	</div>

	<div id='loading'>loading...</div>

	<div id='calendar'></div>

</body>
</html>
