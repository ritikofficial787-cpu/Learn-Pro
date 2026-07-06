<?php 
  include 'maininclude/header.php'; 
?>

<div class="container-fluid bg-dark p-0">
    <div class="row">
        <img src="./image/courseimg/books.jpg" alt="course" style="height:500px; width:100%; object-fit:cover;">
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center my-4">Payment Status</h2>
    
    <form method="post" action="" class="row justify-content-center">
        <div class="col-auto d-flex align-items-center">
            <label class="fw-bold me-2">Order ID:</label>
            <input type="text" class="form-control" style="width: 250px;">
            <input type="submit" class="btn btn-primary ms-3" value="View">
        </div>
    </form>
</div>

<?php 
  include 'contact.php'; 
?>

<?php 
  include 'maininclude/footer.php'; 
?>
