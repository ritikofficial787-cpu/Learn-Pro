<?php
require_once('./auth_check.php');
$adminEmail = $_SESSION['adminLogEmail'];

include('./admininclude.php/header.php');
include('../dbConnection.php');

// Handle Delete Request before rendering the table to ensure the list is updated
if(isset($_REQUEST['delete'])){
    // Sanitize input to prevent SQL Injection
    $course_id = intval($_REQUEST['id']); 
    $sql = "DELETE FROM course WHERE course_id = $course_id";
    
    if($conn->query($sql) === TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    } else {
        echo '<div class="alert alert-danger">Unable to Delete Data</div>';
    }
}
?>

<div class="col-sm-9 mt-5">
    <p class="bg-dark text-white p-2">List of Courses</p>
    <?php
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Course ID</th>
                <th scope="col">Name</th>
                <th scope="col">Author</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()){ ?>
            <tr>
                <th scope="row"><?php echo $row['course_id']; ?></th>
                <td><?php echo $row['course_name']; ?></td>
                <td><?php echo $row['course_author']; ?></td>
                <td>
    <form action="editcourse.php" method="POST" class="d-inline">
    <input type="hidden" name="id" value="<?php echo $row['course_id']; ?>">
    <button type="submit" class="btn btn-info mr-3" name="view" value="View">
      <i class="fas fa-pen"></i>
    </button>
  </form>
                

                    <form action="" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $row['course_id']; ?>">
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
        echo "0 Result";
    }
    ?>
</div>

<a class="btn btn-danger" href="addCourse.php" style="position:fixed; bottom:30px; right:30px; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 10px rgba(0,0,0,0.3);">
    <i class="fas fa-plus fa-lg"></i>
</a>

<?php
include('./admininclude.php/footer.php');
?>