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
<!-- <?php include ('studenthead.php'); ?> -->

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 text-center">

			<h3>Welcome <a href="welcomestudent"><span
						style='color:red'><?php echo $userfname . " " . $userlname; ?></span></a></h3>
			<?php
			include ('database.php'); // Include the PDO connection script
			
			// Prepare and execute the query
			$varid = $_REQUEST['myds'];
			$sql = "SELECT * FROM studenttable WHERE Eid = :varid"; // Using a named parameter to prevent SQL injection
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':varid', $varid, PDO::PARAM_STR);
			$stmt->execute();

			// Fetch the results using PDO fetch methods
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<fieldset>
					<legend>My Details</legend>
					<form action="" method="POST" name="update">
						<table class="table table-hover greenish-table"> <!-- Added class "greenish-table" -->
							<tr>
								<td><strong>Enrolment number :</strong></td>
								<td>
									<?php echo htmlspecialchars($row['Eno']); ?>
									<!-- Use htmlspecialchars to prevent XSS -->
								</td>
							</tr>
							<tr>
								<td><strong>First Name :</strong></td>
								<td>
									<?php echo htmlspecialchars($row['FName']); ?>
									<?php echo htmlspecialchars($row['LName']); ?>

								</td>
							</tr>

							<tr>
								<td><strong>Address :</strong></td>
								<td>
									<?php echo htmlspecialchars($row['Addrs']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Course :</strong></td>
								<td>
									<?php echo htmlspecialchars($row['Course']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Date of Birth :</strong></td>
								<td>
									<?php echo htmlspecialchars($row['DOB']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Email ID :</strong></td>
								<td>
									<?php echo htmlspecialchars($row['Eid']); ?>
								</td>
							</tr>
							<!-- Other rows of data -->

						</table>
					</form>
				</fieldset>
				<?php
			}
			?>
		</div>

		<div class="col-md-2"></div>
	</div>
	<?php include ('allfoot.php'); ?>

	<style>
		/* Custom CSS for the greenish table */
		.greenish-table {
			background-color: #e6ffe6;
			/* Light green background */
			border: 1px solid #00cc66;
			/* Green border */
			border-radius: 10px;
			/* Rounded corners */
			overflow: hidden;
			/* Prevents content from overflowing rounded corners */
			border-spacing: 0 5px;
			/* Space between table rows */
		}
	</style>