<?php
session_start();

if ($_SESSION["umail"] == "" || $_SESSION["umail"] == NULL) {
	header('Location: AdminLogin.php');
	exit(); // End script execution after redirection
}

$userid = $_SESSION["umail"];
?>

<?php include ('adminhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h3 class="page-header">Welcome <a href="welcomeadmin">Admin</a> </h3>
			<?php
			include ("database.php");
			$new2 = $_GET['gid'];

			$sql = "SELECT * FROM guest WHERE GuEid = :gueid";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':gueid', $new2);
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<form action="" method="POST" name="update">
					<div class="form-group">
						Guest Email ID : <?php echo $row['GuEid']; ?>
					</div>
					<div class="form-group">
						Guest Name : <input type="text" name="gname" class="form-control"
							value="<?php echo $row['Gname']; ?>">
					</div>
					<div class="form-group">
						<input type="submit" value="Update" name="update" style="border-radius:0%" class="btn btn-success">
					</div>
				</form>
				<?php
			}
			?>
			<?php
			if (isset($_POST['update'])) {
				$tempgname = $_POST['gname'];

				$sql = "UPDATE guest SET Gname = :gname WHERE GuEid = :gueid";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':gname', $tempgname);
				$stmt->bindParam(':gueid', $new2);

				if ($stmt->execute()) {
					echo "<br><br><div class='alert alert-success fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success!</strong> Guest updated has been deleted.
                        </div>";
				} else {
					echo "<br><Strong>Guest Details Updating Failure. Try Again</strong><br>";
				}
			}
			?>
		</div>
	</div>
</div>

<?php include ('allfoot.php'); ?>