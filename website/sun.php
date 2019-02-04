<!DOCTYPE HTML>
<?php include('inc/functions.php'); ?>
<html>
<body>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript">
</script>

<select id="stationsnummer" onchange="window.onload()">
 <option selected="selected">Choose One</option>
 <?php
   foreach ($stations as $key => $value) { ?>
     <option value="<?php echo $key; ?>"><?php echo $value; ?></options>
   <?php }
  ?>
</select>
<button id="downloadExcel">Download Chart Data as Excel</button>
<script>
window.onload = function() {

var e = document.getElementById("stationsnummer");
var value = e.options[e.selectedIndex].value;

var dataPoints = [];

var chart = new CanvasJS.Chart("chartContainer", {
 animationEnabled: false,
 exportEnabled: false,
 title: {
   text: "Sunshine"
 },
 axisY: {
   title: "Sunshine",
   includeZero: true
 },
 data: [{
   type: "spline",
   toolTipContent: "{y} Sunshine",
   dataPoints: dataPoints
 }]
});

$.get("data/data.csv", getDataPointsFromCSV);

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
         y: parseFloat(points[6])
         });
     }
   }
 }
 //draw the graph
 chart.render();
}
document.getElementById("downloadExcel").addEventListener("click", function(){
  downloadCSV({ filename: "chart-data.csv", chart: chart })
});
}
function convertChartDataToCSV(args) {
  var result, ctr, keys, columnDelimiter, lineDelimiter, data;

  data = args.data || null;


  columnDelimiter = args.columnDelimiter || ',';
  lineDelimiter = args.lineDelimiter || '\n';

  keys = Object.keys(data[0]);

  result = '';
  result += keys.join(columnDelimiter);
  result += lineDelimiter;

  data.forEach(function(item) {
    ctr = 0;
    keys.forEach(function(key) {
      if (ctr > 0) result += columnDelimiter;
      result += item[key];
      ctr++;
    });
    result += lineDelimiter;
  });
  return result;
}

function downloadCSV(args) {
  var data, filename, link;
  var csv = "";
  for(var i = 0; i < args.chart.options.data.length; i++){
    csv += convertChartDataToCSV({
      data: args.chart.options.data[i].dataPoints
    });
  }
  if (csv == null) return;

  filename = args.filename || 'chart-data.csv';

  if (!csv.match(/^data:text\/csv/i)) {
    csv = 'data:text/csv;charset=utf-8,' + csv;
  }

  data = encodeURI(csv);
  link = document.createElement('a');
  link.setAttribute('href', data);
  link.setAttribute('download', filename);
  document.body.appendChild(link); // Required for FF
	link.click();
	document.body.removeChild(link);
}
</script>
</head>



<div id="chartContainer" style="height: 800px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>
