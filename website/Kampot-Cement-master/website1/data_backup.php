<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>
<?php
if($_SESSION['rechten'] =='0') {
		$_SESSION['errorlog']="U heeft geen rechten om deze pagina te bekijken";
	header('location: index.php');
}?>

  <!DOCTYPE html>
	<html>
	<head>
		<script src="https://www.google.com/jsapi"></script>
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="jquery.csv.min.js"></script>

		<script> // wait till the DOM is loaded
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart);
		function drawChart() { // grab the CSV
			$.get("data/data.csv", function(csvString) {
				var arrayData = $.csv.toArrays(csvString, {onParseValue: $.csv.hooks.castToScalar});

            for (var i = 0; i < arrayData[0].length; i++) {
               // this adds the given option to both select elements
               $("select").append("<option value='" + i + "'>" + arrayData[0][i] + "</option");
            }
            // set the default selection
            $("#domain option[value='5']").attr("selected","selected");
            $("#range option[value='10']").attr("selected","selected");

            // this new DataTable object holds all the data
            var data = new google.visualization.arrayToDataTable(arrayData);

            // this view can select a subset of the data at a time
            var view = new google.visualization.DataView(data);
            view.setColumns([5,10]);

            var options = {
               title: "Weather Data",
               hAxis: {title: data.getColumnLabel(5), minValue: data.getColumnRange(5).min, maxValue: data.getColumnRange(5).max},
               vAxis: {title: data.getColumnLabel(10), minValue: data.getColumnRange(10).min, maxValue: data.getColumnRange(10).max},
               legend: 'none'
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart'));
            chart.draw(view, options);

            // set listener for the update button
            $("select").change(function(){
               // determine selected domain and range
               var domain = +$("#domain option:selected").val();
               var range = +$("#range option:selected").val();

               // update the view
               view.setColumns([domain,range]);

               // update the options
               options.hAxis.title = data.getColumnLabel(domain);
               options.hAxis.minValue = data.getColumnRange(domain).min;
               options.hAxis.maxValue = data.getColumnRange(domain).max;
               options.vAxis.title = data.getColumnLabel(range);
               options.vAxis.minValue = data.getColumnRange(range).min;
               options.vAxis.maxValue = data.getColumnRange(range).max;

               // update the chart
               chart.draw(view, options);
            });
         });
      }
   </script>
</head>
<body>
	<p> Vertical Axis</p>
	<select id="range">
	</select>
	<p> Horizontal Axis</p>
	<select id="domain">
	</select>
   <div id="chart" style="width: 90%; height: 90%;">
   </div>
