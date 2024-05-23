<?php
session_start();
?>
<?php
$_SESSION["sidx"] = ""; // Setting session variable to empty string
session_unset(); // Unset all session variables
header('Location: index.php'); // Redirect to index.php
?>