 <!DOCTYPE HTML>
<html>
<body>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript">
</script>

<h2>Select station number</h2>
<select id="stationsnummer" onchange="window.onload()">
	<option value="488260">488260</option>
	<option value="488600">488600</option>
	<option value="488060">488060</option>
</select>

<script>

window.onload = function() {

var e = document.getElementById("stationsnummer");
var value = e.options[e.selectedIndex].value;

var dataPoints = [];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: false,
	exportEnabled: false,
	title: {
		text: "Temperature in Cambodia"
	},
	axisY: {
		title: "Temperature in °C",
		includeZero: false
	},
	data: [{
		type: "line",
		toolTipContent: "{y} Temperature in °C",
		dataPoints: dataPoints
	}]
});

$.get("data2.csv", getDataPointsFromCSV);

//CSV Format
//time,temperature
//transfer the csv data to an array and push the data to a graph
function getDataPointsFromCSV(csv) {
	var points;
	var csvLines = csv.split(/[\r?\n|\r|\n]+/);
	for (var i = 1; i < csvLines.length; i++) {
		if (csvLines[i].length > 0) {
			points = csvLines[i].split(",");
			// filter all the stations
			if(points[0] == value){
				dataPoints.push({
					label: points[2],
					y: parseFloat(points[3])
					});
			}
		}
	}
	//draw the graph
	chart.render();
}

}
</script>
</head>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>
