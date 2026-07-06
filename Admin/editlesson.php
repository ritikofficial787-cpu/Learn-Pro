<?php
if(!isset($_SESSION)){
    session_start();
}
require_once('./auth_check.php');
$adminEmail = $_SESSION['adminLogEmail'];

include('../dbConnection.php');

// ── Handle Update BEFORE any HTML output ──────────────────────────────────
if(isset($_POST['requpdate'])){

    $lid   = intval($_POST['lesson_id']   ?? 0);
    $lname = trim($_POST['lesson_name']   ?? '');
    $ldesc = trim($_POST['lesson_desc']   ?? '');
    $cid   = intval($_POST['course_id']   ?? 0);
    $cname = trim($_POST['course_name']   ?? '');

    if($lid === 0 || $lname === '' || $ldesc === '' || $cid === 0 || $cname === ''){
        $_SESSION['edit_msg']  = 'Fill All Fields';
        $_SESSION['edit_type'] = 'warning';
        header("Location: editlesson.php?view=1&id={$lid}");
        exit;
    }

    $s_name  = $conn->real_escape_string($lname);
    $s_desc  = $conn->real_escape_string($ldesc);
    $s_cname = $conn->real_escape_string($cname);

    if(isset($_FILES['lesson_link']) && $_FILES['lesson_link']['error'] === UPLOAD_ERR_OK && $_FILES['lesson_link']['name'] !== ''){
        $link_folder = '../lessonvid/' . basename($_FILES['lesson_link']['name']);
        move_uploaded_file($_FILES['lesson_link']['tmp_name'], $link_folder);
        $s_link = $conn->real_escape_string($link_folder);
        $sql = "UPDATE lesson SET lession_name='$s_name', lession_desc='$s_desc',
                course_id='$cid', course_name='$s_cname', lession_link='$s_link'
                WHERE lesson_id='$lid'";
    } else {
        $sql = "UPDATE lesson SET lession_name='$s_name', lession_desc='$s_desc',
                course_id='$cid', course_name='$s_cname'
                WHERE lesson_id='$lid'";
    }

    if($conn->query($sql) === TRUE){
        $_SESSION['edit_msg']  = 'Lesson Updated Successfully';
        $_SESSION['edit_type'] = 'success';
    } else {
        $_SESSION['edit_msg']  = 'Unable to Update Lesson';
        $_SESSION['edit_type'] = 'danger';
    }

    // PRG – redirect so refresh doesn't re-submit
    header("Location: editlesson.php?view=1&id={$lid}");
    exit;
}

// ── Pick up flash message ─────────────────────────────────────────────────
$msg = '';
if(isset($_SESSION['edit_msg'])){
    $type = htmlspecialchars($_SESSION['edit_type']);
    $text = htmlspecialchars($_SESSION['edit_msg']);
    $msg  = "<div class=\"alert alert-{$type} col-sm-12 mt-3\" role=\"alert\">{$text}</div>";
    unset($_SESSION['edit_msg'], $_SESSION['edit_type']);
}

include('./admininclude.php/header.php');

// ── Fetch the lesson row to display in the form ───────────────────────────
$row = null;
if(isset($_REQUEST['view']) || isset($_REQUEST['requpdate'])){
    $fetch_id = intval($_REQUEST['id'] ?? $_REQUEST['lesson_id'] ?? 0);
    if($fetch_id > 0){
        $result = $conn->query("SELECT * FROM lesson WHERE lesson_id = $fetch_id");
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();
        }
    }
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
  <h3 class="text-center">Update Lesson Details</h3>

  <?php if($msg !== '') echo $msg; ?>

  <?php if($row): ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="lesson_id">Lesson ID</label>
      <input type="text" class="form-control" id="lesson_id" name="lesson_id"
             value="<?php echo htmlspecialchars($row['lesson_id']); ?>" readonly>
    </div>
    <div class="form-group">
      <label for="lesson_name">Lesson Name</label>
      <input type="text" class="form-control" id="lesson_name" name="lesson_name"
             value="<?php echo htmlspecialchars($row['lession_name']); ?>">
    </div>
    <div class="form-group">
      <label for="lesson_desc">Lesson Description</label>
      <textarea class="form-control" id="lesson_desc" name="lesson_desc" rows="2"><?php echo htmlspecialchars($row['lession_desc']); ?></textarea>
    </div>
    <div class="form-group">
      <label for="course_id">Course ID</label>
      <input type="text" class="form-control" id="course_id" name="course_id"
             value="<?php echo htmlspecialchars($row['course_id']); ?>" readonly>
    </div>
    <div class="form-group">
      <label for="course_name">Course Name</label>
      <input type="text" class="form-control" id="course_name" name="course_name"
             value="<?php echo htmlspecialchars($row['course_name']); ?>" readonly>
    </div>
    <div class="form-group">
      <label>Current Lesson Video</label>
      <div class="embed-responsive embed-responsive-16by9 mb-2">
        <video class="embed-responsive-item" controls>
          <source src="<?php echo htmlspecialchars($row['lession_link']); ?>" type="video/mp4">
        </video>
      </div>
      <label for="lesson_link">Replace Video File (optional)</label>
      <input type="file" class="form-control-file" id="lesson_link" name="lesson_link" accept="video/*">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" name="requpdate">Update</button>
      <a href="lesson.php" class="btn btn-secondary">Close</a>
    </div>
  </form>
  <?php else: ?>
    <div class="alert alert-warning">Lesson not found.</div>
  <?php endif; ?>
</div>

<?php include('./admininclude.php/footer.php'); ?>