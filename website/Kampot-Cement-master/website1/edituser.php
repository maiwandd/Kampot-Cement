<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>
<!-- Checkt of er als admin ingelogd is -->
<?php
if($_SESSION['Rights'] =='1') {
		$_SESSION['errorlog']="U heeft geen rechten om deze pagina te bekijken";
	header('location: index.php');
}
elseif($_SESSION['Rights'] =='0') {
    $_SESSION['errorlog']="U heeft geen rechten om deze pagina te bekijken";
    header('location: index.php');
} ?>
<table id="summary">
  <tr>
    <td colspan="3"><h1>User overview</h1></td>
  </tr>
  <tr>
    <td colspan="4"> </td>
  </tr>
  <tr>

  </tr>
  <tr>
    <td></td>
    <td></td>
  </tr>
   <?php
	$userid = $_GET['user_id'];
  $query ="SELECT Email, Firstname, Middlename, Lastname, DateofBirth, Phonenumber FROM Users WHERE User_id = $userid";
  $results=mysqli_query($db, $query);
  $data=mysqli_fetch_assoc($results);
  ?>
  <div id="overzicht">
  <div class="overzicht">
	<table class="table">
		<tr>
			<form method="post" action="edituser.php">
   <tr>
    <td><strong>Email:</strong></td>
    <td><input type="text" name="Email" value="<?php echo ($data['Email'])?>"></td>
  </tr>
  <tr>
    <td><strong>Firstname:</strong></td>
    <td><input type="text" name="Firstname" value="<?php echo ($data['Firstname'])?>"></td>
  </tr>
  <tr>
	<td><strong>Middlename:</strong></td>
	<td><input type="text" name="Middlename" value="<?php echo ($data['Middlename'])?>"></td>
  </tr>
  <tr>
  <td><strong>Lastname:</strong></td>
	<td><input type="text" name="Lastname" value="<?php echo ($data['Lastname'])?>"></td>
  </tr>
  <tr>
  <td><strong>DateofBirth:</strong></td>
  <td><input type="text" name="DateofBirth" value="<?php echo ($data['DateofBirth'])?>"></td>
  </tr>
  <tr>
  <td><strong>Phonenumber:</strong></td>
  <td><input type="text" name="Phonenumber" value="<?php echo ($data['Phonenumber'])?>"></td>
  </tr>

				<tr>
					<td colspan='2'>
						<a href="useroverview.php"><input type="button" class="btn btn-default" value="Return"></a>
						<input type='submit' class="btn btn-primary" value="Edit user">
					</td>
				</tr>
			</form>
			</table>
<?php
// If the values are posted, insert them into the database.
if (isset($_POST['Email'])){
	$Email = $_POST['Email'];
	$Firstname = $_POST['Firstname'];
	$Middlename = $_POST['Middlename'];
	$Lastname = $_POST['Lastname'];
	$DateofBirth = $_POST['DateofBirth'];
	$Phonenumber = $_POST['Phonenumber'];


	$query = "UPDATE Users SET Email='$Email', Firstname='$Firstname', Middlename='$Middlename', Lastname='$Lastname' WHERE Email = $Email";
	$result = mysqli_query($db, $query);
	if($result){
		echo "User changed";
	}else{
		echo "User not changed" .mysqli_error($db);
	}
}
?>

  </table>
</body>
