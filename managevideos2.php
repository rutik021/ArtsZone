<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
	header('Location: facultylogin.php');
	exit();
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
						<?php echo $fname; ?></span></a> </h3>

			<?php
			include ('database.php');

			if (isset($_GET['editassid'])) {
				$make = $_GET['editassid'];
				$sql = "SELECT * FROM video WHERE V_id=:id";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':id', $make, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				?>
				<fieldset>
					<legend><a href="managevideos.php">Update Videos</a></legend>
					<form action="" method="POST" name="UpdateVideo">
						<table class="table table-hover">

							<tr>
								<td><strong>Video ID</strong></td>
								<td><?php echo htmlspecialchars($row['V_id']); ?></td>
							</tr>
							<tr>
								<td><strong>Video Title</strong></td>
								<td><textarea name="V_Title" rows="1" cols="50"
										class="form-control"><?php echo htmlspecialchars($row['V_Title']); ?></textarea>
								</td>
							</tr>
							<tr>
								<td><strong>Video URL</strong></td>
								<td><textarea name="V_Url" rows="5" cols="150"
										class="form-control"><?php echo htmlspecialchars($row['V_Url']); ?></textarea></td>
							</tr>
							<tr>
								<td><strong>Video Description</strong></td>
								<td><textarea name="V_Remarks" rows="5" cols="150"
										class="form-control"><?php echo htmlspecialchars($row['V_Remarks']); ?></textarea>
								</td>
							</tr>
							<td><button type="submit" name="update" class="btn btn-success"
									style="border-radius:0%">Update</button></td>
						</table>
					</form>
				</fieldset>
				<?php
			}
			?>
			<?php
			if (isset($_POST['update'])) {
				$V_Title = $_POST['V_Title'];
				$V_Url = $_POST['V_Url'];
				$V_Remarks = $_POST['V_Remarks'];

				$sql = "UPDATE `video` SET V_Title=:V_Title, V_Url=:V_Url, V_Remarks=:V_Remarks WHERE V_id=:id";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':V_Title', $V_Title, PDO::PARAM_STR);
				$stmt->bindParam(':V_Url', $V_Url, PDO::PARAM_STR);
				$stmt->bindParam(':V_Remarks', $V_Remarks, PDO::PARAM_STR);
				$stmt->bindParam(':id', $make, PDO::PARAM_INT);

				if ($stmt->execute()) {
					echo "
                                <br><br>
                                <div class='alert alert-success fade in'>
                                <a href='managevideos.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <strong>Success!</strong> Videos Updated.
                                </div>
                                ";
				} else {
					//error message if SQL query fails
					echo "<br><Strong>Video Updation Faliure. Try Again</strong><br>";
				}
			}
			?>
		</div>
	</div>
	<?php include ('allfoot.php'); ?>