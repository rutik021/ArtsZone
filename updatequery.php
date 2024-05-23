<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
	header('Location: facultylogin');
	exit(); // End script execution after redirection
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];
?>
<?php include ('fhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3> Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo $fname; ?></span></a> </h3>
			<?php
			include ('database.php');
			$editid = $_GET['gid'];

			$sql = "SELECT * FROM query WHERE Qid = :qid";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':qid', $editid);
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<form action="" method="POST" name="update">
					<fieldset>
						<legend>Query Details</legend>
						<div class="form-group">
							Query ID :
							<?php echo $row['Qid']; ?>
						</div>
						<div class="form-group" style="text-decoration:underline;">
							<b>Query From :</b>
							<?php echo $row['Eid']; ?>
						</div>
						<div class="form-group">
							Query : <br>
							<textarea rows="5" class="form-control" cols="40"
								name="queryx"><?php echo $row['Query']; ?></textarea><br>
						</div>
						<div class="form-group">
							Your Answer : <br>
							<textarea rows="5" class="form-control" cols="40"
								name="ansx"><?php echo $row['Ans']; ?></textarea>
						</div>
						<div class="form-group">
							<input type="submit" value="Update" name="update" style="border-radius:0%"
								class="btn btn-success">
						</div>
					</fieldset>
				</form>
				<?php
			}
			?>
			<?php
			if (isset($_POST['update'])) {
				$tempquery = $_POST['queryx'];
				$tempans = $_POST['ansx'];

				$sql = "UPDATE query SET Query = :query, Ans = :ans WHERE Qid = :qid";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':query', $tempquery);
				$stmt->bindParam(':ans', $tempans);
				$stmt->bindParam(':qid', $editid);

				if ($stmt->execute()) {
					echo "<br>
                    <br><br>
                    <div class='alert alert-success fade in'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>Success!</strong> Query Details has been updated.
                    </div>";
				} else {
					//below statement will print error if SQL query fail.
					echo "<br><Strong>Query Details Updating Failure. Try Again</strong><br>";
				}
			}
			?>
		</div>
	</div>
	<?php include ('allfoot.php'); ?>