<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
	header('Location: facultylogin');
	exit; // Add exit to prevent further execution
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];
?>
<?php include ('fhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h3> Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo $fname; ?></span></a> </h3>
			<?php
			include ('database.php');
			if (isset($_POST['submit'])) {
				$Aname = $_POST['AssessmentName'];
				$description = $_POST['description'];
				$folder = $_POST['folder'];
				$duedate = $_POST['duedate']; // Retrieve due date from the form
			
				$done = "<center>
                                <div class='alert alert-success fade in __web-inspector-hide-shortcut__'' style='margin-top:10px;'>
                                    <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
                                    <strong><h3 style='margin-top: 10px; margin-bottom: 10px;'> Assessment added Successfully.</h3></strong>
                                </div>
                            </center>";

				$sql = "INSERT INTO ExamDetails (AssignmentName, description, folder, duedate) VALUES (:Aname, :description, :folder, :duedate)";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':Aname', $Aname);
				$stmt->bindParam(':description', $description);
				$stmt->bindParam(':folder', $folder);
				$stmt->bindParam(':duedate', $duedate); // Bind due date parameter
				$stmt->execute();

				echo $done;
			}
			?>
			<fieldset>
				<legend><a href="addassessment.php">Add Assessment</a></legend>
				<form action="" method="POST" name="AddAssessment">
					<table class="table table-hover">
						<tr>
							<td><strong>Assessment Name </strong></td>
							<td><input type="text" name="AssessmentName"></td>
						</tr>
						<tr>
							<td><strong>Description </strong></td>
							<td><textarea name="description" rows="5" cols="50"></textarea></td>
						</tr>
						<tr>
							<td><strong>Folder </strong></td>
							<td><input type="text" name="folder"></td>
						</tr>
						<tr>
							<td><strong>Date of Submission </strong></td>
							<td><input type="date" name="duedate"></td> <!-- Add input field for due date -->
						</tr>
						<tr>
							<td><button type="submit" name="submit" class="btn btn-success" style="border-radius:0%">Add
									Assessment</button></td>
						</tr>
					</table>
				</form>
			</fieldset>
		</div>
	</div>
	<?php include ('allfoot.php'); ?>