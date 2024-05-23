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
		<div class="col-md-12">
			<h3> Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo htmlspecialchars($fname); ?></span></a> </h3>

			<?php
			include ("database.php");

			if (isset($_REQUEST['deleteid'])) {
				$deleteid = $_GET['deleteid'];
				$sql = "DELETE FROM `video` WHERE V_id = :deleteid";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':deleteid', $deleteid, PDO::PARAM_INT);
				if ($stmt->execute()) {
					echo "
                        <br><br>
                        <div class='alert alert-success fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success!</strong> Videos details deleted.
                        </div>
                    ";
				} else {
					// Error message if SQL query fails
					echo "<br><strong>Videos Details Updation Failure. Try Again</strong><br>";
				}
			}

			$sql = "SELECT * FROM video";
			$stmt = $pdo->query($sql);

			echo "<h2 class='page-header'>Videos Details</h2>";
			echo "<table class='table table-striped' style='width:100%'>
                <tr>
                    <th>#</th>
                    <th>Video Title</th>
                    <th>Video URL</th>
                    <th>Description</th>
                    <th>Actions</th>		
                </tr>";

			$count = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<tr>
					<td><?php echo $count; ?></td>
					<td><?php echo htmlspecialchars($row['V_Title']); ?></td>
					<td><?php echo htmlspecialchars($row['V_Url']); ?></td>
					<td><?php echo htmlspecialchars($row['V_Remarks']); ?></td>
					<td>
						<a href="managevideos.php?deleteid=<?php echo $row['V_id']; ?>">
							<input type="button" Value="Delete" class="btn btn-danger btn-sm" style="border-radius:0%"
								data-toggle="modal" data-target="#myModal">
						</a>
						<a href="managevideos2.php?editassid=<?php echo $row['V_id']; ?>">
							<input type="button" Value="Edit" class="btn btn-success btn-sm" style="border-radius:0%"
								data-toggle="modal" data-target="#myModal">
						</a>
					</td>
				</tr>
				<?php
				$count++;
			}
			?>
			</table>
		</div>
	</div>
	<?php include ('allfoot.php'); ?>