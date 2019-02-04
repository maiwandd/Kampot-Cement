<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>


<!-- Login page content -->
<div class="row">
	<div class="col-sm-12">
		<h2 align="center">Log in</h2>
		<?php
			if (!isset($_SESSION['loggedin'])) {
		?>
			<form align='center' action = 'login.php' method='post'>
			<h3 align='center'>Kampot Cement</h3>
			<br><br><br>
			<fieldset align='center'>
			E-mail:<br>
			<input type='text' name='Email' placeholder = 'E-mail'><br>
			Password:<br>
			<input type='password' name='Password' placeholder='Password'><br><br>
			<input type='submit' class="button" value='Login'>

		<?php
			}
			else {
		?>

		<?php
			}
		?>

	</div>
</div>

<?php
	if(!empty($_POST)){
		$query="SELECT * FROM Users WHERE `Email`='".$_POST['Email']."' AND Password='".$_POST['Password']."'";
		$result=mysqli_query($db, $query) or die(mysqli_error($db));

		if(mysqli_num_rows($result) > 0) {
			/*Login Success*/
			$Username=$_POST['Email'];
			$Password=$_POST['Password'];
			while($row = mysqli_fetch_row($result)){
				$Rights = $row[8];
				$_SESSION['Email']=$Username;
				$_SESSION['Password']=$Password;
				$_SESSION['Rights']=$Rights;
				$_SESSION['loggedin']="1";
				echo "You are now logged in";
			header('location: index.php');
			}
		}
		else{
			$_SESSION['errorlog']="Incorrect login.";
			echo '<script>alert("Incorrect login")</script>';
			header('location: login.php');
		}
	}
?>
<!-- End login page content -->
