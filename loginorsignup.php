<?php
include('./dbConnection.php');
include('maininclude/header.php');
?>

<div class="container-fluid bg-dark">
    <!-- Start Course Page Banner -->
    <div class="row">
        <img src="./image/courseimg/books.jpg" alt="courses"
             style="height:300px; width:100%; object-fit:cover; box-shadow:10px;">
    </div>
    <!-- End Course Page Banner -->
</div>

<div class="container jumbotron mb-5 mt-5" style="background-color: #e2e8f0; border-radius: 8px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <div class="row">
        <div class="col-md-4">
            <h5 class="mb-4" style="font-weight: 600; color: #334155;">If Already Registered !! Login</h5>
            <form role="form" id="stuLoginForm">
                <div class="form-group mb-3">
                    <label for="stuLogEmail" class="font-weight-bold mb-1" style="font-size: 0.95rem; color: #475569;">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <small id="statusLogMsg1"></small>
                    <input type="email" class="form-control" placeholder="Email" name="stuLogEmail" id="stuLogemail" style="border: 1px solid #cbd5e1; padding: 10px; border-radius: 4px;">
                </div>
                <div class="form-group mb-4">
                    <label for="stuLogPass" class="font-weight-bold mb-1" style="font-size: 0.95rem; color: #475569;">
                        <i class="fas fa-key mr-2"></i>Password
                    </label>
                    <input type="password" class="form-control" placeholder="Password" name="stuLogPass" id="stuLogpass" style="border: 1px solid #cbd5e1; padding: 10px; border-radius: 4px;">
                </div>
                <button type="button" class="btn btn-primary px-4 py-2" id="stuLoginBtn" onclick="checkStuLogin()" style="font-weight: 500; border-radius: 4px;">Login</button>
            </form>
            <br/>
            <small id="statusLogMsg"></small>
        </div>

        <!-- Add vertical divider line if requested, based on image it has two columns side by side -->
        
        <div class="col-md-6 offset-md-1">
            <h5 class="mb-4" style="font-weight: 600; color: #334155;">New User !! Sign Up</h5>
            <form role="form" id="stuRegForm">
                <div class="form-group mb-3">
                    <label for="stuname" class="font-weight-bold mb-1" style="font-size: 0.95rem; color: #475569;">
                        <i class="fas fa-user mr-2"></i>Name
                    </label>
                    <small id="statusMsg1"></small>
                    <input type="text" class="form-control" placeholder="Name" name="stuname" id="stuname" style="border: 1px solid #cbd5e1; padding: 10px; border-radius: 4px;">
                </div>
                <div class="form-group mb-3">
                    <label for="stuemail" class="font-weight-bold mb-1" style="font-size: 0.95rem; color: #475569;">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <small id="statusMsg2"></small>
                    <input type="email" class="form-control" placeholder="Email" name="stuemail" id="stuemail" aria-describedby="emailHelp" style="border: 1px solid #cbd5e1; padding: 10px; border-radius: 4px;">
                    <small id="emailHelp" class="form-text text-muted" style="font-size: 0.8rem; margin-top: 4px;">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group mb-4">
                    <label for="stupass" class="font-weight-bold mb-1" style="font-size: 0.95rem; color: #475569;">
                        <i class="fas fa-key mr-2"></i>New Password
                    </label>
                    <small id="statusMsg3"></small>
                    <input type="password" class="form-control" placeholder="Password" name="stupass" id="reg_stupass" style="border: 1px solid #cbd5e1; padding: 10px; border-radius: 4px;">
                </div>
                <button type="button" class="btn btn-primary px-4 py-2" id="stuRegBtn" onclick="addStu()" style="font-weight: 500; border-radius: 4px;">Sign Up</button>
            </form>
            <br/>
            <small id="statusMsg"></small>
        </div>
    </div>
</div>

<?php 
include('./maininclude/footer.php'); 
?>
