$(document).ready(function () {
  // Ajax Call for Already Exists Email Verification
  $("#stuemail").on("keypress blur", function () {
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var stuemail = $("#stuemail").val();

    // First check if email format is valid
    if (!reg.test(stuemail)) {
      $("#statusMsg2").html(
        '<small style="color:red;">Please Enter valid Email e.g. example@mail.com !</small>'
      );
      $("#signup").attr("disabled", true);
      return; // Stop ajax call if email is invalid
    }

    $.ajax({
      url: "Student/addstudent.php",
      method: "POST",
      data: {
        checkemail: "checkmail",
        stuemail: stuemail,
      },
      success: function (data) {
        if (data != 0) {
          $("#statusMsg2").html(
            '<small style="color:red;">Email ID Already Used</small>'
          );
          $("#signup").attr("disabled", true);
        } else {
          $("#statusMsg2").html(
            '<small style="color:green;">There You Go !</small>'
          );
          $("#signup").attr("disabled", false);
        }
      },
    });
  });
});







function addStu() {
    // Regex for basic email validation
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    
    var stuname = $("#stuname").val();
    var stuemail = $("#stuemail").val();
    var stupass = $("#reg_stupass").val();

    // 1. Check if Name is empty
    if (stuname.trim() == "") {
        $("#statusMsg1").html('<small style="color:red;">Please Enter Name!</small>');
        $("#stuname").focus();
        return false;
    } 
    // 2. Check if Email is empty or invalid
    else if (stuemail.trim() == "") {
        $("#statusMsg2").html('<small style="color:red;">Please Enter Email!</small>');
        $("#stuemail").focus();
        return false;
    } else if (stuemail.trim() != "" && !reg.test(stuemail)) {
        $("#statusMsg2").html('<small style="color:red;">Please Enter Valid Email! e.g. example@mail.com</small>');
        $("#stuemail").focus();
        return false;
    } 
    // 3. Check if Password is empty
    else if (stupass.trim() == "") {
        $("#statusMsg3").html('<small style="color:red;">Please Enter Password!</small>');
        $("#reg_stupass").focus();
        return false;
    } 
    // 4. If everything is valid, proceed with AJAX
    else {
        $.ajax({
            url: 'Student/addstudent.php',
            method: 'POST',
            data: {
                stusignup: 'stusignup',
                stuname: stuname,
                stuemail: stuemail,
                stupass: stupass,
            },
            success: function(data) {
                if (data.includes("OK")) {
                    $("#successMsg").html("<span class='alert alert-success'>Registration Successful!</span>");
                    clearStuRegField();
                } else {
                    $("#successMsg").html("<span class='alert alert-danger'>Unable to Register</span>");
                }
            },
            error: function() {
                $("#successMsg").html("<span class='alert alert-danger'>Server Error</span>");
            }
        });
    }
}

// Function to clear fields and error messages after success
function clearStuRegField() {
    $("#stuRegForm")[0].reset();
    $("#statusMsg1").html("");
    $("#statusMsg2").html("");
    $("#statusMsg3").html("");
}

// Ajax Call for Student Login Verification
function checkStuLogin() {
  var stuLogEmail = $("#stuLogemail").val();
  var stuLogPass = $("#stuLogpass").val();
  $.ajax({
    url: "Student/addstudent.php",
    method: "POST",
    data: {
      checkLogemail: "checklogmail",
      stuLogEmail: stuLogEmail,
      stuLogPass: stuLogPass,
    },
    success: function (data) {
        if (data == 0) {
  $("#statusLogMsg").html(
    '<small class="alert alert-danger">Invalid Email ID or Password !</small>'
  );
} else if (data == 1) {
  $("#statusLogMsg").html(
    '<div class="spinner-border text-success" role="status"></div>'
  );
  setTimeout(() => {
  window.location.href = "index.php";
}, 1000);
}
    },
  });
}




