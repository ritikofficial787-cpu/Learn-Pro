<?php
session_start();

// Ensure user is coming from checkout via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid Request. Please proceed from the checkout page.");
}

// Get the posted details
$order_id  = isset($_POST['ORDER_ID'])    ? $_POST['ORDER_ID']  : 'ORDS' . rand(10000,99999999);
$stu_email = isset($_POST['CUST_ID'])     ? $_POST['CUST_ID']   : 'student@example.com';
$course_id = isset($_POST['course_id'])   ? intval($_POST['course_id']) : 0;
// Amount must be passed in paise (amount * 100)
$amount    = isset($_POST['TXN_AMOUNT'])  ? (int)($_POST['TXN_AMOUNT'] * 100) : 100;
$amount_rs = isset($_POST['TXN_AMOUNT'])  ? (float)$_POST['TXN_AMOUNT'] : 0;

// ── Part 4: Record order in courseorder table ─────────────────────────────────
require_once __DIR__ . '/dbConnection.php';
if ($course_id > 0 && $stu_email !== 'student@example.com') {
    // prevent duplicate if user re-clicks Back
    $chk = $conn->prepare("SELECT order_id FROM courseorder WHERE stu_email=? AND course_id=?");
    $chk->bind_param("si", $stu_email, $course_id);
    $chk->execute();
    $chk->store_result();
    if ($chk->num_rows == 0) {
        $ins = $conn->prepare(
            "INSERT INTO courseorder (course_id, stu_email, order_date, amount) VALUES (?, ?, NOW(), ?)"
        );
        $ins->bind_param("isd", $course_id, $stu_email, $amount_rs);
        $ins->execute();
        $ins->close();
    }
    $chk->close();
}
// Store in session so success.php can display details
$_SESSION['last_course_id'] = $course_id;
$_SESSION['last_amount']    = $amount_rs;
// ── End Part 4 ─────────────────────────────────────────────────────────────── 

// -------------------------------------------------------------
// PHONEPE CREDENTIALS AND SETTINGS
// -------------------------------------------------------------

// ADD YOUR PHONEPE MERCHANT ID HERE
$merchantId = "PGTESTPAYUAT"; 

// ADD YOUR PHONEPE SALT KEY HERE
$saltKey = "099eb0cd-02cf-4e2a-8aca-3e6c6aff0399"; 

// ADD YOUR PHONEPE SALT INDEX HERE
$saltIndex = "1"; 

// ADD YOUR WEBSITE SUCCESS PAGE URL HERE
$redirectUrl = "http://localhost/ritik/success.php"; 
$callbackUrl = "http://localhost/ritik/success.php";

// SANDBOX API URL USED FOR DEMO ONLY
// THIS WILL NOT DEDUCT REAL MONEY
$apiUrl = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay";
// -------------------------------------------------------------

// payload generation
$payload = [
    "merchantId" => $merchantId,
    "merchantTransactionId" => $order_id,
    "merchantUserId" => "MUID" . rand(100, 999), // Unique user ID
    "amount" => $amount,
    "redirectUrl" => $redirectUrl,
    "redirectMode" => "POST",
    "callbackUrl" => $callbackUrl,
    "mobileNumber" => "9999999999", // Can be dynamic if collected in checkout
    "paymentInstrument" => [
        "type" => "PAY_PAGE"
    ]
];

// JSON encode payload and encode base64
$payloadJson = json_encode($payload);
$base64Payload = base64_encode($payloadJson);

// checksum creation
// SHA256(base64 encoded payload + "/pg/v1/pay" + salt key) + ### + salt index
$string = $base64Payload . "/pg/v1/pay" . $saltKey;
$sha256 = hash("sha256", $string);
$checksum = $sha256 . "###" . $saltIndex;

// cURL request
$requestBody = json_encode(['request' => $base64Payload]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "X-VERIFY: " . $checksum,
    "accept: application/json"
]);

// response handling
$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);

if (isset($responseData['success']) && $responseData['success'] === true) {
    // redirect URL extraction from response
    $paymentUrl = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
    
    // Redirect user to the PhonePe payment page
    header("Location: " . $paymentUrl);
    exit();
} else {
    // Display error if anything goes wrong during API request
    echo "<h3>Payment Initialization Failed</h3>";
    echo "<p>Something went wrong with PhonePe API request.</p>";
    if (isset($responseData['message'])) {
        echo "<p>Error Message: " . htmlspecialchars($responseData['message']) . "</p>";
    }
    echo "<a href='checkout.php'>Go back to Checkout</a>";
}
?>
