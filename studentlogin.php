<?php include ('allhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-4"></div>

		<div class="col-md-4">
			<!-- Student login page -->
			<fieldset
				style="background-color: #4caf50; padding: 40px; border-radius: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
				<legend>
					<h3 style="padding-top: 25px; color: #fff;"><span class="glyphicon glyphicon-lock"></span>&nbsp;
						Student Login
					</h3>
				</legend>
				<form name="studentlogin" action="loginlinkstudent.php" method="POST">
					<div class="control-group form-group">
						<div class="controls">
							<label style="color: #fff;">Email:</label>
							<input type="email" class="form-control" name="email" required>
							<p class="help-block"></p>
						</div>
					</div>
					<div class="control-group form-group">
						<div class="controls">
							<label style="color: #fff;">Password:</label>
							<input type="password" class="form-control" name="password" required>
							<p class="help-block"></p>
						</div>
					</div>
					<center>
						<button type="submit" name="login" class="btn btn-success"
							style="border-radius: 10px; background-color: #388e3c; border-color: #388e3c; font-size: 18px;">Login</button>
						<button type="reset" class="btn btn-danger"
							style="border-radius: 10px; background-color: #c62828; border-color: #c62828; font-size: 18px;">Reset</button>
					</center>
				</form>
			</fieldset>
		</div>

		<div class="col-md-4"></div>
	</div>
</div>

<?php include ('allfoot.php'); ?>