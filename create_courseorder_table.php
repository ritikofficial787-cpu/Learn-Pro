<?php
// One-time setup: Creates the courseorder table. Run once then delete this file.
include 'dbConnection.php';

$sql = "CREATE TABLE IF NOT EXISTS `courseorder` (
    `order_id`    INT(11) NOT NULL AUTO_INCREMENT,
    `course_id`   INT(11) NOT NULL DEFAULT 0,
    `stu_email`   VARCHAR(255) NOT NULL,
    `order_date`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `amount`      DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql) === TRUE) {
    echo "<p style='color:green;font-family:sans-serif;padding:20px;'>
          ✅ Table <strong>courseorder</strong> created successfully (or already exists).<br>
          You can now <strong>delete</strong> this file: <code>create_courseorder_table.php</code>
          </p>";
} else {
    echo "<p style='color:red;font-family:sans-serif;padding:20px;'>❌ Error: " . $conn->error . "</p>";
}
$conn->close();
?>
