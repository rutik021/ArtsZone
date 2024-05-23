<?php
session_start();

$x = $_POST["aid"];
$y = $_POST["apass"];

include ("database.php");

$sql = "SELECT * FROM admin WHERE Aid=:aid AND Apass=:apass";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':aid', $x);
$stmt->bindParam(':apass', $y);
$stmt->execute();

if ($stmt->rowCount() > 0) {
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$_SESSION["umail"] = $row["Aid"];
	header('Location: welcomeadmin.php');
	exit;
} else {
	echo "<h3><span style='color:red; '>Invalid Admin ID & Password. Page Will redirect to Login Page after 3 seconds </span></h3>";
	header("refresh:3;url=Adminlogin.php");
	exit;
}
