<style>
	.bg-yellowish {
		background-color: #fff3cd;
		/* Slightly yellowish background color */
		border-radius: 10px;
		/* Rounded corners */
		padding: 20px;
		/* Add padding for spacing */
		margin-bottom: 20px;
		/* Add margin for separation */
	}

	.btn-rounded {
		border-radius: 5px;
		/* Rounded corners for buttons */
	}

	legend {
		font-size: 1.2em;
		/* Larger font size for legend */
		font-weight: bold;
		/* Bold font weight */
		color: #333;
		/* Dark text color */
		margin-bottom: 15px;
		/* Add margin for separation */
	}
</style>

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
		<div class="col-md-2"></div>
		<div class="col-md-8">

			<h3> Welcome <a href="welcomefaculty.php"><span style="color:#FF0004">
						<?php echo $fname; ?></span></a></h3>
			<?php
			include ('database.php');
			$varid = $_REQUEST['myfid'];
			//selecting data from faculty table
			$sql = "SELECT * FROM facutlytable WHERE FID=:fid";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':fid', $varid, PDO::PARAM_STR);
			$stmt->execute();
			//loop below will print details of faculty
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<fieldset class="bg-yellowish"> <!-- Apply the yellowish background to this fieldset -->
					<center>
						<legend>My Details</legend>
					</center>




					<form action="" method="POST" name="update">
						<table class="table table-hover">

							<tr>
								<td><strong>ID : </strong>
								</td>
								<td>
									<?php echo htmlspecialchars($row['FID']); ?>
								</td>

							</tr>
							<tr>
								<td><strong>Name :</strong> </td>
								<td>
									<?php echo htmlspecialchars($row['FName']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Last Name :</strong> </td>
								<td>
									<?php echo htmlspecialchars($row['FaName']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Address : </strong>
								</td>
								<td>
									<?php echo htmlspecialchars($row['Addrs']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Gender :</strong>
								</td>
								<td>
									<?php echo htmlspecialchars($row['Gender']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Data Of Joining :</strong>
								</td>
								<td>
									<?php echo htmlspecialchars($row['JDate']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>City : </strong>
								</td>
								<td>
									<?php echo htmlspecialchars($row['City']); ?>
								</td>
							</tr>
							<tr>
								<td><strong>Phone Number :</strong>
								</td>
								<td>
									<?php echo htmlspecialchars($row['PhNo']); ?>
								</td>
							</tr>

							<tr>
								<td><a
										href="updatedetailsfromfaculty.php?myfid=<?php echo htmlspecialchars($row['FID']); ?>"><input
											type="button" Value="Edit" class="btn btn-info btn-rounded"></a>
								</td>

							</tr>
						</table>
					</form>
				</fieldset>
				<?php
			}
			?>
		</div>

		<div class="col-md-2"></div>
	</div>
	<?php include ('allfoot.php'); ?>