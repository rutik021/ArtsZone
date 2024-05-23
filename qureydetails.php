<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
	header('Location: facultylogin.php');
	exit();
}
$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];
?>
<?php include ('fhead.php'); ?>
<div class="container">
	<div class="row">
		<?php
		if (isset($_REQUEST['deleteid'])) {
			include ("database.php");
			$deleteid = $_GET['deleteid'];
			$sql = "DELETE FROM `query` WHERE Qid = :qid";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':qid', $deleteid, PDO::PARAM_INT);
			if ($stmt->execute()) {
				echo "
                    <br><br>
                    <div class='alert alert-success fade in'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Success!</strong> Query Details has been deleted.
                    </div>";
			} else {
				echo "<br><Strong>Query Details Updation Faliure. Try Again</strong><br> Error Details: " . $sql . "<br>" . $stmt->errorInfo()[2];
			}
		}
		?>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3> Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo $fname; ?></span></a> </h3>
			<?php
			include ("database.php");
			$sql = "SELECT * FROM query";
			$stmt = $pdo->query($sql);
			//below table will display all query posted by student or guest to faculty
			echo "<h3 class='page-header'>Query Details</h3>";
			echo "<table class='table table-striped table-hover' style='width:100%'>
                <tr>
                    <th>#</th>
                    <th>Student's Email</th>
                    <th>Query</th>
                    <th>Answer</th>
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
						<?php echo htmlspecialchars($row['Eid']); ?>
					</td>
					<td>
						<?php echo htmlspecialchars($row['Query']); ?>
					</td>
					<td>
						<?php echo htmlspecialchars($row['Ans']); ?>
					</td>
					<td><a href="updatequery.php?gid=<?php echo htmlspecialchars($row['Qid']); ?>"><input type="button"
								Value="view" class="btn btn-success btn-sm" style="border-radius:0%"></a>
						<a href="qureydetails.php?deleteid=<?php echo htmlspecialchars($row['Qid']); ?>"><input
								type="button" Value="Delete" name="" class="btn btn-danger btn-sm"
								style="border-radius:0%"></a>
					</td>
				</tr>
				<?php $count++;
			} ?>
			</table>
		</div>
	</div>
	<?php include ('allfoot.php'); ?>