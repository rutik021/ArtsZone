<?php
session_start();

if ($_SESSION["umail"] == "" || $_SESSION["umail"] == NULL) {
	header('Location: AdminLogin.php');
	exit; // Ensure script stops after redirection
}

$userid = $_SESSION["umail"];

include ('adminhead.php');

?>

<div class="container">
	<div class="row">
		<?php
		include ("database.php");

		if (isset($_REQUEST['deleteid'])) {
			$deleteid = $_GET['deleteid'];
			$sql = "DELETE FROM `facutlytable` WHERE FID = ?";
			$stmt = $pdo->prepare($sql);
			if ($stmt->execute([$deleteid])) {
				echo "
                    <br><br>
                    <div class='alert alert-success fade in'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Success!</strong> Faculty Details has been deleted.
                    </div>";
			} else {
				// Error message if SQL query fails
				echo "<br><Strong>Faculty Details Updation Failure. Try Again</strong><br>";
			}
		}
		?>
	</div>


	<div class="row">
		<div class="col-md-12">
			<h3 class="page-header">Welcome <a href="welcomeadmin">Admin</a> </h3>
			<a href="addnewfaculty"><button type="button" value="Add New Faculty" class="btn btn-success btn-sm"
					style="border-radius:0%">Add New Faculty</button></a>
			<?php
			$sql = "SELECT * FROM facutlytable";
			$stmt = $pdo->query($sql);
			echo "<h3 class='page-header' >Faculty Details</h3>";
			echo "<table class='table table-striped table-hover' style='width:100%'>
                <tr>
                    <th>#</th>
                    <th>FullName</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Joining Date</th>
                    <th>City</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                <tr>";
			$count = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>

				<tr>
					<td>
						<?php echo $count; ?>
					</td>
					<td>
						<?php echo $row['FName']; ?>
					</td>
					<td>
						<?php echo $row['FaName']; ?>
					</td>
					<td>
						<?php echo $row['Addrs']; ?>
					</td>
					<td>
						<?php echo $row['Gender']; ?>
					</td>
					<td>
						<?php echo $row['JDate']; ?>
					</td>
					<td>
						<?php echo $row['City']; ?>
					</td>
					<td>
						<?php echo $row['PhNo']; ?>
					</td>

					<td><a href="updatefaculty.php?fid=<?php echo $row['FID']; ?>"><input type="button" Value="Edit"
								style="border-radius:0%" class="btn btn-success btn-sm"></a>
						<a href="facultydetails.php?deleteid=<?php echo $row['FID']; ?>"><input type="button" Value="Delete"
								style="border-radius:0%" class="btn btn-danger btn-sm"></a>
					</td>
				</tr>
				<?php $count++;
			} ?>
			</table>


		</div>
	</div>

	<?php include ('allfoot.php'); ?>