<?php
session_start();
?>
<?php
$_SESSION["umail"] = ""; // Corrected assignment
session_unset(); // No argument needed here

header('Location:index.php');
?>