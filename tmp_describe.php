<?php
include 'dbConnection.php';
$r = $conn->query('DESCRIBE student');
while($row = $r->fetch_assoc()) {
    echo $row['Field'] . "\n";
}
