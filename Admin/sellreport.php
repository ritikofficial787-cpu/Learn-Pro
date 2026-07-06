<?php
// Dynamic sell report starts
// Keep original design unchanged — same header, sidebar, footer, table style as all admin pages

require_once('./auth_check.php');
$adminEmail = $_SESSION['adminLogEmail'];

include('./admininclude.php/header.php');
include('../dbConnection.php');

// ── Date filter inputs ────────────────────────────────────────────────────────
$from_date  = isset($_GET['from_date'])  ? trim($_GET['from_date'])  : '';
$to_date    = isset($_GET['to_date'])    ? trim($_GET['to_date'])    : '';
$filtered   = false;
$totalSales = 0;

// ── Fetch orders with optional date filter using prepared statement ────────────
if (!empty($from_date) && !empty($to_date)) {
    // Dynamic sell report: filtered by date range
    $filtered = true;
    $stmt = $conn->prepare(
        "SELECT * FROM courseorder
         WHERE DATE(order_date) >= ? AND DATE(order_date) <= ?
         ORDER BY order_id DESC"
    );
    $stmt->bind_param("ss", $from_date, $to_date);
    $stmt->execute();
    $ordersResult = $stmt->get_result();

    // Calculate total sales amount for this date range
    $stmtTotal = $conn->prepare(
        "SELECT COALESCE(SUM(amount), 0) AS total FROM courseorder
         WHERE DATE(order_date) >= ? AND DATE(order_date) <= ?"
    );
    $stmtTotal->bind_param("ss", $from_date, $to_date);
    $stmtTotal->execute();
    $totalRow   = $stmtTotal->get_result()->fetch_assoc();
    $totalSales = $totalRow['total'];
    $stmtTotal->close();
} else {
    // No filter — show all orders, newest first
    $ordersResult = $conn->query("SELECT * FROM courseorder ORDER BY order_id DESC");

    // Total sales — all time
    $r = $conn->query("SELECT COALESCE(SUM(amount), 0) AS total FROM courseorder");
    if ($r) { $totalSales = $r->fetch_assoc()['total']; }
}
?>

<!-- Keep original design unchanged: same col-sm-9 main content wrapper -->
<div class="col-sm-9 mt-5">

    <p class="bg-dark text-white p-2">Sell Report</p>

    <!-- ── Date Filter Form — same Bootstrap styling used across admin pages ── -->
    <form method="GET" action="sellreport.php" class="d-print-none mb-4 mx-5">
        <div class="form-row align-items-end">
            <div class="form-group col-md-4">
                <label for="from_date"><strong>From Date</strong></label>
                <input type="date" class="form-control" id="from_date" name="from_date"
                       value="<?php echo htmlspecialchars($from_date); ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="to_date"><strong>To Date</strong></label>
                <input type="date" class="form-control" id="to_date" name="to_date"
                       value="<?php echo htmlspecialchars($to_date); ?>">
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary mr-2">
                    <i class="fas fa-search mr-1"></i> Search
                </button>
                <a href="sellreport.php" class="btn btn-secondary">
                    <i class="fas fa-redo mr-1"></i> Reset
                </a>
            </div>
        </div>
    </form>

    <?php if ($filtered): ?>
        <p class="mx-5 text-muted">
            Showing results from <strong><?php echo htmlspecialchars($from_date); ?></strong>
            to <strong><?php echo htmlspecialchars($to_date); ?></strong>
        </p>
    <?php endif; ?>

    <!-- ── Print Button — hidden when printing ────────────────────────────── -->
    <div class="mx-5 mb-3 d-print-none">
        <button onclick="window.print();" class="btn btn-info">
            <i class="fas fa-print mr-1"></i> Print Report
        </button>
    </div>

    <!-- ── Sell Report Table — same .table class as all admin pages ───────── -->
    <!-- Keep original table design unchanged -->
    <div class="mx-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Course ID</th>
                    <th scope="col">Student Email</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Amount (&#8377;)</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Fetch latest orders — loop through rows dynamically
            if ($ordersResult && $ordersResult->num_rows > 0):
                while ($row = $ordersResult->fetch_assoc()):
            ?>
                <tr>
                    <th scope="row"><?php echo intval($row['order_id']); ?></th>
                    <td><?php echo intval($row['course_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['stu_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                    <td>&#8377; <?php echo number_format((float)$row['amount'], 2); ?></td>
                </tr>
            <?php
                endwhile;
            else:
            ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        <?php echo $filtered ? 'No orders found for the selected date range.' : 'No orders yet.'; ?>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>

            <!-- Total sales row at bottom of table -->
            <tfoot>
                <tr class="table-dark text-white">
                    <td colspan="4" class="text-right font-weight-bold">
                        <strong>Total Sales<?php echo $filtered ? ' (Filtered)' : ' (All Time)'; ?>:</strong>
                    </td>
                    <td><strong>&#8377; <?php echo number_format((float)$totalSales, 2); ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

</div><!-- end main content -->

<?php
// Dynamic sell report ends
include('./admininclude.php/footer.php');
?>
