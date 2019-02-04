<html>
<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>
<!-- Homepagina inhoud -->
<div class="row">
	<div class="col-sm-12">
		<?php
		if (!isset($_SESSION['loggedin'])) {
			header('location: login.php');
			?>
			<?php
		}
		else {
			?>
			<body>
				<h2 align="center">Kampot Cement</h2>
				<h3 align="center">Welcome!</h3>
				<br>
				<div class="container">
					<div class="row">
						<div class="col">
							<h4>System Status</h4>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<table class="table">
								<thread>
									<tr>
										<th scope="col">System</th>
										<th scope="col">Status</th>
										<th scope="col">Errors</th>
									</tr>
								</thread>
								<tbody>
									<tr>
										<td width="35%">Raspberry Pi</td>
										<td width="25%"><span style="height: 25px; width: 25px; background-color: Green; border-radius: 50%; display: inline-block;"></span></td>
										<td>None</td>
									</tr>
									<tr>
										<td>Weather Application</td>
										<td><span style="height: 25px; width: 25px; background-color: Green; border-radius: 50%; display: inline-block;"></span></td>
										<td>None</td>
									</tr>
									<tr>
										<td>Microsoft Azure Virtual Machine</td>
										<td><span style="height: 25px; width: 25px; background-color: Green; border-radius: 50%; display: inline-block;"></span></td>
										<td>None</td>
									</tr>
								</tbody>
							</table>
						</div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-6">
						<h4>Quick Temperature Graph</h4>
						<iframe id="iframe" width="85%" height="55%" src="temp.php"></iframe>
					</div>
					<div class="col-xs-6">
						<h4>Quick Rainfall Graph</h4>
						<iframe id="iframe" width="85%" height="55%" src="rain.php"></iframe>
					</div>
				</div>
			</div>
			</body>
			<?php
		}
		?>
	</div>
</div>
<!-- Einde homepagina inhoud -->
</html>
<!-- Include file voor footer -->
