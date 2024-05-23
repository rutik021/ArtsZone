<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
	header('Location: facultylogin');
	exit; // Ensure script stops after redirection
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];

include ('fhead.php');
?>

<style>
	.bg-danger {
		background-color: #f2dede;
		/* Reddish background color */
	}
</style>

<div class="container">
	<div class="row">
		<?php
		include ("database.php");

		if (isset($_REQUEST['deleteid'])) {
			// Getting data from another page
			$deleteid = $_GET['deleteid'];
			$sql = "DELETE FROM `examans` WHERE AssignId = ?";
			$stmt = $pdo->prepare($sql);
			if ($stmt->execute([$deleteid])) {
				echo "
                        <br><br>
                        <div class='alert alert-success fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success!</strong> Exam details deleted.
                        </div>
                        ";
			} else {
				// Error message if SQL query fails
				echo "<br><Strong>Exam Details Updation Failure. Try Again</strong><br>";
			}
		}
		?>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3> Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo $fname; ?></span></a> </h3>

			<?php
			$sql = "SELECT examans.*, examdetails.duedate 
                    FROM examans 
                    INNER JOIN examdetails ON examans.AssignId = examdetails.AssignId";
			$stmt = $pdo->query($sql);
			echo "<h2 class='page-header'>Assessment Details</h2>";
			echo "<table class='table table-striped table-hover' style='width:100%'>
            <tr>
                <th>#</th>
                <th>Enrolment No.</th>
                <th>Student</th>
                <th>Submission</th>
                <th>Due Date</th>
                <th>Sub Date</th>
                <th>Action</th>        
            </tr>";
			$count = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				// Compare submission date and due date
				$subDate = strtotime($row['subdate']);
				$dueDate = strtotime($row['duedate']);
				echo (($subDate > $dueDate) ? "haa" : "naa");

				// Apply CSS class if submission date is after due date
				$rowClass = ($subDate > $dueDate) ? 'bg-danger' : '';

				?>
				<tr class="<?php echo $rowClass; ?>">
					<td>
						<?php echo $count; ?>
					</td>
					<td>
						<?php echo $row['Senrl']; ?>
					</td>
					<td>
						<?php echo $row['Sname']; ?>
					</td>
					<td>
						<a href="<?php echo $row['workdone']; ?>" target="_blank"><?php echo $row['workdone']; ?></a>
					</td>
					<td>
						<?php echo $row['duedate']; ?>
					</td>
					<td>
						<?php echo $row['subdate']; ?>
					</td>
					<td>
						<a href="examDetails.php?deleteid=<?php echo $row['AssignId']; ?>">
							<input type="button" Value="Delete" class="btn btn-danger btn-sm" style="border-radius:0%"
								data-toggle="modal" data-target="#myModal">
						</a>

						<a href="makeresult.php?makeid=<?php echo $row['AssignId']; ?>">
							<input type="button" Value="Make Result" class="btn btn-success btn-sm" style="border-radius:0%"
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