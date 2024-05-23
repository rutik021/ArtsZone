<?php
session_start();

if ($_SESSION["sidx"] == "" || $_SESSION["sidx"] == NULL) {
	header('Location: studentlogin');
	exit; // Add exit to prevent further execution
}

$userid = $_SESSION["sidx"];
$userfname = $_SESSION["fname"];
$userlname = $_SESSION["lname"];
?>
<?php include ('studenthead.php'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>

		<div class="col-md-8">
			<h3> Welcome <a
					href="welcomestudent.php"><?php echo "<span style='color:red'>" . $userfname . " " . $userlname . "</span>"; ?></a>
			</h3>
			<?php

			include ('database.php');

			// Query to retrieve assessment details
			$sql = "SELECT * FROM examdetails";
			$stmt = $pdo->query($sql);
			echo "<h2 class='page-header'>Take Assessment</h2>";
			echo "<table class='table table-striped table-hover' style='width:100%'>
            <tr>
            <th>#</th>
            <th>Assessment Name</th>
            <th>Due Date</th> <!-- Add Due Date column -->
            <th>Action</th>                    
            </tr>";
			$count = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<tr>
					<td><?php echo $count; ?></td>
					<td><?php echo $row['AssignmentName']; ?></td>
					<td><?php echo $row['duedate']; ?></td> <!-- Display Due Date -->
					<td>
						<a
							href="takeassessment2.php?exid=<?php echo $row['AssignId']; ?>&folder=<?php echo $row['folder']; ?>">
							<button type="submit" class="btn btn-success" style="border-radius:0%">Start</button>
						</a>
					</td>
				</tr>
				<?php
				$count++;
			}
			?>
			</table>

		</div>

		<div class="col-md-2"></div>
	</div>
	<?php include ('allfoot.php'); ?>