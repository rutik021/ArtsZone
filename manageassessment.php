<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
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
			if (isset($_GET['deleteid'])) {
				$deleteid = $_GET['deleteid'];
				$sql = "DELETE FROM `examdetails` WHERE AssignId = :deleteid";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':deleteid', $deleteid, PDO::PARAM_INT);
				if ($stmt->execute()) {
					echo "
                        <br><br>
                        <div class='alert alert-success fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success!</strong> Assessment details deleted.
                        </div>
                        ";
				} else {
					// Error message if SQL query fails
					echo "<br><Strong>Assessment Details Updation Failure. Try Again</strong><br>";
				}
			}

			$sql = "SELECT * FROM examdetails";
			$stmt = $pdo->query($sql);
			echo "<h2 class='page-header'>Assessment Details</h2>";
			echo "<table class='table table-striped table-hover' style='width:100%'>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Due Date</th>
                    <th>Description</th>
                    <th>Actions</th>      
                </tr>";
			$cnt = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<tr>
					<td><?php echo $cnt; ?></td>
					<td><?php echo htmlspecialchars($row['AssignmentName']); ?></td>
					<td><?php echo htmlspecialchars($row['duedate']); ?></td> <!-- Display Due Date -->
					<td><?php echo htmlspecialchars($row['description']); ?></td>

					<td>
						<a href="manageassessment.php?deleteid=<?php echo $row['AssignId']; ?>">
							<input type="button" value="Delete" class="btn btn-danger btn-sm" style="border-radius:0%"
								data-toggle="modal" data-target="#myModal">
						</a>
						<a href="manageassessment2.php?editassid=<?php echo $row['AssignId']; ?>">
							<input type="button" value="Edit" class="btn btn-success btn-sm" style="border-radius:0%"
								data-toggle="modal" data-target="#myModal">
						</a>
					</td>
				</tr>
				<?php
				$cnt++;
			}
			?>
			</table>
		</div>
	</div>
	<?php include ('allfoot.php'); ?>