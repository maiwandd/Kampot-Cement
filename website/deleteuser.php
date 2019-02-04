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
    <td colspan="3"><h1>Delete User</h1></td>
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
			<form method="post" action="deleteuser.php">
   <tr>
		 <?php //shows the data of the user  ?>
    <td><strong>Email:</strong></td>
    <td><input type="text" name="Email" value="<?php echo ($data['Email'])?>" readonly></td>
  </tr>
  <tr>
    <td><strong>Firstname:</strong></td>
    <td><input type="text" name="Firstname" value="<?php echo ($data['Firstname'])?>" readonly></td>
  </tr>
  <tr>
	<td><strong>Middlename:</strong></td>
	<td><input type="text" name="Middlename" value="<?php echo ($data['Middlename'])?>" readonly></td>
  </tr>
  <tr>
  <td><strong>Lastname:</strong></td>
	<td><input type="text" name="Lastname" value="<?php echo ($data['Lastname'])?>" readonly></td>
  </tr>
  <tr>
  <td><strong>DateofBirth:</strong></td>
  <td><input type="text" name="DateofBirth" placeholder="yyyy-mm-dd" value="<?php echo ($data['DateofBirth'])?>" readonly></td>
  </tr>
  <tr>
  <td><strong>Phonenumber:</strong></td>
  <td><input type="text" name="Phonenumber" value="<?php echo ($data['Phonenumber'])?>" readonly></td>
  </tr>
				<tr>
					<td colspan='2'>
						<a href="useroverview.php"><input type="button" class="btn btn-default" value="Return"></a>
						<input type='submit' class="btn btn-danger" value="Delete User" onclick="return confirm('Are you sure you want to delete this user? This cannot be undone.')"> <?php // confirming if the admin is sure to delete the user ?>
					</td>
				</tr>
			</form>
			</table>
<?php
// If the values are posted, insert them into the database.
if (isset($_POST['Email'])){
	$Email = $_POST['Email'];

	$query = "DELETE FROM Users Where Email = '$Email'";
	$result = mysqli_query($db, $query);
	if($result){
		echo "User deleted";
	}else{
		echo "User not deleted" .mysqli_error($db);
	}
}
?>
  </table>
</body>
