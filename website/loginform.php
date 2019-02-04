<?php session_start(); ?>
<?php include('header_menu.php'); ?>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<input id="username" type="text" placeholder="Username">
<input id="pass" type="password" placeholder="Password">
<input id="submit" type="button" value="Log In">
<div id="display"></div>
<script>
$(document).ready(function(){
$("#submit").click(function(){
var uname = $("#username").val();
var pass = $("#pass").val();
var dataString = 'uname1='+ uname + '&pass1='+ pass;
if(uname==''||pass=='')
{
$("#display").html("Please Fill All Fields");
}
else
{
$.ajax({
type: "POST",
url: "login2.php",
data: dataString,
cache: false,
success: function(result){
$("#display").html(result);
}
});
}
return false;
});
});
</script>
</body>
</html>
