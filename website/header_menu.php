<!-- Include file voor bootstrap, stylesheet etc. -->

<?php
	error_reporting(E_ERROR);
	session_start();

	include ('connect.php');
	include ('sessions.php');
	include ('sessions_error.php');
?>

<head>
	<title>Weather Application</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap  bestanden -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- Stylesheet -->
	<link rel="stylesheet" href="style.css">
</head>

<!-- Include file voor header en navigatiemenu -->
<body>


		<!-- menu -->
		<div class="row">
			<nav class="navbar navbar-inverse">
				<div class="navbar-header">

					<!-- Small scherm -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navigatiemenu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<a class="navbar-brand" href="index.php">Home</a>
				</div>

				<!-- Admin menu -->
				<?php if($_SESSION['Rights'] =='2') { ?>
					<div class="collapse navbar-collapse" id="Navigatiemenu">
						<ul class="nav navbar-nav">
							<li><a href="weather.php">Weather</a></li>
							<li><a href="graphs.php">Graphs</a></li>
							<li><a href="data.php">Data</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="newuser.php"><span class="glyphicon glyphicon-log-in"></span> Create User</a></li>
							<li><a href="useroverview.php"><span class="glyphicon glyphicon-log-in"></span>User Overview</a></li>
							<li><a href="profilepage.php"><span class="glyphicon glyphicon-log-in"></span> Settings</a></li>
							<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
						</ul>
					</div>

				<!-- Menu if the users are logged in -->
			<?php } elseif ($_SESSION['Rights'] =='1') { ?>
					<div class="collapse navbar-collapse" id="Navigatiemenu">
						<ul class="nav navbar-nav">
							<li><a href="weather.php">Weather</a></li>
							<li><a href="graphs.php">Graphs</a></li>
							<li><a href="data.php">Data</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="profilepage.php"><span class="glyphicon glyphicon-log-in"></span> Settings</a></li>
							<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
						</ul>
					</div>

				<!-- Menu if not logged in -->
				<?php } else { ?>
					<div class="collapse navbar-collapse" id="Navigatiemenu">
						<ul class="nav navbar-nav">

						</ul>
						<ul class="nav navbar-nav navbar-right">
						</ul>
					</div>
				<?php } ?>
			</nav>
		</div>
