<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
	header('Location: facultylogin.php'); // Corrected the redirection URL
	exit(); // Added exit after header redirection to stop further execution
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];

include ('database.php'); // Assuming database.php contains PDO connection

?>
<?php include ('fhead.php'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>

		<div class="col-md-8">

			<h3> Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo htmlspecialchars($fname); ?></span></a> </h3>

			<?php
			$make = $_GET['makeid'];
			// Selecting data from result table from database using PDO
			$sql = "SELECT * FROM examans WHERE AssignId=:makeid";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':makeid', $make, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row) {
				?>
				<fieldset>
					<legend>Make Result</legend>
					<form action="" method="POST" name="makeresult">
						<table class="table table-hover">

							<tr>
								<td><strong>Enrolment number </strong>
								</td>
								<td>
									<?php echo htmlspecialchars($row['Senrl']); ?>
								</td>

							</tr>
							<tr>
								<td><strong>Name </strong> </td>
								<td>
									<?php echo htmlspecialchars($row['Sname']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Assignment ID:</strong> </td>
								<td>
									<?php echo htmlspecialchars($row['AssignId']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Marks</strong> </td>
								<td>
									<select class="form-control" name="marks" required>
										<option value="">---Select---</option>
										<option value="Pass">Pass</option>
										<option value="Fail">Fail</option>
										<option value="Under Progress">Under Progress</option>
									</select>
								</td>
							</tr>
							<td><button type="submit" name="make" class="btn btn-success"
									style="border-radius:0%">Publish</button>
							</td>
						</table>
					</form>
				</fieldset>
				<?php
			}
			?>

			<?php
			if (isset($_POST['make'])) {
				$mark = $_POST['marks'];

				// Inserting result using PDO prepared statement
				$sql = "INSERT INTO `result`(`Eno`, `Ex_ID`, `Marks`) VALUES (?, ?, ?)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([$row['Senrl'], $row['AssignId'], $mark]);

				echo "
                    <br><br>
                    <div class='alert alert-success fade in'>
                    <a href='ResultDetails.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Success!</strong> Result Updated.
                    </div>
                ";
			}
			?>
		</div>

		<div class="col-md-2"></div>
	</div>
	<?php include ('allfoot.php'); ?>