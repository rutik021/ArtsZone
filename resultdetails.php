<?php include ('fhead.php'); ?>

<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
	header('Location: facultylogin.php');
	exit(); // End script execution after redirection
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];

include ("database.php");

if (isset($_REQUEST['deleteid'])) {
	$deleteid = $_GET['deleteid'];
	// Prepare and execute DELETE query to delete result details from the result table
	$sql = "DELETE FROM result WHERE RsID = :deleteid";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':deleteid', $deleteid, PDO::PARAM_INT);
	if ($stmt->execute()) {
		echo "<br><br>
                <div class='alert alert-success fade in'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Success!</strong> Result details deleted.
                </div>";
	} else {
		// Error message if PDO query fails
		echo "<br><strong>Result Details Deletion Failure. Try Again</strong><br>";
	}
}

$sql = "SELECT result.*, studenttable.FName FROM result LEFT JOIN studenttable ON result.Eno = studenttable.Eno";
$stmt = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Result Details</title>
	<!-- Add your CSS and JS links here -->
	<style>
		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			text-align: center;
			padding: 8px;
		}

		th {
			background-color: #f2f2f2;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		tr:hover {
			background-color: #ddd;
		}

		.divider {
			border-top: 2px solid black;
			/* Adjust the border properties as needed */
		}
	</style>
</head>

<body>
	<div class="container">
		<h2 class='page-header'>Result Details</h2>
		<table class='table table-striped table-hover' style='width:100%'>
			<tr>
				<th>Result ID</th>
				<th>Student Name</th>
				<th>Enrolment No.</th>
				<th>Result</th>
				<th>Actions</th>

			</tr>
			<tr class="divider"> <!-- Divider row -->
				<td colspan="5"></td> <!-- Empty cell spanning all columns -->
			</tr>

			<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
				<tr>
					<td><?php echo $row['RsID']; ?></td>
					<td><?php echo $row['FName']; ?></td>
					<td><?php echo $row['Eno']; ?></td>
					<td><?php
					if ($row['Marks'] == 'Pass') {
						echo '<div style="color:green;"><b>' . $row['Marks'];
					} elseif ($row['Marks'] == 'Fail') {
						echo '<div style="color:red;"><b>' . $row['Marks'];
					} else {
						echo '<b>' . $row['Marks'];
					}
					?></td>
					<td>
						<a href="updateresultdetails.php?editid=<?php echo $row['RsID']; ?>">
							<input type="button" value="Edit" class="btn btn-success btn-sm" style="border-radius:0%">
						</a>
						<a href="resultdetails.php?deleteid=<?php echo $row['RsID']; ?>">
							<input type="button" value="Delete" class="btn btn-danger btn-sm" style="border-radius:0%">
						</a>
					</td>
				</tr>
			<?php endwhile; ?>
		</table>
	</div>
</body>

</html>