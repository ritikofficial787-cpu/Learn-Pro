<?php
session_start();
include_once('dbConnection.php');

// Include Manual PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendOTP($email, $otp)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ssunny699@rku.ac.in'; // Your actual email
        $mail->Password   = 'zsxnjuusgthktqxk';    // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Bypass SSL Certificate verification for local testing on XAMPP/Windows
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Recipients
        $mail->setFrom('ssunny699@rku.ac.in', 'Learn Pro');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Password Reset OTP';
        $mail->Body    = "<h3>Password Reset Request</h3>
                          <p>Your 6-digit OTP for password reset is: <strong>{$otp}</strong></p>
                          <p>It is valid for 5 minutes. Do not share this OTP with anyone.</p>";
        $mail->AltBody = "Your OTP for password reset is: {$otp}. It is valid for 5 minutes.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        $_SESSION['mail_error'] = $mail->ErrorInfo;
        return false;
    }
}

$step = isset($_SESSION['reset_step']) ? $_SESSION['reset_step'] : 1;
$msg = '';
$debug_js = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['request_otp'])) {
        $email = trim($_POST['email']);

        $sql = "SELECT stu_id FROM student WHERE stu_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $otp = rand(100000, 999999);
            $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

            $update_sql = "UPDATE student SET otp = ?, otp_expiry = ? WHERE stu_email = ?";
            $ustmt = $conn->prepare($update_sql);
            $ustmt->bind_param("sss", $otp, $expiry, $email);

            if ($ustmt->execute()) {
                $_SESSION['reset_email'] = $email;
                $_SESSION['reset_step'] = 2;
                $step = 2;

                // Attempt to send email with PHPMailer
                $mail_sent = sendOTP($email, $otp);

                if ($mail_sent) {
                    $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>OTP has been sent to your email securely!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                } else {
                    // Fallback for local testing if SMTP credentials are not yet configured by the user
                    $mail_err = isset($_SESSION['mail_error']) ? $_SESSION['mail_error'] : 'Unknown error';
                    $debug_js = "<script>alert('NOTICE: Email could not be sent. Check Spam or see error below.\\n\\nError: $mail_err\\n\\nDEBUG OTP for $email is: $otp');</script>";
                    $msg = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Email sending failed (Error: $mail_err). Check alert for OTP to continue testing.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    unset($_SESSION['mail_error']);
                }
            } else {
                $msg = "<div class='alert alert-danger'>Failed to process OTP request. Please try again.</div>";
            }
        } else {
            // Anti-enumeration: Don't reveal if email is invalid, but for simplicity here we show invalid.
            $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Email not found in our records.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        }
    } elseif (isset($_POST['verify_otp'])) {
        $otp_entered = trim($_POST['otp']);
        if (isset($_SESSION['reset_email'])) {
            $email = $_SESSION['reset_email'];
            $sql = "SELECT otp, otp_expiry FROM student WHERE stu_email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row) {
                if ($row['otp'] == $otp_entered) {
                    if (strtotime($row['otp_expiry']) > time()) {
                        $_SESSION['reset_step'] = 3;
                        $_SESSION['otp_verified'] = true;

                        $clear_otp_sql = "UPDATE student SET otp = NULL, otp_expiry = NULL WHERE stu_email = ?";
                        $cstmt = $conn->prepare($clear_otp_sql);
                        $cstmt->bind_param("s", $email);
                        $cstmt->execute();

                        $step = 3;
                        $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>OTP correctly verified! Create your new password below.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    } else {
                        $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Error: OTP has expired.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    }
                } else {
                    $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Error: Invalid OTP.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                }
            }
        } else {
            $_SESSION['reset_step'] = 1;
            $step = 1;
        }
    } elseif (isset($_POST['reset_password'])) {
        if (isset($_SESSION['reset_email']) && isset($_SESSION['otp_verified']) && $_SESSION['otp_verified'] === true) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $email = $_SESSION['reset_email'];

                $update_sql = "UPDATE student SET stu_pass = ? WHERE stu_email = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("ss", $hashed_password, $email);

                if ($stmt->execute()) {
                    session_unset();
                    session_destroy();
                    $step = 4;
                } else {
                    $msg = "<div class='alert alert-danger'>Failed to update password.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Passwords do not match.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
        }
    } elseif (isset($_POST['resend_otp'])) {
        if (isset($_SESSION['reset_email'])) {
            $email = $_SESSION['reset_email'];
            $otp = rand(100000, 999999);
            $expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

            $update_sql = "UPDATE student SET otp = ?, otp_expiry = ? WHERE stu_email = ?";
            $ustmt = $conn->prepare($update_sql);
            $ustmt->bind_param("sss", $otp, $expiry, $email);

            if ($ustmt->execute()) {
                $mail_sent = sendOTP($email, $otp);
                if ($mail_sent) {
                    $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>A new OTP has been sent securely via PHPMailer!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                } else {
                    $mail_err = isset($_SESSION['mail_error']) ? $_SESSION['mail_error'] : 'Unknown error';
                    $debug_js = "<script>alert('NOTICE: New OTP could not be sent.\\n\\nError: $mail_err\\n\\nDEBUG New OTP for $email is: $otp');</script>";
                    $msg = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>New OTP process initiated (But email failed). Check alert.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    unset($_SESSION['mail_error']);
                }
            }
        }
    }
}
?>

