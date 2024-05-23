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
			$sql = "DELETE FROM `guest` WHERE GuEid = ?";
			$stmt = $pdo->prepare($sql);
			if ($stmt->execute([$deleteid])) {
				echo "
                    <br><br>
                    <div class='alert alert-success fade in'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Success!</strong> Guest Details has been deleted.
                    </div>";
			} else {
				// Error message if SQL query fails
				echo "<br><Strong>Guest Details Updation Failure. Try Again</strong><br>";
			}
		}
		?>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h3 class="page-header">Welcome <a href="welcomeadmin">Admin</a> </h3>
			<?php
			$sql = "SELECT * FROM guest";
			$stmt = $pdo->query($sql);
			echo "<h3 class='page-header'>Guest Details</h3>";
			echo "<table class='table table-striped table-hover' style='width:100%'>
                <tr>
                    <th>#</th>
                    <th>Guest Email</th>
                    <th>Guest Name</th>
                    <th>Actions</th>
                </tr>";
			$count = 1;
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<tr>
					<td><?php echo $count ?></td>
					<td><?php echo $row['GuEid']; ?></td>
					<td><?php echo $row['Gname']; ?></td>
					<td>
						<a href="updateguest.php?gid=<?php echo $row['GuEid']; ?>"><input type="button" Value="Edit"
								style="border-radius:0%" class="btn btn-success btn-sm"></a>
						<a href="guestdetails.php?deleteid=<?php echo $row['GuEid']; ?>"><input type="button" Value="Delete"
								style="border-radius:0%" class="btn btn-danger btn-sm"></a>
					</td>
				</tr>
				<?php $count++;
			} ?>
			</table>
		</div>
	</div>
</div>
<?php include ('allfoot.php'); ?>