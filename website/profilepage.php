<!-- Include file voor bootstrap, stylesheet etc. -->
<?php include('header_menu.php'); ?>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form class="form-horizontal" role="form">
					<fieldset>
						<?php
						$query = "SELECT * FROM Users WHERE Email = '".$_SESSION['Email']."'"; //imports the current userdata of the user
						$result=mysqli_query($db, $query) or die(mysqli_error($db));

						while($Data = mysqli_fetch_assoc($result)) { //binds the userdata to an variable
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
						display for all userdata
						all the userdata will be displayed using the corresponding variable
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
								<!-- Buttons with links -->
									<a href="resetpassword.php?user_id=<?php echo $UserID?>" class="btn btn-primary">Change Password</a>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>

	</div>


<!-- Include footer -->
