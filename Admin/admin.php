<?php
session_start();
include_once('../dbConnection.php');

if(isset($_POST['checkLogmail']) && isset($_POST['adminLogEmail'])){
    
    $adminLogEmail = $_POST['adminLogEmail'];
    $adminLogPass  = $_POST['adminLogPass'];

    $sql    = "SELECT * FROM admin WHERE admin_email = '".$adminLogEmail."' AND admin_pass = '".$adminLogPass."'";
    $result = $conn->query($sql);

    if($result && $result->num_rows === 1){
        $_SESSION['is_admin_login']  = true;
        $_SESSION['adminLogEmail']   = $adminLogEmail;
        echo 1;
    } else {
        // Debug line — remove after testing
        // echo "SQL: ".$sql." | Error: ".$conn->error;
        echo 0;
    }
    exit;
}
?>