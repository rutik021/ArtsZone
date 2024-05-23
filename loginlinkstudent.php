<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Retrieve user-entered credentials
	$email = $_POST["email"];
	$password = $_POST["password"];

	// Include database configuration
	include ("database.php");

	try {
		// Prepare SQL statement to retrieve user from database
		$sql = "SELECT * FROM studenttable WHERE Eid = :email AND Pass = :password";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":password", $password);
		$stmt->execute();

		// Check if user exists
		if ($stmt->rowCount() == 1) {
			// User found, fetch user details
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			// Store user email in session
			$_SESSION["sidx"] = $row["Eid"];
			$_SESSION["fname"] = $row["FName"];
			$_SESSION["seno"] = $row["Eno"];
			$_SESSION["lname"] = $row["LName"];

			// Redirect to another page
			header("Location: welcomestudent.php");
			exit(); // Ensure script termination after redirection
		} else {
			// User not found, display error message
			echo "<h3><span style='color:red;'>Invalid email or password.</span></h3>";
		}
	} catch (PDOException $e) {
		// Handle database errors
		echo "Database Error: " . $e->getMessage();
	}
}
?>