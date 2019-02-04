<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>
<!-- Checkt of er als admin ingelogd is -->
<?php
if($_SESSION['rechten'] =='1') {
		$_SESSION['errorlog']="You have no rights to visit this webpage";
	header('location: index.php');
}
elseif($_SESSION['rechten'] =='0') {
    $_SESSION['errorlog']="You have no rights to visit this webpage";
    header('location: index.php');
} ?>
<table id="summary">
  <tr>
    <td colspan="3"><h1>New User</h1></td>
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
  <div id="overzicht">
  <div class="overzicht">
	<table class="table">
		<tr>
			<form method="post" action="newuser.php">
   <tr>
    <td><strong>Email:</strong></td>
    <td><input type="text" name="Email" value="<?php echo ($data['Email'])?>"></td>
  </tr>
  <tr>
   <td><strong>Password:</strong></td>
   <td><input type="password" name="Password" value="<?php echo ($data['Password'])?>"></td>
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
  <td><input type="text" name="DateofBirth" placeholder="yyyy-mm-dd" value="<?php echo ($data['DateofBirth'])?>"></td>
  </tr>
  <tr>
  <td><strong>Phonenumber:</strong></td>
  <td><input type="text" name="Phonenumber" value="<?php echo ($data['Phonenumber'])?>"></td>
  </tr>
				<tr>
					<td colspan='2'>
						<a href="index.php"><input type="button" class="btn btn-default" value="Terug"></a>
						<input type='submit' class="btn btn-primary" value="Add User">
					</td>
				</tr>
			</form>
			</table>
<?php
// If the values are posted, insert them into the database.
if (isset($_POST['Email'])){
	$Email = $_POST['Email'];
  $Password = $_POST['Password'];
	$Password_hash = Password_hash($Password, PASSWORD_BCRYPT);
	$Firstname = $_POST['Firstname'];
	$Middlename = $_POST['Middlename'];
	$Lastname = $_POST['Lastname'];
	$DateofBirth = $_POST['DateofBirth'];
	$Phonenumber = $_POST['Phonenumber'];

	$query = "INSERT INTO Users (Email, Password, Firstname, Middlename, Lastname, DateofBirth, Phonenumber, Rights) VALUES ('$Email', '$Password_hash', '$Firstname', '$Middlename', '$Lastname', '$DateofBirth', '$Phonenumber', 1)";
	$result = mysqli_query($db, $query);
	if($result){
		echo "User added";
	}else{
		echo "User not added" .mysqli_error($db);
	}
}
?>
  </table>
</body>
