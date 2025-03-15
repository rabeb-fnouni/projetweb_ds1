<?php
// views/auth/logout.php

// Start the session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page with a success message
header('Location: ' . BASE_URL . 'views\auth\login.php?message=You have been logged out successfully.');
exit();
?>