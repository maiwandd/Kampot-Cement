<!-- Include file voor bootstrap, stylesheet etc. -->
<?php
include('header_menu.php');
include('inc/functions.php');
?>
<?php
if($_SESSION['rechten'] =='0') {
	$_SESSION['errorlog']="U heeft geen rechten om deze pagina te bekijken";
	header('location: index.php');
}?>
<?php
$csvFile = file('data/data.csv');
    $data = [];
    foreach ($csvFile as $line) {
        $data[] = str_getcsv($line);
    }

		// $alles = $data.length;
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<?php if (count($data) > 0):
		?>
	<table class="table">
		<thread>
			<tr>
				<th scope="col">Station Number</th>
				<th scope="col">Date</th>
				<th scope="col">Time</th>
				<th scope="col">Temperature</th>
				<th scope="col">Rainfall</th>
				<th scope="col">Wind Direction</th>
				<th scope="col">Humidity</th>
			</tr>
		</thread>
		<tbody>
			<?php
			$length = count($data);

			for ($i = 1; $i <= $length; $i++) { ?>
			<tr>
				<th><?php echo $data[$i][0];?></th>
				<td><?php echo $data[$i][1];?></td>
				<td><?php echo $data[$i][2];?></td>
				<td><?php echo $data[$i][5];?></td>
				<td><?php echo $data[$i][9];?></td>
				<td><?php echo $data[$i][13];?></td>
				<td><?php echo $data[$i][3];?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php endif; ?>
</body>
</html>