<?php include 'maininclude/header.php'; ?>

<div class="container" style="margin-top: 100px; margin-bottom: 50px; min-height: 50vh;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow" style="border-radius: 15px; border: none;">
                <div class="card-header bg-danger text-white text-center" style="border-radius: 15px 15px 0 0;">
                    <h3 class="mb-0 py-2">Forgot Password</h3>
                </div>
                <div class="card-body p-4 p-md-5">
                    <?= $msg ?>
                    <?= $debug_js ?>

                    <?php if ($step == 1): ?>
                        <div class="text-center mb-4">
                            <i class="fas fa-lock fa-3x text-danger mb-3"></i>
                            <p class="text-muted">Enter your registered email address and we'll send you an OTP to reset
                                your password.</p>
                        </div>
                        <form method="POST" action="forgot-password.php">
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold"><i class="fas fa-envelope"></i> Email
                                    Address</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" required
                                    placeholder="Enter your email">
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="request_otp" class="btn btn-primary btn-lg">Send OTP</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="index.php" class="text-decoration-none text-muted">Back to Login</a>
                            </div>
                        </form>
                    <?php elseif ($step == 2): ?>
                        <div class="text-center mb-4">
                            <i class="fas fa-key fa-3x text-danger mb-3"></i>
                            <p class="text-muted">An OTP has been sent to
                                <strong><?= htmlspecialchars($_SESSION['reset_email']) ?></strong>.
                            </p>
                            <p class="small text-danger">It will expire in 5 minutes.</p>
                        </div>
                        <form method="POST" action="forgot-password.php">
                            <div class="mb-4">
                                <label for="otp" class="form-label fw-bold"><i class="fas fa-shield-alt"></i> Enter 6-digit
                                    OTP</label>
                                <input type="text" class="form-control form-control-lg text-center" id="otp" name="otp"
                                    required maxlength="6" pattern="\d{6}" placeholder="------" autocomplete="off"
                                    style="letter-spacing: 1em; font-size: 1.2rem;">
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" name="verify_otp" class="btn btn-primary btn-lg">Verify OTP</button>
                            </div>
                        </form>
                        <form method="POST" action="forgot-password.php" id="resendForm">
                            <div class="text-center">
                                <button type="submit" name="resend_otp" id="resendBtn"
                                    class="btn btn-link text-decoration-none p-0" disabled>
                                    Resend OTP <span id="timer">(30s)</span>
                                </button>
                            </div>
                        </form>

                        <script>
                            let timeLeft = 30;
                            const resendBtn = document.getElementById('resendBtn');
                            const timerSpan = document.getElementById('timer');

                            const countdown = setInterval(() => {
                                timeLeft--;
                                timerSpan.textContent = `(${timeLeft}s)`;

                                if (timeLeft <= 0) {
                                    clearInterval(countdown);
                                    resendBtn.disabled = false;
                                    timerSpan.textContent = "";
                                }
                            }, 1000);
                        </script>
                    <?php elseif ($step == 3): ?>
                        <div class="text-center mb-4">
                            <i class="fas fa-unlock-alt fa-3x text-success mb-3"></i>
                            <p class="text-muted">OTP Verified. You can now create a new password.</p>
                        </div>
                        <form method="POST" action="forgot-password.php">
                            <div class="mb-3">
                                <label for="new_password" class="form-label fw-bold"><i class="fas fa-lock"></i> New
                                    Password</label>
                                <input type="password" class="form-control form-control-lg" id="new_password"
                                    name="new_password" required minlength="6" placeholder="Enter new password">
                            </div>
                            <div class="mb-4">
                                <label for="confirm_password" class="form-label fw-bold"><i class="fas fa-lock"></i> Confirm
                                    Password</label>
                                <input type="password" class="form-control form-control-lg" id="confirm_password"
                                    name="confirm_password" required minlength="6" placeholder="Confirm new password">
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="reset_password" class="btn btn-success btn-lg">Complete
                                    Reset</button>
                            </div>
                        </form>
                    <?php elseif ($step == 4): ?>
                        <div class="text-center text-success mb-4 mt-4">
                            <i class="far fa-check-circle fa-5x mb-3"></i>
                            <h4 class="fw-bold">Password Reset Successful!</h4>
                            <p class="text-muted mt-3">Your password has been updated securely. You can now log in with your
                                new credentials.</p>
                        </div>
                        <div class="d-grid mt-4">
                            <a href="index.php" class="btn btn-primary btn-lg">Go to Login</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'maininclude/footer.php'; ?>