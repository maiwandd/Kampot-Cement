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
		echo '<h2 align="center">Data in Graphs</h2>';
		echo '<br> <br> <br>';
        echo '<img src="graph-placeholder.jpg" style="width:49%; padding:30px;">';
		echo '<img src="graph-placeholder.jpg" align="right" style="width:49%; padding:30px;">';
	  }
    ?>
	</div>
</div>
<!-- Einde homepagina inhoud -->

<!-- Include file voor footer -->

