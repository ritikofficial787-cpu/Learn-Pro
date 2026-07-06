<?php
include_once('dbConnection.php');

echo "<h3>Tables:</h3>";
$res = $conn->query("SHOW TABLES");
while($r = $res->fetch_array()) echo $r[0]."<br>";

echo "<h3>Admin Table Columns:</h3>";
$res2 = $conn->query("DESCRIBE admin");
if($res2){
    while($r = $res2->fetch_assoc())
        echo "<b>".$r['Field']."</b> (".$r['Type'].")<br>";
} else {
    echo "Table 'admin' not found. Error: ".$conn->error;
}

echo "<h3>Admin Records (raw):</h3>";
$res3 = $conn->query("SELECT * FROM admin LIMIT 5");
if($res3 && $res3->num_rows > 0){
    while($r = $res3->fetch_assoc()){
        echo "<pre>".print_r($r, true)."</pre>";
    }
} else {
    echo "No records or error: ".$conn->error;
}
?>
