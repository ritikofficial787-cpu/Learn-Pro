<?php
// Migration script: Drops old feedback table and creates new one.
// Run ONCE, then DELETE this file.
include 'dbConnection.php';

// Step 1: Drop old table
$drop = $conn->query("DROP TABLE IF EXISTS `feedback`");
if ($drop) {
    echo "<p style='color:orange;font-family:sans-serif;'>⚠️ Old <strong>feedback</strong> table dropped.</p>";
} else {
    echo "<p style='color:red;font-family:sans-serif;'>❌ Could not drop table: " . $conn->error . "</p>";
    exit;
}

// Step 2: Create new table with full schema
$create = "CREATE TABLE `feedback` (
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

if ($conn->query($create) === TRUE) {
    echo "<p style='color:green;font-family:sans-serif;'>✅ New <strong>feedback</strong> table created successfully!</p>";
    echo "<p style='font-family:sans-serif;'><strong>You can now delete this file:</strong> <code>migrate_feedback_table.php</code></p>";
} else {
    echo "<p style='color:red;font-family:sans-serif;'>❌ Error creating table: " . $conn->error . "</p>";
}
$conn->close();
?>
