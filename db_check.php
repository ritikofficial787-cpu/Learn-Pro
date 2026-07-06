<?php
include('dbConnection.php');
$res = $conn->query('DESCRIBE lesson');
while($row = $res->fetch_assoc()) {
    echo $row['Field'] . "\n";
}
?>
