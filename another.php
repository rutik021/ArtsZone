<?php
session_start();

// Check if email is set in session
if (isset($_SESSION["email"])) {
    // Print the email stored in session
    echo "Welcome, " . $_SESSION["email"];
} else {
    // Email is not set in session
    echo "Email not found in session.";
}
?>