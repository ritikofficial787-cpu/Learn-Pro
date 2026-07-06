<?php
if(!isset($_SESSION)){
    session_start();
}
require_once('./auth_check.php');
$adminEmail = $_SESSION['adminLogEmail'];

include('./admininclude.php/header.php');
include('../dbConnection.php');

$msg = '';

// Handle Delete Request
if(isset($_REQUEST['delete'])){
    $lesson_id = intval($_REQUEST['id']); 
    $sql = "DELETE FROM lesson WHERE lesson_id = $lesson_id";
    if($conn->query($sql) === TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    } else {
        $msg = '<div class="alert alert-danger col-sm-6 mt-2">Unable to Delete Data</div>';
    }
}
?>

<div class="col-sm-9 mt-5">

    <!-- Search Bar -->
    <form action="" method="GET" class="d-flex align-items-center mb-3" style="gap: 10px;">
        <label for="checkid" class="mb-0 text-nowrap font-weight-bold">Enter Course ID:</label>
        <input type="text" class="form-control" id="checkid" name="checkid" style="width: 200px;"
               value="<?php echo isset($_REQUEST['checkid']) ? htmlspecialchars($_REQUEST['checkid']) : ''; ?>">
        <button type="submit" class="btn btn-danger" style="background-color:#e74c3c; border-color:#e74c3c; white-space:nowrap;">Search</button>
    </form>

    <?php if($msg != '') { echo $msg; } ?>

    <?php 
    if(isset($_REQUEST['checkid']) && $_REQUEST['checkid'] != ""){
        $checkid = intval($_REQUEST['checkid']);
        $sql = "SELECT * FROM course WHERE course_id = $checkid";
        $result = $conn->query($sql);
        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['course_id']   = $row['course_id'];
            $_SESSION['course_name'] = $row['course_name'];

            // Fetch lessons for this course
            $sqlLesson = "SELECT * FROM lesson WHERE course_id = $checkid";
            $resultLesson = $conn->query($sqlLesson);
            ?>
            <div class="bg-dark text-white p-2 mt-4 font-weight-bold" style="font-size: 1.1rem;">
                Course Name: <?php echo htmlspecialchars($_SESSION['course_name']); ?>
            </div>
            <?php
            if($resultLesson->num_rows > 0){
                ?>
                <table class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Lesson Name</th>
                            <th scope="col">Lesson Link</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($rowLesson = $resultLesson->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rowLesson['lession_name']); ?></td>
                            <td><?php echo htmlspecialchars($rowLesson['lession_link']); ?></td>
                            <td>
                                <form action="editlesson.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $rowLesson['lesson_id']; ?>">
                                    <button type="submit" class="btn btn-info mr-3" name="view" value="View">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </form>
                                <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $rowLesson['lesson_id']; ?>">
                                    <input type="hidden" name="checkid" value="<?php echo htmlspecialchars($_REQUEST['checkid']); ?>">
                                    <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php 
            } else {
                echo "<p class='mt-3'>0 Result</p>";
            }
        } else {
            echo '<div class="alert alert-warning col-sm-6 mt-2" role="alert">Fill All Fields / Course Not Found</div>';
            unset($_SESSION['course_id']);
            unset($_SESSION['course_name']);
        }
    }
    ?>

</div>

<?php if(isset($_SESSION['course_id'])): ?>
    <!-- Floating Add Button -->
    <a class="btn btn-danger" href="addLesson.php" style="position:fixed; bottom:30px; right:30px; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 10px rgba(0,0,0,0.3); z-index:9999;">
        <i class="fas fa-plus fa-lg"></i>
    </a>
<?php endif; ?>

<?php
include('./admininclude.php/footer.php');
?>