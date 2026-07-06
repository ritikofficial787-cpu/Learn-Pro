<?php
require_once('./auth_check.php');
$adminEmail = $_SESSION['adminLogEmail'];

include('./admininclude.php/header.php');
include('../dbConnection.php');

// Pre-load student data when coming from students.php via the edit button
if(isset($_REQUEST['view']) && isset($_REQUEST['id'])){
    $sid_safe = intval($_REQUEST['id']);
    $sql = "SELECT * FROM student WHERE stu_id = $sid_safe";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Handle update submission
if(isset($_REQUEST['requpdate'])){
    if(($_REQUEST['stu_id'] == "") || ($_REQUEST['stu_name'] == "") || ($_REQUEST['stu_email'] == "") || ($_REQUEST['stu_pass'] == "")){
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    } else {
        $sid    = intval($_REQUEST['stu_id']);
        $sname  = $conn->real_escape_string($_REQUEST['stu_name']);
        $semail = $conn->real_escape_string($_REQUEST['stu_email']);
        $spass  = $conn->real_escape_string($_REQUEST['stu_pass']);
        $socc   = $conn->real_escape_string($_REQUEST['stu_occ']);

        $sql = "UPDATE student SET 
                stu_name  = '$sname', 
                stu_email = '$semail', 
                stu_pass  = '$spass', 
                stu_occ   = '$socc' 
                WHERE stu_id = $sid";
        if($conn->query($sql) == TRUE){
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
            // Re-fetch updated row to keep form filled
            $result2 = $conn->query("SELECT * FROM student WHERE stu_id = $sid");
            $row = $result2->fetch_assoc();
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update: ' . $conn->error . '</div>';
        }
    }
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
  <h3 class="text-center">Update Student Detail</h3>

  <?php if(isset($msg)) { echo $msg; } ?>

  <form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
      <label for="stu_id">ID</label>
      <input type="text" class="form-control" id="stu_id" name="stu_id"
        value="<?php if(isset($row['stu_id'])) { echo $row['stu_id']; } ?>"
        readonly>
    </div>

    <div class="form-group">
      <label for="stu_name">Name</label>
      <input type="text" class="form-control" id="stu_name" name="stu_name"
        value="<?php if(isset($row['stu_name'])) { echo $row['stu_name']; } ?>">
    </div>

    <div class="form-group">
      <label for="stu_email">Email</label>
      <input type="text" class="form-control" id="stu_email" name="stu_email"
        value="<?php if(isset($row['stu_email'])) { echo $row['stu_email']; } ?>">
    </div>

    <div class="form-group">
      <label for="stu_pass">Password</label>
      <input type="password" class="form-control" id="stu_pass" name="stu_pass"
        value="<?php if(isset($row['stu_pass'])) { echo $row['stu_pass']; } ?>">
    </div>

    <div class="form-group">
      <label for="stu_occ">Occupation</label>
      <input type="text" class="form-control" id="stu_occ" name="stu_occ"
        value="<?php if(isset($row['stu_occ'])) { echo $row['stu_occ']; } ?>">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="students.php" class="btn btn-secondary">Close</a>
    </div>

  </form>
</div>

<?php
include('./admininclude.php/footer.php');
?>