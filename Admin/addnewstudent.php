<?php
require_once('./auth_check.php');
$adminEmail = $_SESSION['adminLogEmail'];

include('./admininclude.php/header.php');
include('../dbConnection.php');



if(isset($_REQUEST['newStuSubmitBtn'])){
  // Checking for Empty Fields
  if(empty($_REQUEST['stu_name']) || empty($_REQUEST['stu_email']) || empty($_REQUEST['stu_pass']) || empty($_REQUEST['stu_occ'])){
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
  } else {
    $stu_name  = $conn->real_escape_string($_REQUEST['stu_name']);
    $stu_email = $conn->real_escape_string($_REQUEST['stu_email']);
    $stu_pass  = md5($_REQUEST['stu_pass']);
    $stu_occ   = $conn->real_escape_string($_REQUEST['stu_occ']);

$sql = "INSERT INTO student (stu_name, stu_email, stu_pass) VALUES ('$stu_name', '$stu_email', '$stu_pass')";
    if($conn->query($sql) == TRUE){
      $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Student Added Successfully</div>';
    } else {
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Add Student: ' . $conn->error . '</div>';
    }
  }
}

?>
<div class="col-sm-6 mt-5 mx-3 jumbotron">
  <h3 class="text-center">Add New Student</h3>
  <form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
      <label for="stu_name">Name</label>
      <input type="text" class="form-control" id="stu_name" name="stu_name">
    </div>

    <div class="form-group">
      <label for="stu_email">Email</label>
      <input type="text" class="form-control" id="stu_email" name="stu_email">
    </div>
    <div class="form-group">
      <label for="stu_pass">Password</label>
      <input type="password" class="form-control" id="stu_pass" name="stu_pass">
    </div>

    <div class="form-group">
      <label for="stu_occ">Occupation</label>
      <input type="text" class="form-control" id="stu_occ" name="stu_occ">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="newStuSubmitBtn" name="newStuSubmitBtn">Submit</button>
      <a href="students.php" class="btn btn-secondary">Close</a>
    </div>

  </form>
</div>
    <?php if(isset($msg)) { echo $msg; } ?>
  </form>
</div>
</div>
</div>

<?php
include('./admininclude.php/footer.php')
?>