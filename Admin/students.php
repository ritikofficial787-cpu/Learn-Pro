



<?php
if(!isset($_SESSION)){
    session_start();
}

include('./admininclude.php/header.php');
include('../dbConnection.php');

if(isset($_SESSION['is_admin_login'])){
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}


// Handle Delete Request before rendering the table to ensure the list is updated
if(isset($_REQUEST['delete'])){
    $stu_id = intval($_REQUEST['id']); 
    $sql = "DELETE FROM student WHERE stu_id = $stu_id";
    
    if($conn->query($sql) === TRUE){
        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
    } else {
        echo '<div class="alert alert-danger">Unable to Delete Data</div>';
    }
}
?>

<div class="col-sm-9 mt-5">
    <p class="bg-dark text-white p-2">List of Student</p>
    <?php
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()){ ?>
            <tr>
                <th scope="row"><?php echo $row['stu_id']; ?></th>
                <td><?php echo $row['stu_name']; ?></td>
                <td><?php echo $row['stu_email']; ?></td>
                <td>
    <form action="editstudent.php" method="POST" class="d-inline">
    <input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>">
    <button type="submit" class="btn btn-info mr-3" name="view" value="View">
      <i class="fas fa-pen"></i>
    </button>
  </form>
                

                    <form action="" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $row['stu_id']; ?>">
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

<a class="btn btn-danger" href="addnewstudent.php" style="position:fixed; bottom:30px; right:30px; width:55px; height:55px; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 10px rgba(0,0,0,0.3);">
    <i class="fas fa-plus fa-lg"></i>
</a>

<?php
include('./admininclude.php/footer.php');
?>