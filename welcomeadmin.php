<?php
session_start();

if ($_SESSION["umail"] == "" || $_SESSION["umail"] == NULL) {
	header('Location:AdminLogin.php');
}
$userid = $_SESSION["umail"];
?>
<!DOCTYPE HTML>
<?php include ('adminhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<!--Welcome page for admin-->
			<h3 style="margin-bottom: 30px;"> Welcome <a href="welcomeadmin">Admin</a></h3>

			<div class="btn-group" role="group" aria-label="Admin options">
				<a href="studentdetails"><button type="button" class="btn btn-primary"><i
							class="fa fa-graduation-cap"></i> Student Details</button></a>
				<a href="facultydetails"><button type="button" class="btn btn-primary"><i class="fa fa-users"></i>
						Faculty Details</button></a>
				<a href="guestdetails"><button type="button" class="btn btn-primary"><i class="fa fa-user"></i> Guest
						Details</button></a>
				<a href="logoutadmin"><button type="button" class="btn btn-danger">Logout</button></a>
			</div>
		</div>
	</div>
</div>
<?php include ('allfoot.php'); ?>