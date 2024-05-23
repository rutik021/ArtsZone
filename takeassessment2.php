<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SESSION["sidx"] == "" || $_SESSION["sidx"] == NULL) {
	header('Location: studentlogin');
	exit; // Add exit to prevent further execution
}

$userid = $_SESSION["sidx"];
$userfname = $_SESSION["fname"];
$userlname = $_SESSION["lname"];
$sEno = $_SESSION["seno"];
?>

<?php include ('studenthead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
			$exid = $_GET['exid'];
			include ('database.php');

			$sql_exam_details = "SELECT * FROM examdetails WHERE AssignId = :exid";
			$stmt_exam_details = $pdo->prepare($sql_exam_details);
			$stmt_exam_details->bindValue(':exid', $exid, PDO::PARAM_INT);
			$stmt_exam_details->execute();
			$examDetails = $stmt_exam_details->fetch(PDO::FETCH_ASSOC);

			// Check if form submitted
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$workdone = $_POST['workdone'];
				$assignmentName = isset($examDetails['AssignmentName']) ? $examDetails['AssignmentName'] : "Assignment Name Not Found";

				// Get current date in "YYYY-MM-DD" format
				$currentDate = date("Y-m-d");

				$sqlInsert = "INSERT INTO examans (AssignId, Senrl, Sname, workdone, AssignmentName, subdate) 
                              VALUES (:AssignId, :Senrl, :Sname, :workdone, :AssignmentName, :subdate)";
				$stmtInsert = $pdo->prepare($sqlInsert);
				$stmtInsert->bindValue(':AssignId', $exid, PDO::PARAM_INT);
				$stmtInsert->bindValue(':Senrl', $sEno, PDO::PARAM_STR);
				$stmtInsert->bindValue(':Sname', $userfname . " " . $userlname, PDO::PARAM_STR);
				$stmtInsert->bindValue(':workdone', $workdone, PDO::PARAM_STR);
				$stmtInsert->bindValue(':AssignmentName', $assignmentName, PDO::PARAM_STR);
				$stmtInsert->bindValue(':subdate', $currentDate, PDO::PARAM_STR);

				if ($stmtInsert->execute()) {
					echo "<div class='alert alert-success'>Response submitted successfully.</div>";
				} else {
					echo "<div class='alert alert-danger'>Error: Unable to submit response.</div>";
				}
			}
			?>

			<!-- Assignment name styled as big and bold -->
			<h2 style="text-align: left; font-weight: bold; margin-bottom: 20px;">
				<?php echo isset($examDetails['AssignmentName']) ? htmlspecialchars($examDetails['AssignmentName']) : "Assignment Name Not Found"; ?>
			</h2>

			<!-- Due Date -->
			<p><strong>Due Date:</strong>
				<?php echo isset($examDetails['duedate']) ? htmlspecialchars($examDetails['duedate']) : "Due Date Not Found"; ?>
			</p>

			<!-- Divider -->
			<hr style="margin-bottom: 20px;">

			<!-- Display folder parameter as a link -->
			<p><strong>Folder:</strong> <a
					href="<?php echo isset($examDetails['folder']) ? htmlspecialchars($examDetails['folder']) : "#"; ?>"
					target="_blank"><?php echo isset($examDetails['folder']) ? htmlspecialchars($examDetails['folder']) : "Folder Not Found"; ?></a>
			</p>

			<!-- Form for submitting response -->
			<form action="" method="POST" name="update">
				<div class="form-group">
					<label for="workdone">Work Done:</label>
					<input type="text" class="form-control" id="workdone" name="workdone" required>
				</div>
				<button type="submit" name="done" class="btn btn-success" style="border-radius:0px;">Submit
					Response
				</button>
			</form>
		</div>
	</div>
</div>

<?php include ('allfoot.php'); ?>