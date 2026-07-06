<?php
// One-time script: Run this once to create the feedback table, then delete this file.
include 'dbConnection.php';

$sql = "CREATE TABLE IF NOT EXISTS `feedback` (
    `id`          INT(11) NOT NULL AUTO_INCREMENT,
    `user_id`     INT(11) DEFAULT NULL,
    `name`        VARCHAR(150) NOT NULL,
    `course_name` VARCHAR(200) NOT NULL,
    `rating`      TINYINT(1) NOT NULL DEFAULT 5,
    `message`     TEXT NOT NULL,
    `status`      ENUM('pending','approved') NOT NULL DEFAULT 'pending',
    `created_at`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql) === TRUE) {
    echo "<p style='color:green;font-family:sans-serif;'>✅ Table <strong>feedback</strong> created successfully (or already exists).</p>";
    echo "<p style='font-family:sans-serif;'>You can now <strong>delete this file</strong>: <code>create_feedback_table.php</code></p>";
} else {
    echo "<p style='color:red;font-family:sans-serif;'>❌ Error: " . $conn->error . "</p>";
}
$conn->close();
?>
