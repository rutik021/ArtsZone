<?php include ('allhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-4"></div>

		<div class="col-md-4">
			<fieldset
				style="background: linear-gradient(to bottom right, #6bd4fe, #4aa9e9, #2b7fcf, #0e54b5, #003a9a); padding: 40px; border-radius: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
				<!-- Faculty login page -->
				<legend>


					<h3 style="padding-top: 25px; color: #fff;"><span class="glyphicon glyphicon-lock"></span>&nbsp;
						Faculty Login</h3>
				</legend>
				<form name="facultylogin" action="loginlinkfaculty" method="POST">
					<div class="control-group form-group">
						<div class="controls">
							<label style="color: #fff;">Faculty ID:</label>
							<input type="text" class="form-control" name="fid" required
								data-validation-required-message="Please enter your Faculty Id.">
							<p class="help-block"></p>
						</div>
					</div>
					<div class="control-group form-group">
						<div class="controls">
							<label style="color: #fff;">Password:</label>
							<input type="password" class="form-control" name="pass" required
								data-validation-required-message="Please enter your password.">
							<p class="help-block"></p>
						</div>
					</div>
					<center>
						<button type="submit" name="login" class="btn btn-success"
							style="border-radius: 10px; background-color: #0056b3; border-color: #0056b3; font-size: 18px;">Login</button>
						<button type="reset" class="btn btn-danger"
							style="border-radius: 10px; background-color: #b30000; border-color: #b30000; font-size: 18px;">Reset</button>
					</center>
				</form>
			</fieldset>
		</div>

		<div class="col-md-4"></div>
	</div>
</div>

<?php include ('allfoot.php'); ?>