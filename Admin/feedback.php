<?php
// Admin Feedback Management Page
// Allows admin to approve or delete user-submitted feedback.

if (!isset($_SESSION)) {
    session_start();
}
require_once('./auth_check.php');
$adminEmail = $_SESSION['adminLogEmail'];

include('./admininclude.php/header.php');
include('../dbConnection.php');

// ── Handle Approve Action ─────────────────────────────────────────────────────
if (isset($_POST['approveBtn'])) {
    $approveId = intval($_POST['id']); // cast to int – SQL injection protection
    $stmt = $conn->prepare("UPDATE feedback SET status = 'approved' WHERE id = ?");
    $stmt->bind_param("i", $approveId);
    if ($stmt->execute()) {
        echo '<meta http-equiv="refresh" content="0;URL=feedback.php">';
    } else {
        echo '<p class="text-danger">Unable to approve feedback.</p>';
    }
    $stmt->close();
}

// ── Handle Delete Action ──────────────────────────────────────────────────────
if (isset($_POST['deleteBtn'])) {
    $deleteId = intval($_POST['id']); // cast to int – SQL injection protection
    $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
    $stmt->bind_param("i", $deleteId);
    if ($stmt->execute()) {
        echo '<meta http-equiv="refresh" content="0;URL=feedback.php">';
    } else {
        echo '<p class="text-danger">Unable to delete feedback.</p>';
    }
    $stmt->close();
}

// ── Fetch All Feedback (newest first) ────────────────────────────────────────
$sql    = "SELECT * FROM feedback ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<div class="col-sm-9 mt-5">

    <p class="bg-dark text-white p-2">
        <i class="fas fa-comments me-2"></i>Manage Student Feedback
    </p>

    <!-- Legend badges -->
    <div class="mb-3">
        <span class="badge bg-warning text-dark me-2">Pending</span>
        <span class="badge bg-success me-2">Approved</span>
        <small class="text-muted">Only approved feedback appears on the homepage.</small>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th style="width:60px;">Rating</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th style="width:150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo intval($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                    <td class="text-center">
                        <?php for ($s = 1; $s <= intval($row['rating']); $s++): ?>
                            <i class="fas fa-star text-warning" style="font-size:11px;"></i>
                        <?php endfor; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td>
                        <?php if ($row['status'] === 'approved'): ?>
                            <span class="badge bg-success">Approved</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td>
                        <!-- Approve Button (only show if pending) -->
                        <?php if ($row['status'] !== 'approved'): ?>
                        <form action="feedback.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo intval($row['id']); ?>">
                            <button type="submit" name="approveBtn" class="btn btn-success btn-sm me-1"
                                    title="Approve">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <?php else: ?>
                            <span class="text-muted small me-1">Live</span>
                        <?php endif; ?>

                        <!-- Delete Button -->
                        <form action="feedback.php" method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this feedback permanently?');">
                            <input type="hidden" name="id" value="<?php echo intval($row['id']); ?>">
                            <button type="submit" name="deleteBtn" class="btn btn-danger btn-sm"
                                    title="Delete">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

    <?php else: ?>
        <div class="alert alert-info">No feedback submitted yet.</div>
    <?php endif; ?>

</div>
</div>
</div>

<?php include('./admininclude.php/footer.php'); ?>