<?php include ('allhead.php'); ?>
<div class="container">
	<script>
		// JavaScript validation for email, query field, and guest name
		function validateFormPublicQuery() {
			var email = document.forms["update"]["email"].value;
			var query = document.forms["update"]["queryx"].value;
			var gname = document.forms["update"]["gname"].value;
			if (email == null || email == "") {
				alert("Email Address must be filled out");
				return false;
			}
			if (query == null || query == "") {
				alert("Query field must be filled out");
				return false;
			}
			if (gname == null || gname == "") {
				alert("Full Name must be filled out");
				return false;
			}
		}
	</script>
	<div class="row">
		<div class="col-md-2"></div>

		<div class="col-md-8">
			<h3> Welcome Guest</h3>
			<form action="" method="POST" name="update" onsubmit="return validateFormPublicQuery()">
				<fieldset>
					<legend>
						<h3 style="padding-top: 25px;"> Post Query Details </h3>
					</legend>
					<div class="control-group form-group">
						<div class="controls">
							<input placeholder="Full Name" type="text" class="form-control" id="gname" name="gnamex"
								maxlength="50">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<input placeholder="Email ID" type="email" class="form-control" id="email" name="email"
								maxlength="50">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Query : </label>
							<textarea class="form-control" rows="5" cols="40" id="queryx" name="squeryx"
								maxlength="200"></textarea>
							<p class="help-block"></p>
						</div>
					</div>
					<div class="form-group">
						<input type="submit" value="Post Query" name="update" class="btn btn-success"
							style="border-radius:0%">
						<button type="reset" name="reset" class="btn btn-danger" style="border-radius:0%">Clear</button>
				</fieldset>
			</form>
			<?php
			if (isset($_POST['update'])) {
				include ('database.php');
				$tempsquery = $_POST['squeryx'];
				$tempseid = $_POST['email'];
				$tempgname = $_POST['gnamex'];

				// Prepare and execute SQL queries using PDO
				$sql = "INSERT INTO `query`(`Query`, `Eid`) VALUES (:query, :email)";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':query', $tempsquery, PDO::PARAM_STR);
				$stmt->bindParam(':email', $tempseid, PDO::PARAM_STR);
				$stmt->execute();

				$sql2 = "INSERT INTO `guest`(`Gname`, `GuEid`) VALUES (:gname, :email)";
				$stmt2 = $pdo->prepare($sql2);
				$stmt2->bindParam(':gname', $tempgname, PDO::PARAM_STR);
				$stmt2->bindParam(':email', $tempseid, PDO::PARAM_STR);
				$stmt2->execute();

				if ($stmt && $stmt2) {
					echo "<br>
				<br><br>
				<div class='alert alert-success fade in'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<strong>Success!</strong> Your Query Added Successfully. Reff. No: " . $pdo->lastInsertId() . "
				</div>";
				} else {
					//error message if SQL query fails
					echo "<br><Strong>Query Adding Failure. Try Again</strong><br> Error Details: " . $pdo->errorInfo()[2];
				}
			}
			?>
		</div>

		<div class="col-md-2"></div>
	</div>
	<?php include ('allfoot.php'); ?>