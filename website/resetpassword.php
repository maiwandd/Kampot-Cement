<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>
<!-- Checkt of er als admin ingelogd is -->
<?php

if($_SESSION['Rights'] =='0') {
    $_SESSION['errorlog']="U heeft geen rechten om deze pagina te bekijken";
    header('location: index.php');
} ?>
<table id="summary">
  <tr>
    <td colspan="3"><h1>Reset Password</h1></td>
  </tr>
  <tr>
    <td colspan="4"> </td>
  </tr>

   <?php
	$userid = $_GET['user_id'];
  $query ="SELECT Email, Firstname, Middlename, Lastname FROM Users WHERE User_id = $userid";
  $results=mysqli_query($db, $query);
  $data=mysqli_fetch_assoc($results);
  ?>
  <div id="overzicht">
  <div class="overzicht">
	<table class="table">
		<tr>
			<form method="post" action="resetpassword.php">
   <tr>
    <td><strong>Email:</strong></td>
    <td><input type="text" name="Email" value="<?php echo ($data['Email'])?>" readonly></td>
  </tr>
  <tr>
    <td><strong>Firstname:</strong></td>
    <td><input type="text" name="Firstname" value="<?php echo ($data['Firstname'])?>" readonly></td>
  </tr>
  <tr>
  <td><strong>Lastname:</strong></td>
	<td><input type="text" name="Lastname" value="<?php echo ($data['Lastname'])?>" readonly></td>
  </tr>
  <tr>
  <td><strong>New Password:</strong></td>
  <td><input type="password" name="Password1"></td>
  </tr>
  <tr>
  <td><strong>Confirm Password:</strong></td>
  <td><input type="password" name="Password2"></td>
  </tr>

				<tr>
					<td colspan='2'>
						<a href="useroverview.php"><input type="button" class="btn btn-default" value="Return"></a>
						<input type='submit' class="btn btn-primary" value="Reset Password">
					</td>
				</tr>
			</form>
			</table>
<?php
// If the values are posted, insert them into the database.
if (isset($_POST['Password1'])){
	$Email = $_POST['Email'];
	$Password1 = $_POST['Password1'];
	$Password2 = $_POST['Password2'];
  if($Password1 == $Password2){
	   $query = "UPDATE Users SET Password='$Password1' WHERE Email='$Email'";
	   $result = mysqli_query($db, $query);
	     if($result){
		       echo "Password changed";
	        }else{
		          echo "Password not changed" .mysqli_error($db);
	           }
           } else {
             echo "Passwords are not the same";
           }
         } else {
         }
?>

  </table>
</body>
