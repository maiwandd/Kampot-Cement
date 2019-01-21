<?php
session_start();
if(isset($_SESSION['Email'])){
   unset($_SESSION['Email']);
}

if(isset($_SESSION['Wachtwoord'])){
   unset($_SESSION['Wachtwoord']);
}

if(isset($_SESSION['Rights'])){
   $_SESSION['Rights']='0';
}

if(isset($_SESSION['loggedin'])){
	unset($_SESSION['loggedin']);
}


header('location: index.php');


?>
