<?php
session_start();

if (!isset($_SESSION["fidx"]) || empty($_SESSION["fidx"])) {
	header('Location: facultylogin.php');
	exit(); // Add exit after header redirection to stop further execution
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];

include ('database.php'); // Assuming database.php contains PDO connection

?>
<?php include ('fhead.php'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3> Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo htmlspecialchars($fname); ?></span></a> </h3>

			<?php
			if (isset($_GET['editassid'])) {
				$make = $_GET['editassid'];
				$sql = "SELECT * FROM examdetails WHERE AssignId=:make";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':make', $make, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($row) {
					?>
					<fieldset>
						<legend><a href="manageassessment.php">All Assessments</a></legend>
						<form action="" method="POST" name="UpdateAssessment">
							<table class="table table-hover">
								<tr>
									<td><strong>Exam ID</strong></td>
									<td><?php echo htmlspecialchars($row['AssignId']); ?></td>
								</tr>
								<tr>
									<td><strong>Exam Name</strong></td>
									<td><textarea name="AssignmentName" class="form-control" rows="1"
											cols="50"><?php echo htmlspecialchars($row['AssignmentName']); ?></textarea></td>
								</tr>
								<tr>
									<td><strong>Description</strong></td>
									<td><textarea name="Description" class="form-control" rows="3"
											cols="50"><?php echo htmlspecialchars($row['description']); ?></textarea></td>
								</tr>
								<tr>
									<td><strong>Folder</strong></td>
									<td><textarea name="Folder" class="form-control" rows="1"
											cols="50"><?php echo htmlspecialchars($row['folder']); ?></textarea></td>
								</tr>
								<tr>
									<td><strong>Due Date</strong></td>
									<td><input type="date" name="DueDate" class="form-control"
											value="<?php echo htmlspecialchars($row['duedate']); ?>"></td>
								</tr>
								<td><button type="submit" name="update" class="btn btn-success"
										style="border-radius:0%">Update</button></td>
							</table>
						</form>
					</fieldset>
					<?php
				}
			}

			if (isset($_POST['update'])) {
				$E_name = $_POST['AssignmentName'];
				$Description = $_POST['Description'];
				$Folder = $_POST['Folder'];
				$DueDate = $_POST['DueDate'];

				$sql = "UPDATE `examdetails` SET AssignmentName=:E_name, description=:Description, folder=:Folder, duedate=:DueDate WHERE AssignId=:make";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':E_name', $E_name, PDO::PARAM_STR);
				$stmt->bindParam(':Description', $Description, PDO::PARAM_STR);
				$stmt->bindParam(':Folder', $Folder, PDO::PARAM_STR);
				$stmt->bindParam(':DueDate', $DueDate, PDO::PARAM_STR);
				$stmt->bindParam(':make', $make, PDO::PARAM_INT);

				if ($stmt->execute()) {
					echo "
                    <br><br>
                    <div class='alert alert-success fade in'>
                    <a href='manageassessment.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Success!</strong> Assessment Updated.
                    </div>
                    ";
				} else {
					// Error message if SQL query fails
					echo "<br><Strong>Assessment Updation Failure. Try Again</strong><br>";
				}
			}
			?>
		</div>
	</div>
	<?php include ('allfoot.php'); ?>