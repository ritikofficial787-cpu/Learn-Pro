<?php
// Keep original design unchanged
require_once('./auth_check.php');
$adminEmail = $_SESSION['adminLogEmail'];

include('./admininclude.php/header.php');
include('../dbConnection.php');

// ── Handle Delete Order Action ────────────────────────────────────────────────
// Protect delete with prepared statement to prevent SQL injection
if (isset($_POST['deleteOrderBtn'])) {
    $del_id = intval($_POST['order_id']); // cast to int — SQL injection protection
    $stmt = $conn->prepare("DELETE FROM courseorder WHERE order_id = ?");
    $stmt->bind_param("i", $del_id);
    if ($stmt->execute()) {
        echo '<meta http-equiv="refresh" content="0;URL=adminDashboard.php">';
        exit;
    }
    $stmt->close();
}

// ── Dynamic dashboard cards ───────────────────────────────────────────────────
// Count total courses from course table
$totalCourses = 0;
$r = $conn->query("SELECT COUNT(*) AS cnt FROM course");
if ($r) { $totalCourses = $r->fetch_assoc()['cnt']; }

// Count total registered students from student table
$totalStudents = 0;
$r = $conn->query("SELECT COUNT(*) AS cnt FROM student");
if ($r) { $totalStudents = $r->fetch_assoc()['cnt']; }

// Count total sold courses/orders from courseorder table
$totalSold = 0;
$r = $conn->query("SELECT COUNT(*) AS cnt FROM courseorder");
if ($r) { $totalSold = $r->fetch_assoc()['cnt']; }

// ── Fetch latest orders (newest first) ───────────────────────────────────────
$ordersResult = $conn->query("SELECT * FROM courseorder ORDER BY order_id DESC");
?>

            <div class="col-sm-9 mt-5">
                <!-- Keep original design unchanged: same card colors bg-danger, bg-success, bg-info -->
                <div class="row mx-5 text-center">
                    <!-- Dynamic dashboard card: Total Courses -->
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                            <div class="card-header">Courses</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $totalCourses; ?></h4>
                                <a class="btn text-white" href="courses.php">View</a>
                            </div>
                        </div>
                    </div>
                    <!-- Dynamic dashboard card: Total Students -->
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">Students</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $totalStudents; ?></h4>
                                <a class="btn text-white" href="students.php">View</a>
                            </div>
                        </div>
                    </div>
                    <!-- Dynamic dashboard card: Total Sold Orders -->
                    <div class="col-sm-4 mt-5">
                        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                            <div class="card-header">Sold</div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $totalSold; ?></h4>
                                <a class="btn text-white" href="sellreport.php">View</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-5 mt-5 text-center">
                    <!-- Keep original table design unchanged -->
                    <p class="bg-dark text-white p-2">Course Ordered</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Course ID</th>
                                <th scope="col">Student Email</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Fetch latest orders — loop through dynamically
                        if ($ordersResult && $ordersResult->num_rows > 0):
                            while ($row = $ordersResult->fetch_assoc()):
                        ?>
                            <tr>
                                <th scope="row"><?php echo intval($row['order_id']); ?></th>
                                <td><?php echo intval($row['course_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['stu_email']); ?></td>
                                <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['amount']); ?></td>
                                <td>
                                    <!-- Delete button — same btn-secondary style as original -->
                                    <form action="adminDashboard.php" method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete this order permanently?');">
                                        <input type="hidden" name="order_id" value="<?php echo intval($row['order_id']); ?>">
                                        <button type="submit" class="btn btn-secondary" name="deleteOrderBtn">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            endwhile;
                        else:
                        ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">No orders found.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div> </div> </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
    <script src="../js/adminajaxrequest.js"></script>
    <script src="../js/custom.js"></script>
</body>
</html>