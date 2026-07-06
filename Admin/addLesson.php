<?php
if(!isset($_SESSION)){
  session_start();
}
require_once('./auth_check.php');
$adminEmail = $_SESSION['adminLogEmail'];

include('../dbConnection.php');

// ── Handle form submission BEFORE any HTML output ──────────────────────────
if(isset($_POST['lessonSubmitBtn'])){

    $lesson_name = trim($_POST['lesson_name'] ?? '');
    $lesson_desc = trim($_POST['lesson_desc'] ?? '');
    $course_id   = trim($_POST['course_id']   ?? '');
    $course_name = trim($_POST['course_name'] ?? '');

    if($lesson_name === '' || $lesson_desc === '' || $course_id === '' || $course_name === ''){
        $_SESSION['lesson_msg']  = 'Fill All Fields';
        $_SESSION['lesson_type'] = 'warning';
        header('Location: addLesson.php');
        exit;
    }

    // Validate & move uploaded video file
    if(!isset($_FILES['lesson_link']) || $_FILES['lesson_link']['error'] !== UPLOAD_ERR_OK || $_FILES['lesson_link']['name'] === ''){
        $_SESSION['lesson_msg']  = 'Please upload a valid video file';
        $_SESSION['lesson_type'] = 'warning';
        header('Location: addLesson.php');
        exit;
    }

    $link_folder = '../lessonvid/' . basename($_FILES['lesson_link']['name']);
    move_uploaded_file($_FILES['lesson_link']['tmp_name'], $link_folder);

    // Sanitize before inserting
    $s_name   = $conn->real_escape_string($lesson_name);
    $s_desc   = $conn->real_escape_string($lesson_desc);
    $s_link   = $conn->real_escape_string($link_folder);
    $s_cid    = intval($course_id);
    $s_cname  = $conn->real_escape_string($course_name);

    $sql = "INSERT INTO lesson (lession_name, lession_desc, lession_link, course_id, course_name)
            VALUES ('$s_name', '$s_desc', '$s_link', $s_cid, '$s_cname')";

    if($conn->query($sql) === TRUE){
        $_SESSION['lesson_msg']  = 'Lesson Added Successfully';
        $_SESSION['lesson_type'] = 'success';
    } else {
        $_SESSION['lesson_msg']  = 'Unable to Add Lesson: ' . $conn->error;
        $_SESSION['lesson_type'] = 'danger';
    }

    // PRG – redirect so refresh never re-submits
    header('Location: addLesson.php');
    exit;
}

// ── Detect when PHP silently drops POST due to exceeding post_max_size ─────
if($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST) && empty($_FILES)){
    $maxSize = ini_get('post_max_size');
    $_SESSION['lesson_msg']  = "Upload failed: file exceeds the server limit ($maxSize). Please upload a smaller video or ask your hosting provider to increase the upload_max_filesize and post_max_size in php.ini.";
    $_SESSION['lesson_type'] = 'danger';
    header('Location: addLesson.php');
    exit;
}

// ── Pick up flash message set before the redirect ──────────────────────────
$msg = '';
if(isset($_SESSION['lesson_msg'])){
    $type = htmlspecialchars($_SESSION['lesson_type']);
    $text = htmlspecialchars($_SESSION['lesson_msg']);
    $msg  = "<div class=\"alert alert-{$type} col-sm-12 mt-3\" role=\"alert\">{$text}</div>";
    unset($_SESSION['lesson_msg'], $_SESSION['lesson_type']);
}

include('./admininclude.php/header.php');
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
  <h3 class="text-center">Add New Lesson</h3>

  <?php if($msg !== '') echo $msg; ?>

  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="course_id">Course ID</label>
      <input type="text" class="form-control" id="course_id" name="course_id"
        value="<?php echo isset($_SESSION['course_id']) ? intval($_SESSION['course_id']) : ''; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="course_name">Course Name</label>
      <input type="text" class="form-control" id="course_name" name="course_name"
        value="<?php echo isset($_SESSION['course_name']) ? htmlspecialchars($_SESSION['course_name']) : ''; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="lesson_name">Lesson Name</label>
      <input type="text" class="form-control" id="lesson_name" name="lesson_name">
    </div>
    <div class="form-group">
      <label for="lesson_desc">Lesson Description</label>
      <textarea class="form-control" id="lesson_desc" name="lesson_desc" rows="2"></textarea>
    </div>
    <div class="form-group">
      <label for="lesson_link">Lesson Video File</label>
      <input type="file" class="form-control-file" id="lesson_link" name="lesson_link" accept="video/*">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" name="lessonSubmitBtn">Submit</button>
      <a href="lesson.php" class="btn btn-secondary">Close</a>
    </div>
  </form>
</div>

<?php include('./admininclude.php/footer.php'); ?>