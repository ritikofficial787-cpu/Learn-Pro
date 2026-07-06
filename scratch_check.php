<?php
include 'dbConnection.php';
echo "<pre style='font-family:monospace;padding:20px;'>";

$tables = ['courseorder', 'course', 'student'];
foreach ($tables as $tbl) {
    echo "=== TABLE: $tbl ===\n";
    $r = $conn->query("DESCRIBE `$tbl`");
    if ($r) {
        while ($row = $r->fetch_assoc()) {
            echo "  " . $row['Field'] . " | " . $row['Type'] . " | " . $row['Key'] . "\n";
        }
    } else {
        echo "  (table not found or error: " . $conn->error . ")\n";
    }
    echo "\n";
}

// Show first 3 rows of courseorder to see sample data
echo "=== SAMPLE courseorder ROWS ===\n";
$r2 = $conn->query("SELECT * FROM courseorder LIMIT 3");
if ($r2 && $r2->num_rows > 0) {
    while ($row = $r2->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "(no rows or table missing)\n";
}
echo "</pre>";
?>
