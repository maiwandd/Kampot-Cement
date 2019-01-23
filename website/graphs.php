<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>

<html>
  <head>
		<?php//grafiek?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);


			function draw() {
				drawToolbar();
			}

			function drawChart() {
				var jsonData = $.ajax({
				url: "getData.php",
				dataType: "json",
				async: false
			}).responseText;

			var data = new google.visualization.DataTable(jsonData);

      	var options = {
          title: 'Weather',
          curveType: 'function',
          legend: { position: 'right' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
			function doGet() {
			  var app = UiApp.createApplication();
			  var sampleData = Charts.newDataTable()
			      .addColumn(Charts.ColumnType.STRING, "Month")
			      .addColumn(Charts.ColumnType.NUMBER, "Dining")
			      .addColumn(Charts.ColumnType.NUMBER, "Total")
			      .addRow(["Jan", 60, 520])
			      .addRow(["Feb", 50, 430])
			      .addRow(["Mar", 53, 440])
			      .addRow(["Apr", 70, 410])
			      .addRow(["May", 80, 390])
			      .addRow(["Jun", 60, 500])
			      .addRow(["Jul", 100, 450])
			      .addRow(["Aug", 140, 431])
			      .addRow(["Sep", 75, 488])
			      .addRow(["Oct", 70, 521])
			      .addRow(["Nov", 58, 388])
			      .addRow(["Dec", 63, 400])
			      .build();

			  var chart = Charts.newTableChart()
			      .setDimensions(600, 500)
			      .build();

			  var categoryFilter = Charts.newCategoryFilter()
			      .setFilterColumnLabel("Month")
			      .setAllowMultiple(true)
			      .setSortValues(true)
			      .setLabelStacking(Charts.Orientation.VERTICAL)
			      .setCaption('Choose categories...')
			      .build();

			  var panel = app.createVerticalPanel().setSpacing(10);
			  panel.add(categoryFilter).add(chart);

			  var dashboard = Charts.newDashboardPanel()
			      .setDataTable(sampleData)
			      .bind(categoryFilter, chart)
			      .build();

			  dashboard.add(panel);
			  app.add(dashboard);
			  return app;
			}


	<?php	//download bestand?>
			function drawToolbar() {
	      var components = [
	          {type: 'csv', datasource: 'https://spreadsheets.google.com/tq?key=pCQbetd-CptHnwJEfo8tALA'}
	       	      ];

	      var container = document.getElementById('toolbar_div');
	      google.visualization.drawToolbar(container, components);
	    };

			google.charts.setOnLoadCallback(draw);
	    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
	  <div id="toolbar_div"></div>
  </body>
</html>
