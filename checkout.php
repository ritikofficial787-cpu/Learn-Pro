<?php
include('./dbConnection.php');
if(!isset($_SESSION)){ 
  session_start(); 
}

if (!isset($_SESSION['stuLogEmail'])) {
    // If not logged in, redirect to loginorsignup.php
    echo "<script> location.href = 'loginorsignup.php'; </script>";
    exit();
} else {
    $stuEmail = $_SESSION['stuLogEmail'];
    // For checkout display
    $course_name = isset($_POST['course_name']) ? $_POST['course_name'] : "Your Selected Course";
    $price = isset($_POST['price']) ? $_POST['price'] : "0";
    // Part 4: capture course_id so it flows into the order record
    $course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
    
    // Attempt to get user name from db
    $stuName = "";
    $sql = "SELECT stu_name FROM student WHERE stu_email = '$stuEmail'";
    $result = $conn->query($sql);
    if($result && $result->num_rows == 1){
        $row = $result->fetch_assoc();
        $stuName = $row['stu_name'];
    }
}

// We only output HTML here if user IS logged in.
include('./maininclude/header.php');
?>

<div class="container-fluid bg-dark p-0">
    <div class="row m-0">
        <img src="./image/courseimg/books.jpg" alt="course" style="height:300px; width:100%; object-fit:cover; box-shadow:10px;">
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0 font-weight-bold">Checkout Summary</h3>
                </div>
                <div class="card-body p-5">
                    <form action="phonepe-pay.php" method="POST">
                        <!-- Part 4: forward course_id to phonepe-pay.php -->
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                        <div class="form-group row mb-4">
                            <label for="ORDER_ID" class="col-sm-4 col-form-label font-weight-bold">Order ID</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ORDER_ID" name="ORDER_ID" value="<?php echo 'ORDS' . rand(10000,99999999)?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="CUST_ID" class="col-sm-4 col-form-label font-weight-bold">Student Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="CUST_ID" name="CUST_ID" value="<?php echo htmlspecialchars($stuEmail); ?>" readonly>
                            </div>
                        </div>
                        
                        <!-- Optionally display student name if found -->
                        <?php if($stuName !== ""): ?>
                        <div class="form-group row mb-4">
                            <label class="col-sm-4 col-form-label font-weight-bold">Student Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($stuName); ?>" readonly>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="form-group row mb-4">
                            <label for="COURSE_NAME" class="col-sm-4 col-form-label font-weight-bold">Course Details</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="COURSE_NAME" name="COURSE_NAME" value="<?php echo htmlspecialchars($course_name); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label for="TXN_AMOUNT" class="col-sm-4 col-form-label font-weight-bold">Amount to Pay (&#8377;)</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control font-weight-bold text-success" id="TXN_AMOUNT" name="TXN_AMOUNT" value="<?php echo htmlspecialchars($price); ?>" readonly>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg px-5 font-weight-bold">Proceed to Payment / Join Course</button>
                            <a href="course.php" class="btn btn-secondary btn-lg ml-3 px-5">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include('./maininclude/footer.php'); 
?>