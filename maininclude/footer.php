<footer class="container-fluid bg-dark text-center p-3 mt-5">
    <small class="text-white">
        Copyright &copy; 2026 || Designed By Ritik Singh || 
        <a href="#adminLogin" class="text-white" data-bs-toggle="modal" data-bs-target="#adminLoginModalCenter"> Admin Login</a>
    </small>
</footer>
<div class="modal fade" id="stuRegModalCenter" tabindex="-1" aria-labelledby="stuRegModalCenterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="stuRegModalCenterLabel">Student Registration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="stuRegForm">
            <div class="mb-3">
                <i class="fas fa-user"></i>
                <label for="stuname" class="form-label fw-bold">Name</label> 
                <small id="statusMsg1"></small>
                <input type="text" class="form-control" placeholder="Name" name="stuname" id="stuname">
            </div>
            <div class="mb-3">
                <i class="fas fa-envelope"></i>
                <label for="stuemail" class="form-label fw-bold">Email address</label> 
                <small id="statusMsg2"></small>
                <input type="email" class="form-control" id="stuemail" placeholder="example@gmail.com">
                <div class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <i class="fas fa-key"></i>
                <label for="stupass" class="form-label fw-bold">Password</label> 
                <small id="statusMsg3"></small>
                <input type="password" class="form-control" placeholder="password" name="stupass" id="reg_stupass">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <small id="successMsg"></small> 
        <span class="me-auto text-muted">Already have an account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#stuLoginModalCenter" class="text-primary fw-bold text-decoration-none">Login</a></span>
        <button type="button" class="btn btn-primary" onclick="addStu()" id="signup">Sign Up</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="stuLoginModalCenter" tabindex="-1" aria-labelledby="stuLoginModalCenterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="stuLoginModalCenterLabel">Student Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="stuLoginForm">
          <div class="mb-3">
            <label for="stuLogemail" class="form-label">Email</label>
            <input type="email" class="form-control" id="stuLogemail" placeholder="Enter email">
          </div>
          <div class="mb-3">
            <label for="stuLogpass" class="form-label">Password</label>
            <input type="password" class="form-control" id="stuLogpass" placeholder="Enter password">
          </div>
          <div class="text-end">
            <a href="forgot-password.php" class="text-danger small">
              <i class="fas fa-key"></i> Forgot Password?
            </a>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <small id="statusLogMsg"></small> 
        <button type="button" class="btn btn-primary" id="stuLoginBtn" onclick="checkStuLogin()">Login</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="adminLoginModalCenter" tabindex="-1" aria-labelledby="adminLoginModalCenterLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="adminLoginModalCenterLabel">Admin Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="adminLoginForm">
          <div class="mb-3">
            <label for="adminLogemail" class="form-label">Admin Email</label>
            <input type="email" class="form-control" id="adminLogemail" placeholder="Admin email">
          </div>
          <div class="mb-3">
            <label for="adminLogpass" class="form-label">Password</label>
            <input type="password" class="form-control" id="adminLogpass" placeholder="Admin password">
          </div>
          <div class="text-end">
            <a href="Admin/admin-forgot-password.php" class="text-danger small">
              <i class="fas fa-key"></i> Forgot Password?
            </a>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div id="statusAdminLogMsg" style="width: 100%; text-align: center;"></div> 
        <button type="button" class="btn btn-primary" id="adminLoginBtn" onclick="checkAdmin()">Login</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.min.js"></script>
<script src="js/testyslider.js"></script>
<script src="js/ajaxrequest.js"></script>
<script src="js/adminajaxrequest.js"></script>
<!-- Dark Mode Added: dark mode toggle script -->
<script src="js/darkmode.js"></script>
<!-- End Dark Mode Added -->
</body>
</html>