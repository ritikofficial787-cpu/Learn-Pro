<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Dark Mode Added: dark mode stylesheet -->
    <link rel="stylesheet" href="css/darkmode.css">
    <!-- Dark Mode Added: apply saved preference BEFORE paint to prevent flash -->
    <script>
        (function(){
            if(localStorage.getItem('learnpro_darkmode')==='1'){
                document.documentElement.classList.add('dark-mode');
                document.addEventListener('DOMContentLoaded',function(){
                    document.body.classList.add('dark-mode');
                });
            }
        })();
    </script>
    <title>LEARN PRO</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="index.php">LEARN PRO</a>
        <span class="navbar-text d-none d-lg-block">Learn and Implement</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="course.php">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="paymentstatus.php">Payment</a></li>
                
                <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['is_login'])) {
    echo '<li class="nav-item custom-nav-item">
            <a href="student/studentProfile.php" class="nav-link">My Profile</a>
          </li>
          <li class="nav-item custom-nav-item">
            <a href="logout.php" class="nav-link">Logout</a>
          </li>';
} else {
    echo '<li class="nav-item custom-nav-item">
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#stuLoginModalCenter">Login</a>
          </li>
          <li class="nav-item custom-nav-item">
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#stuRegModalCenter">Signup</a>
          </li>';
}
?>
            
                <li class="nav-item"><a class="nav-link" href="#feedback">Feedback</a></li>
                <li class="nav-item"><a class="nav-link" href="#Contact">Contact</a></li>
                <!-- Dark Mode Added: Toggle button -->
                <li class="nav-item d-flex align-items-center">
                    <button id="darkModeToggle" title="Switch to Dark Mode" aria-label="Switch to Dark Mode">🌙</button>
                </li>
                <!-- End Dark Mode Added -->
            </ul>
        </div>
    </div>
</nav>
</body>
</html>