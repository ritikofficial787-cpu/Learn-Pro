function checkAdmin() {
    console.log("Login button clicked!"); // If you don't see this in F12, the button isn't calling the function

    var adminLogEmail = $("#adminLogemail").val();
    var adminLogPass = $("#adminLogpass").val();

    // Check if fields are empty before sending
    if (adminLogEmail.trim() == "" || adminLogPass.trim() == "") {
        $("#statusAdminLogMsg").html('<small class="alert alert-warning">Please fill all fields!</small>');
        return false;
    }

    $.ajax({
        url: "Admin/admin.php", 
        method: "POST",
        data: {
            checkLogmail: "checklogmail",
            adminLogEmail: adminLogEmail,
            adminLogPass: adminLogPass,
        },
        beforeSend: function() {
            $("#adminLoginBtn").html('<span class="spinner-border spinner-border-sm"></span> Loading...');
        },
        success: function (data) {
            console.log("Server Response: " + data);
            $("#adminLoginBtn").html('Login'); // Reset button text

            if (data.trim() == "1") {
                $("#statusAdminLogMsg").html('<small class="alert alert-success">Success! Redirecting...</small>');
                setTimeout(() => {
                    window.location.href = "Admin/adminDashboard.php";
                }, 1000);
            } else {
                $("#statusAdminLogMsg").html('<small class="alert alert-danger">Invalid Email or Password!</small>');
            }
        },
        error: function(err) {
            console.log("AJAX Error:", err);
            $("#adminLoginBtn").html('Login');
        }
    });
}