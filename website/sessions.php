<?php
	/* Session wrong login */
	if(isset($_SESSION['wrong_login'])) {
		?>
			<div class="alert_failure">
			<?php echo $_SESSION['wrong_login'];?>
			</div>
		<?php 
	}
	
	/* Session success */
	if(isset($_SESSION['success'])) {
		?>
			<div class="alert-success">
			<?php echo $_SESSION['success'];?>
			</div>
		<?php
	}
	
	/* Session error */
	if(isset($_SESSION['errorlog'])) {
		?>
			<div class="alert_failure">
				<?php echo $_SESSION['errorlog'];?>
			</div>
		<?php
	}
?>