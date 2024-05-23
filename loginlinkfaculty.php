<?php
session_start();

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve form data
	$x = $_POST["fid"];
	$y = $_POST["pass"];

	// Include database connection
	include ("database.php");

	// Prepare SQL statement
	$sql = "SELECT * FROM facutlytable WHERE FID=:fid AND Pass=:pass";

	// Prepare and execute the statement
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':fid', $x);
	$stmt->bindParam(':pass', $y);
	$stmt->execute();

	// Check if there is a matching record
	if ($stmt->rowCount() > 0) {
		// Fetch the record
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Store user ID and name in session variables
		$_SESSION["fidx"] = $row["FID"];
		$_SESSION["fname"] = $row["FName"];

		// Redirect to welcome faculty page
		header('Location: welcomefaculty.php');
		exit;
	} else {
		// Display error message and redirect to login page after 3 seconds
		echo "<h3><span style='color:red; '>Invalid Faculty ID & Password. Page Will redirect to Login Page after 3 seconds </span></h3>";
		header("refresh:3;url=facultylogin.php");
		exit;
	}
} else {
	// Redirect to login page if form data is not submitted
	header('Location: facultylogin.php');
	exit;
}
?>