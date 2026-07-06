<?php
// Start session if not already started
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

// Destroy all session data
session_unset();
session_destroy();

// Redirect to main login/home page
header("Location: ../index.php");
exit;
?>
