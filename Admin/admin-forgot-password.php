<?php
session_start();
include_once('../dbConnection.php');

$step   = 'email';   // email | otp | reset
$error  = '';
$success = '';

// ─── STEP 1: Submit Email ────────────────────────────────────────────────────
if (isset($_POST['send_otp'])) {
    $email = trim($_POST['admin_email']);

    $stmt = $conn->prepare("SELECT admin_id FROM admin WHERE admin_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Generate 6-digit OTP
        $otp = rand(100000, 999999);
        $expires = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        // Store in session (no email library needed)
        $_SESSION['admin_fp_otp']     = $otp;
        $_SESSION['admin_fp_email']   = $email;
        $_SESSION['admin_fp_expires'] = $expires;

        // Show OTP on page (since we have no mail server on localhost)
        $step    = 'otp';
        $success = "OTP for testing (no email server): <strong>$otp</strong>";
    } else {
        $error = "No admin account found with that email.";
    }
    $stmt->close();
}

// ─── STEP 2: Verify OTP ──────────────────────────────────────────────────────
if (isset($_POST['verify_otp'])) {
    $entered = trim($_POST['otp']);

    if (!isset($_SESSION['admin_fp_otp'])) {
        $error = "Session expired. Please start again.";
    } elseif (strtotime($_SESSION['admin_fp_expires']) < time()) {
        $error = "OTP has expired. Please start again.";
        unset($_SESSION['admin_fp_otp'], $_SESSION['admin_fp_email'], $_SESSION['admin_fp_expires']);
    } elseif ($entered != $_SESSION['admin_fp_otp']) {
        $step  = 'otp';
        $error = "Incorrect OTP. Please try again.";
    } else {
        // OTP is correct — go to reset step
        $_SESSION['admin_fp_verified'] = true;
        $step = 'reset';
    }
}

// ─── STEP 3: Reset Password ──────────────────────────────────────────────────
if (isset($_POST['reset_pass'])) {
    if (!isset($_SESSION['admin_fp_verified']) || !$_SESSION['admin_fp_verified']) {
        $error = "Unauthorized. Please verify OTP first.";
    } else {
        $new_pass  = $_POST['new_pass'];
        $conf_pass = $_POST['conf_pass'];

        if ($new_pass !== $conf_pass) {
            $step  = 'reset';
            $error = "Passwords do not match.";
        } elseif (strlen($new_pass) < 6) {
            $step  = 'reset';
            $error = "Password must be at least 6 characters.";
        } else {
            $email = $_SESSION['admin_fp_email'];
            $stmt  = $conn->prepare("UPDATE admin SET admin_pass = ? WHERE admin_email = ?");
            $stmt->bind_param("ss", $new_pass, $email);
            $stmt->execute();
            $stmt->close();

            // Clear session
            unset($_SESSION['admin_fp_otp'], $_SESSION['admin_fp_email'],
                  $_SESSION['admin_fp_expires'], $_SESSION['admin_fp_verified']);

            $step    = 'done';
            $success = "Password reset successfully! You can now <a href='../index.php'>login</a>.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Forgot Password | Learn Pro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { background: #f0f4f8; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .fp-card { background: #fff; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,.12); padding: 40px 35px; max-width: 420px; width: 100%; }
        .fp-card h3 { color: #225470; font-weight: 700; margin-bottom: 25px; }
        .step-icon { font-size: 2.5rem; color: #225470; margin-bottom: 15px; }
        .btn-brand { background: #225470; color: #fff; border: none; }
        .btn-brand:hover { background: #1b4260; color: #fff; }
    </style>
</head>
<body>
<div class="fp-card text-center">
    <a href="../index.php" class="text-muted d-block mb-3" style="font-size:.85rem;">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success && $step !== 'otp'): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($step === 'email'): ?>
        <!-- STEP 1 -->
        <div class="step-icon"><i class="fas fa-lock"></i></div>
        <h3>Forgot Password</h3>
        <p class="text-muted mb-4">Enter your admin email to receive an OTP.</p>
        <form method="POST">
            <div class="form-group text-left">
                <label for="admin_email">Admin Email</label>
                <input type="email" class="form-control" id="admin_email" name="admin_email"
                       placeholder="admin@example.com" required>
            </div>
            <button type="submit" name="send_otp" class="btn btn-brand btn-block mt-3">
                <i class="fas fa-paper-plane mr-1"></i> Send OTP
            </button>
        </form>

    <?php elseif ($step === 'otp'): ?>
        <!-- STEP 2 -->
        <div class="step-icon"><i class="fas fa-shield-alt"></i></div>
        <h3>Enter OTP</h3>
        <?php if ($success): ?>
            <div class="alert alert-info"><?= $success ?></div>
        <?php endif; ?>
        <p class="text-muted mb-4">Enter the 6-digit OTP shown above (valid for 10 minutes).</p>
        <form method="POST">
            <div class="form-group text-left">
                <label for="otp">OTP Code</label>
                <input type="text" class="form-control text-center" id="otp" name="otp"
                       maxlength="6" placeholder="------" required
                       style="font-size:1.5rem; letter-spacing:8px;">
            </div>
            <button type="submit" name="verify_otp" class="btn btn-brand btn-block mt-3">
                <i class="fas fa-check mr-1"></i> Verify OTP
            </button>
        </form>

    <?php elseif ($step === 'reset'): ?>
        <!-- STEP 3 -->
        <div class="step-icon"><i class="fas fa-key"></i></div>
        <h3>Reset Password</h3>
        <p class="text-muted mb-4">Choose a new password for your admin account.</p>
        <form method="POST">
            <div class="form-group text-left">
                <label for="new_pass">New Password</label>
                <input type="password" class="form-control" id="new_pass" name="new_pass"
                       placeholder="Minimum 6 characters" required>
            </div>
            <div class="form-group text-left">
                <label for="conf_pass">Confirm Password</label>
                <input type="password" class="form-control" id="conf_pass" name="conf_pass"
                       placeholder="Repeat password" required>
            </div>
            <button type="submit" name="reset_pass" class="btn btn-brand btn-block mt-3">
                <i class="fas fa-save mr-1"></i> Reset Password
            </button>
        </form>

    <?php elseif ($step === 'done'): ?>
        <!-- DONE -->
        <div class="step-icon"><i class="fas fa-check-circle text-success"></i></div>
        <h3 class="text-success">All Done!</h3>

    <?php endif; ?>
</div>
</body>
</html>
