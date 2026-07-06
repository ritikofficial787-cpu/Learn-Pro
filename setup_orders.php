<?php
/**
 * setup_orders.php  — Run ONCE to ensure courseorder table is ready
 * Delete this file after running successfully.
 *
 * Usage: http://localhost/ritik/setup_orders.php
 */
include 'dbConnection.php';

$messages = [];

// ── 1. Ensure courseorder table exists with all needed columns ──────────────
$sql1 = "CREATE TABLE IF NOT EXISTS `courseorder` (
    `order_id`    INT(11)       NOT NULL AUTO_INCREMENT,
    `course_id`   INT(11)       NOT NULL DEFAULT 0,
    `stu_email`   VARCHAR(255)  NOT NULL,
    `order_date`  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `amount`      DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    PRIMARY KEY (`order_id`),
    INDEX `idx_stu_email` (`stu_email`),
    INDEX `idx_course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sql1) === TRUE) {
    $messages[] = "✅ Table <strong>courseorder</strong> is ready.";
} else {
    $messages[] = "❌ Error creating courseorder: " . $conn->error;
}

// ── 2. Verify course table exists ──────────────────────────────────────────
$r = $conn->query("SHOW TABLES LIKE 'course'");
if ($r && $r->num_rows > 0) {
    $messages[] = "✅ Table <strong>course</strong> exists (columns: course_id, course_name, course_desc, course_author, course_duration, course_original_price, course_price, course_img).";
} else {
    $messages[] = "⚠️ Table <strong>course</strong> not found — add courses via Admin → addCourse.php.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Setup Orders</title>
<style>body{font-family:sans-serif;padding:40px;} li{margin-bottom:8px;font-size:16px;}</style>
</head>
<body>
<h2>Setup: Order Table Check</h2>
<ul>
<?php foreach ($messages as $m) echo "<li>$m</li>"; ?>
</ul>
<p style="color:#888;margin-top:30px;">
  <strong>Delete this file</strong> (<code>setup_orders.php</code>) after confirming everything is ✅.
</p>
</body>
</html>
