<?php session_start();
include('connect.php');
$name=mysqli_real_escape_string($db, $_POST['uname1']);
$nameclean = filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$pass=mysqli_real_escape_string($db, $_POST['pass1']);
$passclean = filter_var($pass, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$result = $db->query("SELECT * FROM Users WHERE Email='$nameclean' ") ;
$total=$result->num_rows;
if($total<1){
echo 'That user is not in our system';
}else{
while ($row = $result->fetch_assoc()) {
if(password_verify($pass, $row['Password'])){
  $Rights = $row[8];
  $_SESSION['Email']=$Username;
  $_SESSION['Password']=$Password;
  $_SESSION['Rights']=$Rights;
  $_SESSION['loggedin']="1";
  echo "You are now logged in";
  header('location: index.php');
}else{
	echo 'Wrong Password';
}
}
}
$db->close();
?>
