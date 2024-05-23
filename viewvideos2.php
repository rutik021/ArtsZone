<?php
session_start();

if ($_SESSION["sidx"] == "" || $_SESSION["sidx"] == NULL) {
	header('Location: studentlogin');
	exit();
}

$userid = $_SESSION["sidx"];
$userfname = $_SESSION["fname"];
$userlname = $_SESSION["lname"];
?>

<?php include ('studenthead.php'); ?>

<div class="container">
	<div class="row">


		<div class="col-md-12">
			<h3> Welcome <a href="welcomestudent.php" <?php echo "<span style='color:red'>" . $userfname . " " . $userlname . "</span>"; ?> </a></h3>

			<?php

			include ('database.php');
			$video_id = $_GET['viewid'];
			$stmt = $pdo->prepare("SELECT * FROM video WHERE V_id=:video_id");
			$stmt->bindParam(':video_id', $video_id);
			$stmt->execute();
			$row = $stmt->fetch();
			if ($row) {
				?>
				<tr>
					<td>
						<h2>Title: <?php echo $row['V_Title']; ?></h2>
					</td>
					<br>

					<td>
						<?php echo $row['V_Url']; ?>
					</td>
					<br>
					<td>
						<p> Video Description <?php echo $row['V_Remarks']; ?> </p>
					</td>
					<br>
					<td><a href="viewvideos.php"> <input type="button" value="Back" class="btn btn-info"
								style="border-radius:0%" data-toggle="modal" data-target="#myModal"></a>
					</td>
				</tr>
				<?php
			} else {
				echo "No video found with ID: $video_id";
			}
			?>

		</div>


	</div>
	<?php include ('allfoot.php'); ?>