 <?php
  if(isset($_SESSION['wrong_login'])){
   unset($_SESSION['wrong_login']);
  }
 ?>
 
  <?php
  if(isset($_SESSION['errorlog'])){
   unset($_SESSION['errorlog']);
  }
 ?>
 
  <?php
  if(isset($_SESSION['success'])){
   unset($_SESSION['success']);
  }
 ?>