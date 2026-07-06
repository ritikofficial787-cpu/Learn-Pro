<?php
/**
 * Admin Auth Guard
 * Include this at the TOP of every admin page (before any output).
 * It starts the session and redirects non-admins immediately.
 */
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['is_admin_login']) || $_SESSION['is_admin_login'] !== true){
    header("Location: ../index.php");
    exit;
}
?>
