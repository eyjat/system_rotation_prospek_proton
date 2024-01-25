<?php
// Start the session
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header("Location: /dashboard/login.php"); // Replace 'login.php' with your actual login page
exit();
?>