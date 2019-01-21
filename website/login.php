<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>

<!-- Login pagina inhoud -->
<div class="row">
	<div class="col-sm-12">
		<h2>Inloggen</h2>
		<?php
			if (!isset($_SESSION['loggedin'])) {
		?>

		<table class="table">
			<tr>
				<form method="post" action="login.php">
					<td>Emailadres: </td>
					<td>
						<input type="text" name="Email" placeholder="Emailadres">
					</td>
			</tr>
			<tr>
				<td>Password: </td>
				<td>
					<input type="password" name="Password" placeholder="Password">
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<input type='submit' class="button" value="Login">
				</td>
			</tr>
				</form>
		</table>
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
			$_SESSION['errorlog']="Login gegevens niet geldig.";
			header('location: login.php');
		}
	}
?>
<!-- Einde login pagina inhoud -->
