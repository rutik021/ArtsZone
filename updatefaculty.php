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
		<div class="col-md-3"></div>

		<div class="col-md-6">
			<h3 class="page-header">Welcome <a href="welcomeadmin">Admin</a> </h3>
			<?php
			include ("database.php");
			$new2 = $_GET['fid'];

			$sql = "SELECT * FROM facutlytable WHERE FID = :fid";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':fid', $new2, PDO::PARAM_INT);
			$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<form action="" method="POST" name="update">
					<div class="form-group">
						Faculty ID : <?php echo $row['FID']; ?>
					</div>
					<div class="form-group">
						Faculty Name : <input type="text" name="fname" class="form-control"
							value="<?php echo $row['FName']; ?>">
					</div>
					<div class="form-group">
						Last Name : <input type="text" name="faname" class="form-control"
							value="<?PHP echo $row['FaName']; ?>"><br>
					</div>
					<div class="form-group">
						Address : <input type="text" name="addrs" class="form-control" rows="5" cols="40"
							value="<?PHP echo $row['Addrs']; ?>"><br>
					</div>
					<div class="form-group">
						Gender : <input type="text" name="gender" class="form-control"
							value="<?PHP echo $row['Gender']; ?>"><br>
					</div>
					<div class="form-group">
						Phone Number : <input type="tel" name="phno" class="form-control"
							value="<?PHP echo $row['PhNo']; ?>" maxlength="10"><br>
					</div>
					<div class="form-group">
						Joining Date : <input type="date" name="jdate" class="form-control"
							value="<?PHP echo $row['JDate']; ?>" readonly> <br>
					</div>
					<div class="form-group">
						City : <input type="text" name="city" class="form-control" value="<?PHP echo $row['City']; ?>"><br>
					</div>
					<div class="form-group">
						Password : <input type="text" name="pass" class="form-control" value="<?PHP echo $row['Pass']; ?>"
							maxlength="10"><br>
					</div><br>
					<div class="form-group">
						<input type="submit" value="Make Changes" name="update" class="btn btn-success"
							style="border-radius:0%">
					</div>
				</form>
				<?php
			}
			?>

			<?php
			if (isset($_POST['update'])) {
				$tempfname = $_POST['fname'];
				$tempfaname = $_POST['faname'];
				$tempaddrs = $_POST['addrs'];
				$tempgender = $_POST['gender'];
				$tempphno = $_POST['phno'];
				$tempcity = $_POST['city'];
				$temppass = $_POST['pass'];

				$sql = "UPDATE facutlytable SET FName=:fname, FaName=:faname, Addrs=:addrs, Gender=:gender, City=:city, Pass=:pass, PhNo=:phno WHERE FID=:fid";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':fname', $tempfname);
				$stmt->bindParam(':faname', $tempfaname);
				$stmt->bindParam(':addrs', $tempaddrs);
				$stmt->bindParam(':gender', $tempgender);
				$stmt->bindParam(':phno', $tempphno);
				$stmt->bindParam(':city', $tempcity);
				$stmt->bindParam(':pass', $temppass);
				$stmt->bindParam(':fid', $new2, PDO::PARAM_INT);
				if ($stmt->execute()) {
					echo "
                    <br><br>
                    <div class='alert alert-success fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success!</strong> Faculty Details updated has been deleted.
                    </div>";
				} else {
					echo "<br><Strong>Faculty Details Updating Faliure. Try Again</strong><br>";
				}
			}
			?>
		</div>

		<div class="col-md-3"></div>
	</div>
</div>

<?php include ('allfoot.php'); ?>