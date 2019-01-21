<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form class="form-horizontal" role="form">
					<fieldset>
						<?php
						$query = "SELECT * FROM Users WHERE Email = '".$_SESSION['Email']."'"; //haalt huidige klantData op van huidige klant
						$result=mysqli_query($db, $query) or die(mysqli_error($db));

						while($Data = mysqli_fetch_assoc($result)) { //koppelt alle klant Data aan een variabele
							$Firstname = $Data['Firstname'];
							$Lastname = $Data['Lastname'];
							$Middlename = $Data['Middlename'];
							$DateofBirth = $Data['DateofBirth'];
							$Phonenumber = $Data['Phonenumber'] ;
							$Email = $Data['Email'];
							$UserID = $Data['User_id'];
								}
						?>
						<!--
						Weergave voor alle klantData
						Alle klantinformatie wordt weergevens dmv de bijhorende variable
						-->
						<legend>Personal Data</legend>

						<div class="form-group">
							<label class="col-sm-2" >First name</label>
							<div class="col-sm-10">
								<p> <?php echo ($Firstname)?> </p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2" >Last name</label>
							<div class="col-sm-10">
								<p> <?php echo ($Lastname)?> </p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2" >Middle name</label>
							<div class="col-sm-10">
								<p> <?php echo ($Middlename)?> </p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2" >Email</label>
							<div class="col-sm-10">
								<p> <?php echo ($Email)?> </p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2" >Date of birth</label>
							<div class="col-sm-10">
								<p> <?php echo ($DateofBirth)?> </p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2" >Phone Number</label>
							<div class="col-sm-10">
								<p> <?php echo ($Phonenumber)?> </p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="pull-left">
								<!-- Buttons met links -->
									<a href="pwedit.php" class="btn btn-primary">Change Password</a>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>

	</div>


<!-- Include footer -->
