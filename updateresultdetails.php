<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
	header('Location: facultylogin.php'); // Corrected the redirection URL
	exit();
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];
?>
<?php include ('fhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>

		<div class="col-md-6">
			<h3>Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo $fname; ?></span></a></h3>

			<?php
			include ('database.php');
			$editid = $_GET['editid'];
			// Prepare and execute query
			$stmt = $pdo->prepare("SELECT * FROM result WHERE RsID = :editid");
			$stmt->bindParam(':editid', $editid);
			$stmt->execute();

			while ($row = $stmt->fetch()) {
				?>
				<form action="" method="POST" name="update">
					<fieldset>
						<legend>Update Result Details</legend>
						<div class="form-group">
							Result ID: <?php echo $row['RsID']; ?>
						</div>
						<div class="form-group">
							Enrolment Number: <?php echo $row['Eno']; ?>
						</div>
						<div class="form-group">
							Marks:
							<select class="form-control" name="marks" required>
								<option value="<?php echo $row['Marks']; ?>"><?php echo $row['Marks']; ?> (Current Result)
								</option>
								<option value="Pass">Pass</option>
								<option value="Fail">Fail</option>
								<option value="Under Progress">Under Progress</option>
							</select>
						</div>
						<div class="form-group">
							<input type="submit" value="Update Result" name="update" class="btn btn-success"
								style="border-radius:0%">
						</div>
					</fieldset>
				</form>
				<?php
			}
			?>

			<?php
			if (isset($_POST['update'])) {
				$tempmarks = $_POST['marks'];
				// Prepare and execute update statement
				$stmt = $pdo->prepare("UPDATE result SET Marks=:marks WHERE RsID=:editid");
				$stmt->bindParam(':marks', $tempmarks);
				$stmt->bindParam(':editid', $editid);
				if ($stmt->execute()) {
					echo "<div class='alert alert-success fade in'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Success!</strong> Result has been updated.
                          </div>";
				} else {
					// Print error if update fails
					echo "<br><strong>Result Updation Failure. Try Again</strong><br>";
				}
			}
			?>
		</div>

		<div class="col-md-3"></div>

	</div>
	<?php include ('allfoot.php'); ?>