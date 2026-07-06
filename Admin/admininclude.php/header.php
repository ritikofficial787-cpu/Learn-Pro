<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="../css/adminstyle.css">
</head>

<body>
    <nav class="navbar navbar-dark fixed-top p-0 shadow" style="background-color: #225470;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="adminDashboard.php">Learn Pro <small class="text-white">Admin Area</small></a>
    </nav>

    <div class="container-fluid mb-5" style="margin-top:40px;">
        <div class="row">
            <nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="adminDashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="courses.php"><i class="fab fa-accessible-icon"></i> Courses</a></li>
                        <li class="nav-item"><a class="nav-link" href="lesson.php"><i class="fas fa-book"></i> Lessons</a></li>
                        <li class="nav-item"><a class="nav-link" href="students.php"><i class="fas fa-user-graduate"></i> Students</a></li>
                        <li class="nav-item"><a class="nav-link" href="sellreport.php"><i class="fas fa-chart-line"></i> Sell Report</a></li>
                        <li class="nav-item"><a class="nav-link" href="feedback.php"><i class="fas fa-comments"></i> Feedback</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-credit-card"></i> Payment Status</a></li>
                        <li class="nav-item"><a class="nav-link" href="adminChangePass.php"><i class="fas fa-key"></i> Change Password</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </nav>
