<div class="container mt-5 py-5" id="Contact">
    <h2 class="text-center mb-5 fw-bold" style="font-family: 'Ubuntu', sans-serif;">Contact Us</h2>
    <div class="row align-items-center">
        <!-- Contact Form Column -->
        <div class="col-md-8 px-lg-5">
            <form action="" method="post" id="contactForm" class="shadow p-4 rounded bg-white">
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Name</label>
                    <input type="text" class="form-control border-0 bg-light py-2" id="name" name="name" placeholder="Enter your name">
                    <span id="nameError" class="text-danger small fw-bold"></span>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label fw-semibold">Subject</label>
                    <input type="text" class="form-control border-0 bg-light py-2" id="subject" name="subject" placeholder="What is this about?">
                    <span id="subjectError" class="text-danger small fw-bold"></span>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email" class="form-control border-0 bg-light py-2" id="email" name="email" placeholder="example@gmail.com">
                    <span id="emailError" class="text-danger small fw-bold"></span>
                </div>
                <div class="mb-4">
                    <label for="message" class="form-label fw-semibold">How can we help you?</label>
                    <textarea class="form-control border-0 bg-light py-2" id="message" name="message" placeholder="Type your message here..." style="height:150px; resize: none;"></textarea>
                    <span id="messageError" class="text-danger small fw-bold"></span>
                </div>
                <button class="btn btn-primary btn-lg shadow-sm w-100" type="submit" name="submit" id="contactBtn">
                    <i class="fas fa-paper-plane me-2"></i> Send Message
                </button>
            </form>
        </div>

        <!-- Contact Info Column -->
        <div class="col-md-4 mt-5 mt-md-0">
            <div class="contact-card bg-danger text-white p-5 rounded-4 shadow-lg text-center" style="transform: rotate(5deg);">
                <div class="mb-4">
                    <i class="fas fa-graduation-cap fa-3x"></i>
                </div>
                <h3 class="fw-bold mb-3">LEARN PRO</h3>
                <p class="mb-4 opacity-75 small">Empowering learners worldwide through quality education and hands-on implementation.</p>
                
                <hr class="border-white opacity-25 mb-4">
                
                <div class="text-start">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-map-marker-alt me-3 fs-5"></i>
                        <span class="small">Rajkot, Gujarat - 360003</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-phone-alt me-3 fs-5"></i>
                        <span class="small">+91 9106610455</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-globe me-3 fs-5"></i>
                        <span class="small">www.learnpro.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery Script for Validation and Popup -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors
            $('.text-danger').text('');
            
            let name = $('#name').val().trim();
            let subject = $('#subject').val().trim();
            let email = $('#email').val().trim();
            let message = $('#message').val().trim();
            let emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            let isValid = true;

            if(name === "") {
                $('#nameError').text('Please Enter Name !');
                isValid = false;
            }
            if(subject === "") {
                $('#subjectError').text('Please Enter Subject !');
                isValid = false;
            }
            if(email === "") {
                $('#emailError').text('Please Enter Email !');
                isValid = false;
            } else if(!emailReg.test(email) || !email.includes("@")) {
                $('#emailError').text('Please Enter valid Email e.g. example@mail.com !');
                isValid = false;
            }
            if(message === "") {
                $('#messageError').text('Please Enter Message !');
                isValid = false;
            }

            if(isValid) {
                alert("Message Send Successfully!");
                $('#contactForm').trigger("reset");
            }
        });
    });
</script>

<style>
    .contact-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .contact-card:hover {
        transform: rotate(0deg) scale(1.05) !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
    }
    .form-control:focus {
        box-shadow: none;
        background-color: #fff !important;
        border: 1px solid var(--bs-primary) !important;
    }
</style>