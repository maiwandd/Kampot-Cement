<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>
<!-- Homepagina inhoud -->
<div class="row">
	<div class="col-sm-12">
    <?php
      if (!isset($_SESSION['loggedin'])) {
        header('location: login.php');
    ?>
    <?php
      }
      else {
        echo "U bent ingelogd";
    ?>

    <?php
      }
    ?>
	</div>
</div>
<!-- Einde homepagina inhoud -->

<!-- Include file voor footer -->
