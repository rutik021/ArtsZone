<?php
session_start();

if ($_SESSION["sidx"] == "" || $_SESSION["sidx"] == NULL) {
	header('Location:studentlogin');
	exit; // Ensure script stops after redirection
}

$userid = $_SESSION["sidx"];
$userfname = $_SESSION["fname"];
$userlname = $_SESSION["lname"];

include ('studenthead.php');

$eid = $_GET['eid']; // Get data from another page

?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>

		<div class="col-md-8">
			<h3> Welcome <a href="welcomestudent.php"><span
						style='color:red'><?php echo $userfname . " " . $userlname; ?></span></a> </h3>

			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<form action="" method="POST" name="update">
							<fieldset>
								<legend>Query Details</legend>
								<table>
									<td>
										<h3>
											<tr><strong>Email ID :</strong> </tr>
											<tr>
												<strong><?php echo $eid; ?></strong>
											</tr>
										</h3>
									</td>
									<table>
									</table>
									<td>
										<tr><strong>
												<h3>Query :</h3>
											</strong> </tr><br <tr><textarea rows="10" cols="40" name="squeryx"
											class="form-control" required></textarea>
										</tr>
									</td>
								</table>
								<br>
								<input type="submit" value="Submit My Query" name="addq" style="border-radius:0%"
									class="btn btn-success">
							</fieldset>
						</form>
					</div>
				</div>
			</div>

			<?php
			include ('database.php'); // Include database connection
			
			if (isset($_POST['addq'])) {
				// Fetch data from table 
				$tempsquery = $_POST['squeryx'];
				$tempseid = $eid;

				// Prepare the SQL statement
				$sql = "INSERT INTO query (Query, Eid) VALUES (?, ?)";

				// Prepare and execute the statement
				$stmt = $pdo->prepare($sql);
				$stmt->execute([$tempsquery, $tempseid]);

				if ($stmt) {
					echo "<br><br><br>
                    <div class='alert alert-success fade in'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Success!</strong> Your Query Added Successfully. Ref. No: " . $pdo->lastInsertId() . "
                    </div>";
				} else {
					// Error message if SQL query fails
					echo "<br><Strong>Query Adding Failure. Try Again</strong><br>";
				}
			}
			?>
		</div>

		<div class="col-md-2"></div>
	</div>
</div>

<?php include ('allfoot.php'); ?>