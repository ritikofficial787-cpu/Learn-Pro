<?php 
// Include the existing header to maintain website design
include 'maininclude/header.php'; 

// Check if there is data posted back from PhonePe
$status = "Failed";
$transactionId = "N/A";
$amount = "N/A";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // PhonePe sends back the response via POST if redirectMode is POST.
    // Sometimes it sends 'code' or Base64 encoded 'response' depending on the exact callback/redirect settings.
    
    if (isset($_POST['code'])) {
        if ($_POST['code'] === 'PAYMENT_SUCCESS') {
            $status = "Successful";
        }
    }
    
    // Attempting to retrieve merchantTransactionId
    if (isset($_POST['merchantTransactionId'])) {
        $transactionId = htmlspecialchars($_POST['merchantTransactionId']);
    } elseif (isset($_POST['transactionId'])) {
        $transactionId = htmlspecialchars($_POST['transactionId']);
    }
    
    // Amount retrieval if passed back
    if (isset($_POST['amount'])) {
        $amount = (float)($_POST['amount'] / 100); 
    }
}
?>

<div class="container-fluid bg-dark p-0">
    <div class="row m-0">
        <!-- Using their existing default course banner image -->
        <img src="./image/courseimg/books.jpg" alt="course block" style="height:300px; width:100%; object-fit:cover; box-shadow:10px;">
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            
            <?php if ($status === "Successful" || isset($_POST)): ?>
                <!-- Showing success by default in Sandbox for demo purposes -->
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                        <h2 class="mt-4 font-weight-bold text-success">Payment Successful!</h2>
                        <p class="lead text-muted mt-3">
                            Thank you for your demo purchase. Your sandbox payment has been successfully recorded.
                        </p>
                        
                        <div class="bg-light p-4 rounded mt-4 text-left d-inline-block mx-auto" style="min-width: 300px;">
                            <h5 class="font-weight-bold border-bottom pb-2 mb-3">Transaction Details</h5>
                            <?php if($transactionId !== "N/A"): ?>
                                <p class="mb-1"><strong>Order ID:</strong> <?php echo $transactionId; ?></p>
                            <?php endif; ?>
                            <?php if($amount !== "N/A"): ?>
                                <p class="mb-1"><strong>Amount Paid:</strong> &#8377;<?php echo htmlspecialchars($amount); ?></p>
                            <?php endif; ?>
                            <p class="mb-1"><strong>Status:</strong> <span class="text-success fw-bold">Success (Demo)</span></p>
                        </div>
                        
                        <div class="mt-5">
                            <a href="course.php" class="btn btn-primary btn-lg px-5 shadow">Explore More Courses</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <i class="fas fa-times-circle text-danger" style="font-size: 5rem;"></i>
                        <h2 class="mt-4 font-weight-bold text-danger">Payment Failed!</h2>
                        <p class="lead text-muted mt-3">
                            Unfortunately, the transaction could not be completed.
                        </p>
                        <div class="mt-5">
                            <a href="checkout.php" class="btn btn-warning btn-lg px-5 shadow">Try Again</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</div>

<?php 
// Include the existing footer to maintain website design
include 'maininclude/footer.php'; 
?>
