<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>
<?php
if($_SESSION['rechten'] =='0') {
		$_SESSION['errorlog']="U heeft geen rechten om deze pagina te bekijken";
	header('location: index.php');
}?>
<html>
  <head>
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
   <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

          var queryOptions = {
            csvColumns: ['number', 'number'],
            csvHasHeader: true
          }

          var query = new google.visualization.Query('http://localhost/website/data/testdata.csv', queryOptions);
					query.setQuery('select A, B group by A');
          query.send(handleQueryResponse);
     }

     function handleQueryResponse (response) {

			 if (response.isError()) {
	    	alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
	    	return;
        }

        var data = response.getDataTable();
				data.addColumn('number', 'TEMP');
				data.addColumn('number', 'DATE');

        var chart = new google.visualization.LineChart(document.getElementById('chart'));


        chart.draw(data);
      }
    </script>
  </head>
  <body>
<div id="chart" style="width: 100%; height: 100%;"></div>
</body>
</html>
