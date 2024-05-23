<?php
session_start();

if ($_SESSION["umail"] == "" || $_SESSION["umail"] == NULL) {
	header('Location: AdminLogin.php');
	exit();
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
			$new3 = $_GET['eno'];
			// Prepare and execute query
			$stmt = $pdo->prepare("SELECT * FROM studenttable WHERE Eno = :eno");
			$stmt->bindParam(':eno', $new3);
			$stmt->execute();

			while ($row = $stmt->fetch()) {
				?>
				<form action="" method="POST" name="update">
					<div class="form-group">
						Enrolment number : <?php echo $row['Eno']; ?>
					</div>
					<div class="form-group">
						First Name : <input type="text" name="fname" class="form-control"
							value="<?php echo $row['FName']; ?>">
					</div>
					<div class="form-group">
						Last Name : <input type="text" name="lname" class="form-control"
							value="<?php echo $row['LName']; ?>"><br>
					</div>
					<div class="form-group">
						Father Name : <input type="text" name="faname" class="form-control"
							value="<?PHP echo $row['FaName']; ?>"><br>
					</div>
					<div class="form-group">
						Addres : <input type="text" name="addrs" class="form-control"
							value="<?PHP echo $row['Addrs']; ?>"><br>
					</div>
					<div class="form-group">
						Gender : <input type="text" name="gender" class="form-control"
							value="<?PHP echo $row['Gender']; ?>"><br>
					</div>
					<div class="form-group">
						Course : <input type="text" name="course" class="form-control"
							value="<?PHP echo $row['Course']; ?>"><br>
					</div>
					<div class="form-group">
						D.O.B. : <input type="text" name="DOB" class="form-control" value="<?PHP echo $row['DOB']; ?>"
							readonly><br>
					</div>
					<div class="form-group">
						Phone Number : <input type="text" name="phno" class="form-control"
							value="<?PHP echo $row['PhNo']; ?>" maxlength="10"><br>
					</div>
					<div class="form-group">
						Email : <input type="text" name="email" class="form-control" value="<?PHP echo $row['Eid']; ?>"
							readonly><br>
					</div>
					<div class="form-group">
						Password : <input type="text" name="pass" class="form-control"
							value="<?PHP echo $row['Pass']; ?>"><br>
					</div><br>
					<div class="form-group">
						<input type="submit" value="Update" name="update" style="border-radius:0%" class="btn btn-success">
					</div>
				</form>
				<?php
			}
			?>

			<?php

			if (isset($_POST['update'])) {
				$tempfname = $_POST['fname'];
				$templname = $_POST['lname'];
				$tempfaname = $_POST['faname'];
				$tempaddrs = $_POST['addrs'];
				$tempgender = $_POST['gender'];
				$tempcourse = $_POST['course'];
				$tempphno = $_POST['phno'];
				$tempeid = $_POST['email'];
				$temppass = $_POST['pass'];
				// Prepare and execute update statement
				$stmt = $pdo->prepare("UPDATE studenttable SET FName=?, LName=?, FaName=?, Gender=?, Course=?, Addrs=?, PhNo=?, Eid=?, Pass=? WHERE Eno=?");
				$stmt->execute([$tempfname, $templname, $tempfaname, $tempgender, $tempcourse, $tempaddrs, $tempphno, $tempeid, $temppass, $new3]);

				if ($stmt->rowCount() > 0) {
					echo "<br><br>
                        <div class='alert alert-success fade in'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Success!</strong> Student Details has been updated.
                        </div>";
				} else {
					//below statement will print error if SQL query fail.
					echo "<br><Strong>Student Updation Failure. Try Again</strong><br>";
				}
			}
			?>
		</div>

		<div class="col-md-3"></div>
	</div>
	<?php include ('allfoot.php'); ?>