<?php
session_start();
if(isset($_SESSION['Email'])){
   unset($_SESSION['Email']);
}

if(isset($_SESSION['Password'])){
   unset($_SESSION['Password']);
}

if(isset($_SESSION['Rights'])){
   $_SESSION['Rights']='0';
}

if(isset($_SESSION['loggedin'])){
	unset($_SESSION['loggedin']);
}


header('location: index.php');


?>
