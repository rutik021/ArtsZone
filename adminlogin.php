<?php include ('allhead.php'); ?>

<div class="container">
	<div class="row"></div>
	<div class="row">
		<div class="col-md-4"></div>

		<div class="col-md-4">
			<fieldset
				style="background-color: #f0f0f0; padding: 40px; border-radius: 20px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);">
				<legend>
					<h3 style="padding-top: 25px; color: #333;"><span class="glyphicon glyphicon-lock"></span>&nbsp;
						Admin Login</h3>
				</legend>
				<!-- Admin login form -->
				<form name="adminlogin" action="loginlinkadmin.php" method="POST">
					<div class="control-group form-group">
						<div class="controls">
							<label style="color: #555;">Username:</label>
							<input type="text" class="form-control" name="aid"
								style="border-radius: 10px; border-color: #ddd;">
							<p class="help-block"></p>
						</div>
					</div>
					<div class="control-group form-group">
						<div class="controls">
							<label style="color: #555;">Password:</label>
							<input type="password" class="form-control" name="apass"
								style="border-radius: 10px; border-color: #ddd;">
							<p class="help-block"></p>
						</div>
					</div>
					<center>
						<button type="submit" name="login" class="btn btn-success"
							style="border-radius: 10px;">Login</button>
						<button type="reset" class="btn btn-danger" style="border-radius: 10px;">Reset</button>
					</center>
				</form>
			</fieldset>
		</div>

		<div class="col-md-4"></div>
	</div>
	<?php include ('allfoot.php'); ?>