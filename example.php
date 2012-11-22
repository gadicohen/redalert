<html>

<head>
	<title>Tzeva-Adom Live Example</title>
	<script type="text/javascript" src="jslider/js/jquery-1.7.1.js"></script>
	<script type="text/javascript" src="Alerts.js"></script>
	<script type="text/javascript" src="Areas.js"></script>
	<style type="text/css">
		table { border-collapse:collapse; }
		table tr td, table tr th { border: 1px solid black; padding: 5px; }
		table tr th { text-align: left; }
	</style>
</head>

<body>
	<h1>Tzeva-Adom Live Feed Example</h1>

	<p>Create a new alert at <a href="test.php">test.php</a> and it will show up here:</p>

	<table>
		<tr>
			<th>Source</th>
			<th>Time</th>
			<th>Area</th>
			<th>Location</th>
		</tr>
	</table>
	
	<script type="text/javascript">
		function add_alert_to_table(alert) {
			var area = areas.byId(alert.area_id);
			$('table').append("<tr><td>"+alert.source+"</td><td>"
				+ new Date(alert.time*1000).toString()
				+ "</td><td>" + area.name + "</td><td>"+ area.getLat() + ","
				+ area.getLong() + "</td></tr>");
		}

		// Initiate an Alerts object to begin polling
		var alerts = new Alerts();

		// Log any new data received to the console
		alerts.callback(function(data) { console.log(data); } );

		// Example processing (I'll add something like this to the API soon)
		alerts.callback(function(data) {
			for (var i=0; i < data.areas.length; i++)
				areas.add(data.areas[i]); 
			for (var i=0; i < data.alerts.length; i++) {
				add_alert_to_table(data.alerts[i]);
			}
		});

		// Now that we've set up our callbacks, start polling
		alerts.poll();
	</script>
</body>
</html>

