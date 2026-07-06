<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'rsingh739@rku.ac.in';
    $mail->Password = 'abwufdzaytbazngk';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPDebug = 2; // Enable verbose debug output
    $mail->Debugoutput = function($str, $level) {
        file_put_contents('smtp_test_log.txt', $str . PHP_EOL, FILE_APPEND);
    };

    $mail->setFrom('rsingh739@rku.ac.in', 'Test');
    $mail->addAddress('rsingh739@rku.ac.in');
    $mail->Subject = 'SMTP Test';
    $mail->Body    = 'This is a test email.';

    if($mail->send()) {
        echo "Email sent successfully!";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    file_put_contents('smtp_test_log.txt', "ERROR: " . $mail->ErrorInfo . PHP_EOL, FILE_APPEND);
}
?>
