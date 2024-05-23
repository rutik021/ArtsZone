<style>
	/* Add CSS styles for the form */
	form {
		background-color: #eaf7e4;
		/* Light green background color */
		padding: 30px;
		/* Add some padding */
		box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
		/* Add light shadow effect */
		border-radius: 15px;
		/* Add border radius for rounded corners */
	}
</style>
<?php include ('allhead.php'); ?>
<script>
	// JavaScript validation for various fields
	function validateForm() {
		var fname = document.forms["register"]["fname"].value;
		var lname = document.forms["register"]["lname"].value;
		var faname = document.forms["register"]["faname"].value;
		var course = document.forms["register"]["course"].value;
		var dob = document.forms["register"]["dob"].value;
		var addrs = document.forms["register"]["addrs"].value;
		var gender = document.forms["register"]["gender"].value;
		var phno = document.forms["register"]["phno"].value;
		var x = document.forms["register"]["email"].value;
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		var pass = document.forms["register"]["pass"].value;
		var cpass = document.forms["register"]["cpass"].value;
		if (fname == null || fname == "") {
			alert("First Name must be filled out");
			return false;
		}
		if (lname == null || lname == "") {
			alert("Last Name must be filled out");
			return false;
		}
		if (faname == null || faname == "") {
			alert("Father Name must be filled out");
			return false;
		}
		if (course == null || course == "") {
			alert("Course must be filled out");
			return false;
		}
		if (dob == null || dob == "") {
			alert("Date of birth must be filled out");
			return false;
		}
		if (addrs == null || addrs == "") {
			alert("Address must be filled out");
			return false;
		}
		if (gender == null || gender == "") {
			alert("Gender must be filled out");
			return false;
		}
		if (phno == null || phno == "") {
			alert("Phone Number must be filled out");
			return false;
		}
		if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
			alert("Not a valid e-mail address");
			return false;
		}
		if (pass == null || pass == "") {
			alert("Password must be filled out");
			return false;
		}
		if (pass != cpass) {
			alert("Conform Password");
			return false;
		}

	}
</script>

<div class="container" style="max-width: 1200px;">
	<div class="row">
		<?php
		include ("database.php");
		if (isset($_POST['submit'])) {
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$faname = $_POST['faname'];
			$course = $_POST['course'];
			$dob = $_POST['dob'];
			$addrs = $_POST['addrs'];
			$gender = $_POST['gender'];
			$phno = $_POST['phno'];
			$email = $_POST['email'];
			$pass = $_POST['pass'];

			$done = "
			<center>
			<div class='alert alert-success fade in __web-inspector-hide-shortcut__'' style='margin-top:10px;'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
			<strong><h3 style='margin-top: 10px;
			margin-bottom: 10px;'> Register Successfully Complete. Now You Can Login With Your Email & Password</h3>
			</strong>
			</div>
			</center>
			";

			$sql = "INSERT INTO `studenttable` (`FName`, `LName`, `FaName`, `DOB`, `Addrs`, `Gender`, `PhNo`, `Eid`, `Pass`,`Course`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$fname, $lname, $faname, $dob, $addrs, $gender, $phno, $email, $pass, $course]);

			echo $done;
		}
		?>
	</div>
	<div class="row">
		<div class="col-md-3"></div>

		<div class="col-md-6">
			<form name="register" action="" method="POST" onsubmit="return validateForm()">
				<fieldset>
					<legend>
						<h3 style="padding-top: 25px;"> Registration Form </h3>
					</legend>
					<div class="control-group form-group">
						<div class="controls">
							<label>First Name: <span style="color: #ff0000;">*</span></label>
							<input type="text" class="form-control" name="fname" id="fname" maxlength="30">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Last Name: <span style="color: #ff0000;">*</span></label>
							<input type="text" class="form-control" name="lname" id="lname" maxlength="30">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Father Name: <span style="color: #ff0000;">*</span></label>
							<input type="text" class="form-control" name="faname" id="faname" maxlength="30">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Course: <span style="color: #ff0000;">*</span></label>
							<select class="form-control" name="course" id="course">
								<option value="">Select Course</option>
								<option value="Shading">Shading</option>
								<option value="Painting">Painting</option>
								<option value="canvas">canvas</option>
								<option value="scketching">scketching</option>
								<option value="gradient">gradient</option>
							</select>
							<p class="help-block"></p>
						</div>
					</div>


					<div class="control-group form-group">
						<div class="controls">
							<label>Date of Birth: <span style="color: #ff0000;">*</span></label>
							<input type="Date" class="form-control" name="dob" id="dob">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Address: <span style="color: #ff0000;">*</span></label>
							<textarea class="form-control" name="addrs" id="addrs"></textarea>
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label> Gender: <span style="color: #ff0000;">*</span></label>
							<p>
								<label>
									<input type="radio" name="gender" value="Male" id="Gender_0" checked>
									Male
								</label>
								<label>
									<input type="radio" name="gender" value="Female" id="Gender_1">
									Female
								</label>
								<br>
							</p>
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Contact (format: without code only 10 digits): <span
									style="color: #ff0000;">*</span></label>
							<input type="tel" pattern="^\d{10}$" required class="form-control" name="phno" id="phno"
								maxlength="10">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Email Id: <span style="color: #ff0000;">*</span></label>
							<input type="text" class="form-control" name="email" id="email" maxlength="50">
							<p class="help-block"></p>
						</div>
					</div>


					<div class="control-group form-group">
						<div class="controls">
							<label>Password: <span style="color: #ff0000;">*</span></label>
							<input type="password" class="form-control" name="pass" id="pass" maxlength="30">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Conform Password: <span style="color: #ff0000;">*</span></label>
							<input type="password" class="form-control" name="cpass" id="cpass" maxlength="30">
							<p class="help-block"></p>
						</div>
					</div>

					<button type="submit" name="submit" class="btn btn-primary">Register</button>
					<button type="reset" name="reset" class="btn btn-danger">Clear</button>


				</fieldset>
			</form>
		</div>

		<div class="col-md-3"></div>
	</div>
</div>