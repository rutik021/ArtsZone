<?php
session_start();

if ($_SESSION["fidx"] == "" || $_SESSION["fidx"] == NULL) {
	header('Location:facultylogin');
	exit; // Ensure script stops after redirection
}

$userid = $_SESSION["fidx"];
$fname = $_SESSION["fname"];

include ("database.php"); // Include database connection

if (isset($_POST['submit'])) {
	$title = $_POST['videotitle'];
	$v_url = $_POST['VideoURL'];
	$v_info = $_POST['Videoinfo'];
	$v_url = '<p><iframe width="560" height="315"  src="https://www.youtube.com/embed/' . $v_url . '" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></p>';


	$sql = "INSERT INTO Video (V_Title, V_Url, V_Remarks) VALUES (?, ?, ?)";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([$title, $v_url, $v_info]);


	echo "
        <center>
        <div class='alert alert-success fade in __web-inspector-hide-shortcut__' style='margin-top:10px;'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close' title='close'>&times;</a>
        <strong><h3 style='margin-top: 10px; margin-bottom: 10px;'> Video added Successfully.</h3></strong>
        </div>
        </center>";
}
?>

<?php include ('fhead.php'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3> Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo $fname; ?></span></a> </h3>

			<fieldset>
				<legend>Add Videos</legend>
				<form action="" method="POST" name="AddAssessment">
					<table class="table table-hover">
						<tr>
							<td><strong>Video Title </strong></td>
							<td><input type="text" class="form-control" name="videotitle"></td>
						</tr>
						<tr>
							<td><strong>Video code</strong></td>
							<td><textarea name="VideoURL" class="form-control" rows="1" cols="150"></textarea></td>
						</tr>
						<tr>
							<td><strong>Video Description</strong></td>
							<td><textarea name="Videoinfo" class="form-control" rows="5" cols="150"></textarea></td>
						</tr>
						<td><button type="submit" name="submit" class="btn btn-success" style="border-radius:0%">Add
								Video</button></td>
					</table>
				</form>
			</fieldset>
		</div>
	</div>
</div>

<?php include ('allfoot.php'); ?>