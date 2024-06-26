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
		<div class="col-md-2"></div>

		<div class="col-md-8">
			<h3> Welcome <a
					href="welcomestudent.php"><?php echo "<span style='color:red'>" . $userfname . " " . $userlname . "</span>"; ?></a>
			</h3>
			<?php

			include ('database.php');
			$seid = $_GET['eid'];
			// Prepare and execute query
			$stmt = $pdo->prepare("SELECT * FROM query WHERE Eid = :seid");
			$stmt->bindParam(':seid', $seid);
			$stmt->execute();

			echo "<h2 class='page-header'>Query View</h2>";
			echo "<table class='table table-striped table-hover' style='width:100%'>
                    <tr>
                        <th>#</th>
                        <th>Query</th>
                        <th>Answer</th>						
                    </tr>";
			$count = 1;
			while ($row = $stmt->fetch()) {
				?>
				<tr>
					<td>
						<?php echo $count; ?>
					</td>

					<td>
						<?php echo $row['Query']; ?>
					</td>
					<td>
						<?php echo $row['Ans']; ?>
					</td>
				</tr>
				<?php
				$count++;
			}
			?>
			</table>
			<a href="askquery.php?eid=<?php echo $userid; ?>"> <button href="" type="submit" class="btn btn-success"
					style="border-radius:0%">Ask New Query
				</button></a>
		</div>

		<div class="col-md-2"></div>
	</div>
	<?php include ('allfoot.php'); ?>