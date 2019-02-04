<?php include('header_menu.php')?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Google Visualization API Sample</title>
<!--
  One script tag loads all the required libraries! Do not specify any chart types in the
  autoload statement.
-->
<script type="text/javascript"
      src='https://www.gstatic.com/charts/loader.js'></script>
<script type="text/javascript">
  google.charts.load('current');
  google.charts.setOnLoadCallback(drawVisualization);

  function drawVisualization() {
    var wrap = new google.visualization.ChartWrapper({
       'chartType':'LineChart',
       'dataSourceUrl':'http://spreadsheets.google.com/tq?key=pCQbetd-CptGXxxQIG7VFIQ&pub=1',
       'containerId':'visualization',
       'query':'SELECT A,D WHERE D > 100 ORDER BY D',
       'options': {'title':'Population Density (people/km^2)', 'legend':'none'}
       });
     wrap.draw();
  }
</script>
</head>
<body>

<select id="myselect" onchange="change_myselect(this.value)">
  <option value="">Choose data history:</option>
  <option value="previous week">Previous week</option>
  <option value="2 weeks ago">Two weeks ago</option>
  <option value="3 weeks ago">Three weeks ago </option>
  <option value="4 weeks ago">Four weeks ago</option>
</select>

<p id="demo"></p>

<script>
function change_myselect(sel) {
  var obj, dbParam, xmlhttp, myObj, x, txt = "";
  obj = { table: sel, limit: 20 };
  dbParam = JSON.stringify(obj);
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myObj = JSON.parse(this.responseText);
      txt += "<table border='1'>"
      for (x in myObj) {
        txt += "<tr><td>" + myObj[x].name + "</td></tr>";
      }
      txt += "</table>"
      document.getElementById("demo").innerHTML = txt;
      }
    };
  xmlhttp.open("POST", "json_demo_db_post.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("x=" + dbParam);
}

}
</script>

  <div id="visualization" style="height: 400px; width: 400px;"></div>
</body>
</html>
