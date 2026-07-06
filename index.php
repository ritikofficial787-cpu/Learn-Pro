<?php
include 'dbConnection.php';
include 'maininclude/header.php';
?>



<div class="container-fluid remove-vid-marg">
    <div class="vid-parent"> <video playsinline autoplay muted loop>
            <source src="video/banvid.mp4" type="video/mp4">
        </video>
        <div class="vid-overlay"></div>

        <div class="vid-content">
            <h1 class="my-content">Welcome to Learn Pro</h1>
            <small class="my-content">Learn and Implement</small><br>

            <?php
            if (!isset($_SESSION['is_login'])) {
                echo '<a href="#" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#stuRegModalCenter">Get Started</a>';
            } else {
                echo '<a href="student/studentProfile.php" class="btn btn-primary mt-3">My Profile</a>';
            }
            ?>
        </div>
    </div>
</div>



</div>
</div>
<div class="container-fluid bg-danger txt-banner">
    <div class="row bottom-banner">
        <div class="col-sm">
            <h5><i class="fas fa-book-open mr-3"></i> 100+ Online Courses</h5>
        </div>
        <div class="col-sm">
            <h5><i class="fas fa-users mr-3"></i>Expert Instructor</h5>
        </div>
        <div class="col-sm">
            <h5><i class="fas fa-keyboard mr-3"></i>Lifetime Access</h5>
        </div>
        <div class="col-sm">
            <h5><i class="fas fa-rupee-sign mr-3"></i>Money Back Guarantee*</h5>
        </div>
    </div>
</div>

<!-- ===================== POPULAR COURSES (Dynamic from DB) ===================== -->
<div class="container mt-5">
    <h1 class="text-center mb-5">Popular Courses</h1>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/guitar.jpg" class="card-img-top" alt="Guitar" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Learn Guitar</h5>
                    <p class="card-text small text-muted">Master the strings from scratch with step-by-step lessons.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">&#8377; 2000</span>
                        <a href="payment.php?title=Learn+Guitar&price=2000&img=guitar.jpg&desc=Master+the+strings+from+scratch+with+step-by-step+lessons.&duration=20+Days" class="btn btn-primary btn-sm">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/python.jpg" class="card-img-top" alt="Python" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Learn Python</h5>
                    <p class="card-text small text-muted">Unlock the power of the world's most popular language.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">&#8377; 499</span>
                        <a href="payment.php?title=Learn+Python&price=499&img=python.jpg&desc=Unlock+the+power+of+the+world%27s+most+popular+language.&duration=30+Days" class="btn btn-primary btn-sm">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/webdesign.png" class="card-img-top" alt="Web Design" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Web Design</h5>
                    <p class="card-text small text-muted">Learn UI/UX principles and responsive layouts.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">&#8377; 699</span>
                        <a href="payment.php?title=Web+Design&price=699&img=webdesign.png&desc=Learn+UI%2FUX+principles+and+responsive+layouts.&duration=15+Days" class="btn btn-primary btn-sm">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/android.png" class="card-img-top" alt="Android" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Android App Dev</h5>
                    <p class="card-text small text-muted">Build mobile applications using Kotlin and Java.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">&#8377; 999</span>
                        <a href="payment.php?title=Android+App+Dev&price=999&img=android.png&desc=Build+mobile+applications+using+Kotlin+and+Java.&duration=45+Days" class="btn btn-primary btn-sm">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Static Courses Row 2 -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/php.png" class="card-img-top" alt="PHP" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">PHP Masterclass</h5>
                    <p class="card-text small text-muted">Server-side programming with MySQL and real-world projects.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">&#8377; 599</span>
                        <a href="payment.php?title=PHP+Masterclass&price=599&img=php.png&desc=Server-side+programming+with+MySQL+and+real-world+projects.&duration=30+Days" class="btn btn-primary btn-sm">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/ml.png" class="card-img-top" alt="Machine Learning" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Machine Learning</h5>
                    <p class="card-text small text-muted">Dive into AI and build your first predictive models.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">&#8377; 2500</span>
                        <a href="payment.php?title=Machine+Learning&price=2500&img=ml.png&desc=Dive+into+AI+and+build+your+first+predictive+models.&duration=60+Days" class="btn btn-primary btn-sm">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/graphic.png" class="card-img-top" alt="Graphic Design" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Graphic Design</h5>
                    <p class="card-text small text-muted">Master tools like Photoshop and Illustrator.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">&#8377; 999</span>
                        <a href="payment.php?title=Graphic+Design&price=999&img=graphic.png&desc=Master+tools+like+Photoshop+and+Illustrator.&duration=20+Days" class="btn btn-primary btn-sm">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/flutter.png" class="card-img-top" alt="Flutter" style="height: 160px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Flutter Development</h5>
                    <p class="card-text small text-muted">Build cross-platform mobile apps using Google's UI toolkit.</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">&#8377; 1500</span>
                        <a href="payment.php?title=Flutter+Development&price=1500&img=flutter.png&desc=Build+cross-platform+mobile+apps+using+Google%27s+UI+toolkit.&duration=40+Days" class="btn btn-primary btn-sm">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a class="btn btn-danger btn-lg px-5" href="course.php">View All Courses</a>
    </div>
</div>
<!-- ===================== END POPULAR COURSES ===================== -->

<?php
include 'contact.php';
?>
<div class="container-fluid py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Mentor Image -->
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <img src="image/mentor.png" alt="Roshni Ma'am" class="img-fluid" style="max-height: 450px;">
            </div>
            <!-- Mentor Content -->
            <div class="col-md-7 px-lg-5">
                <div class="d-flex align-items-center mb-3">
                    <h2 class="fw-bold mb-0" style="color: #1e293b;">About Roshni Ma'am</h2>
                    <a href="https://youtu.be/sX6gEwH-SA4?si=hbEg7558oFJX55Ut" target="_blank" class="ms-3 text-primary fs-3"><i class="far fa-play-circle"></i></a>
                </div>
                <p class="text-muted lh-lg" style="text-align: justify; font-size: 0.95rem;">
                    Passionate about teaching, **Roshni** was one of the pioneers who started teaching on YouTube back in 2011. 
                    Determined to build a free education platform, she has herself created **more than 5000 video lessons** on various 
                    subjects from Classes 6-12. Her engaging and creative explanation is what makes her videos unique and highly engaging for students. 
                </p>
                <p class="text-muted lh-lg" style="text-align: justify; font-size: 0.95rem;">
                    Her determination to make learning interesting is what drives the content at **Learn Pro**. A recipient of 
                    **100 Women Achievers of India** by the President of India, Roshni says that her vision to make quality 
                    education accessible and affordable to all, is never going to change.
                </p>
                <div class="mt-4">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <div class="p-3 bg-white shadow-sm rounded-3">
                                <i class="fas fa-user-graduate text-primary mb-2"></i>
                                <h6 class="fw-bold mb-1">Education</h6>
                                <p class="small text-muted mb-0">Post Graduate in Science</p>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="p-3 bg-white shadow-sm rounded-3">
                                <i class="fas fa-briefcase text-primary mb-2"></i>
                                <h6 class="fw-bold mb-1">Experience</h6>
                                <p class="small text-muted mb-0">12+ Years of teaching</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===================== STUDENT FEEDBACK (Sliding Cards like reference image) ===================== -->
<div class="container-fluid mt-5 pb-5" style="background-color: #4B7289" id="feedback">
    <h1 class="text-center testyheading p-4 text-white">Student's Feedback</h1>
    <div class="container">

        <div style="position: relative;">
            <!-- Slider Wrapper (clips overflow) -->
            <div style="overflow: hidden;">
                <div id="testimonialTrack" style="display:flex; transition: transform 0.5s ease; gap: 20px;">

                    <!-- Card 1 -->
                    <div class="testi-card" style="min-width: calc(33.333% - 14px); background: rgba(255,255,255,0.08); border-left: 4px solid #e74c3c; border-radius: 8px; padding: 25px; box-sizing: border-box; color: #fff; display:flex; flex-direction:column; justify-content:space-between;">
                        <p style="font-size:0.95rem; line-height:1.7;">
                            "At Learn Pro, we believe that knowledge is only powerful when it is applied. Our platform is designed to take you beyond the screen into the real world of technology."
                        </p>
                        <div style="display:flex; align-items:center; gap:15px; margin-top:15px;">
                            <img src="image/stu/sunny.png" alt="Sunny Singh" style="width:65px; height:65px; border-radius:50%; object-fit:cover; border:3px solid rgba(255,255,255,0.4);">
                            <div>
                                <div style="font-weight:700; color:#f0c040;">Sunny Singh</div>
                                <div style="font-size:0.82rem; opacity:0.8;">Web Developer</div>
                                <div style="margin-top:4px;">
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="testi-card" style="min-width: calc(33.333% - 14px); background: rgba(255,255,255,0.08); border-left: 4px solid #e74c3c; border-radius: 8px; padding: 25px; box-sizing: border-box; color: #fff; display:flex; flex-direction:column; justify-content:space-between;">
                        <p style="font-size:0.95rem; line-height:1.7;">
                            "The 'Learn Python' course was a game-changer for me. It really showed me how to 'Learn and Implement' complex logic with just a few lines of code."
                        </p>
                        <div style="display:flex; align-items:center; gap:15px; margin-top:15px;">
                            <img src="image/stu/amanda.png" alt="Amanda Clarke" style="width:65px; height:65px; border-radius:50%; object-fit:cover; border:3px solid rgba(255,255,255,0.4);">
                            <div>
                                <div style="font-weight:700; color:#f0c040;">Amanda Clarke</div>
                                <div style="font-size:0.82rem; opacity:0.8;">Python Developer</div>
                                <div style="margin-top:4px;">
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star-half-alt" style="color:#f0c040; font-size:12px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="testi-card" style="min-width: calc(33.333% - 14px); background: rgba(255,255,255,0.08); border-left: 4px solid #e74c3c; border-radius: 8px; padding: 25px; box-sizing: border-box; color: #fff; display:flex; flex-direction:column; justify-content:space-between;">
                        <p style="font-size:0.95rem; line-height:1.7;">
                            "Learn Pro provides a robust curriculum that pairs expert instruction with lifetime access. Their money-back guarantee is a very solid assurance."
                        </p>
                        <div style="display:flex; align-items:center; gap:15px; margin-top:15px;">
                            <img src="image/stu/david.png" alt="David Li" style="width:65px; height:65px; border-radius:50%; object-fit:cover; border:3px solid rgba(255,255,255,0.4);">
                            <div>
                                <div style="font-weight:700; color:#f0c040;">David Li</div>
                                <div style="font-size:0.82rem; opacity:0.8;">Software Engineer</div>
                                <div style="margin-top:4px;">
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="testi-card" style="min-width: calc(33.333% - 14px); background: rgba(255,255,255,0.08); border-left: 4px solid #e74c3c; border-radius: 8px; padding: 25px; box-sizing: border-box; color: #fff; display:flex; flex-direction:column; justify-content:space-between;">
                        <p style="font-size:0.95rem; line-height:1.7;">
                            "The Web Design course helped me build beautiful, responsive websites from scratch. I got placed in a top company within 3 months of completing the course!"
                        </p>
                        <div style="display:flex; align-items:center; gap:15px; margin-top:15px;">
                            <img src="image/stu/sunny.png" alt="Priya Sharma" style="width:65px; height:65px; border-radius:50%; object-fit:cover; border:3px solid rgba(255,255,255,0.4);">
                            <div>
                                <div style="font-weight:700; color:#f0c040;">Priya Sharma</div>
                                <div style="font-size:0.82rem; opacity:0.8;">UI Designer</div>
                                <div style="margin-top:4px;">
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="testi-card" style="min-width: calc(33.333% - 14px); background: rgba(255,255,255,0.08); border-left: 4px solid #e74c3c; border-radius: 8px; padding: 25px; box-sizing: border-box; color: #fff; display:flex; flex-direction:column; justify-content:space-between;">
                        <p style="font-size:0.95rem; line-height:1.7;">
                            "Ethical Hacking course was mind-blowing! The instructors are industry experts and the content is updated regularly. Learn Pro is absolutely the best!"
                        </p>
                        <div style="display:flex; align-items:center; gap:15px; margin-top:15px;">
                            <img src="image/stu/david.png" alt="Rahul Verma" style="width:65px; height:65px; border-radius:50%; object-fit:cover; border:3px solid rgba(255,255,255,0.4);">
                            <div>
                                <div style="font-weight:700; color:#f0c040;">Rahul Verma</div>
                                <div style="font-size:0.82rem; opacity:0.8;">Cybersecurity Analyst</div>
                                <div style="margin-top:4px;">
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>
                                    <i class="fas fa-star-half-alt" style="color:#f0c040; font-size:12px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    // ── Dynamic feedback starts here ──────────────────────────────────────────
                    // Keep static testimonials unchanged (they are above this PHP block)
                    // Fetch approved feedback from the database, newest first
                    $fb_sql  = "SELECT id, name, course_name, rating, message
                                FROM feedback
                                WHERE status = 'approved'
                                ORDER BY created_at DESC";
                    $fb_result = $conn->query($fb_sql);

                    if ($fb_result && $fb_result->num_rows > 0) {
                        while ($fb = $fb_result->fetch_assoc()) {
                            // Sanitize output for safety
                            $fb_name    = htmlspecialchars($fb['name']);
                            $fb_course  = htmlspecialchars($fb['course_name']);
                            $fb_message = htmlspecialchars($fb['message']);
                            $fb_rating  = intval($fb['rating']);
                            // Clamp rating between 1 and 5
                            $fb_rating  = max(1, min(5, $fb_rating));

                            // Build star icons exactly like static cards
                            $stars = '';
                            for ($s = 1; $s <= $fb_rating; $s++) {
                                $stars .= '<i class="fas fa-star" style="color:#f0c040; font-size:12px;"></i>';
                            }
                            // Empty stars for remainder (to always total 5)
                            for ($s = $fb_rating + 1; $s <= 5; $s++) {
                                $stars .= '<i class="far fa-star" style="color:#f0c040; font-size:12px;"></i>';
                            }

                            // Render dynamic card — identical structure to static cards
                            echo '
                            <div class="testi-card" style="min-width: calc(33.333% - 14px); background: rgba(255,255,255,0.08); border-left: 4px solid #e74c3c; border-radius: 8px; padding: 25px; box-sizing: border-box; color: #fff; display:flex; flex-direction:column; justify-content:space-between;">
                                <p style="font-size:0.95rem; line-height:1.7;">
                                    &ldquo;' . $fb_message . '&rdquo;
                                </p>
                                <div style="display:flex; align-items:center; gap:15px; margin-top:15px;">
                                    <div style="width:65px; height:65px; border-radius:50%; background:rgba(255,255,255,0.2); display:flex; align-items:center; justify-content:center; border:3px solid rgba(255,255,255,0.4); font-size:1.5rem; color:#f0c040; flex-shrink:0;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight:700; color:#f0c040;">' . $fb_name . '</div>
                                        <div style="font-size:0.82rem; opacity:0.8;">' . $fb_course . '</div>
                                        <div style="margin-top:4px;">' . $stars . '</div>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                    // ── Dynamic feedback ends here ────────────────────────────────────────────
                    ?>

                </div><!-- end #testimonialTrack -->
            </div><!-- end overflow:hidden wrapper -->

            <!-- Navigation Arrows -->
            <div style="text-align: center; margin-top: 25px;">
                <button id="testiPrev" onclick="slideTestimonial(-1)" style="background:#e74c3c; color:#fff; border:none; padding:10px 22px; border-radius:4px; font-size:1rem; cursor:pointer; margin-right:8px; font-weight:bold;">&lt;&lt;</button>
                <button id="testiNext" onclick="slideTestimonial(1)"  style="background:#e74c3c; color:#fff; border:none; padding:10px 22px; border-radius:4px; font-size:1rem; cursor:pointer; font-weight:bold;">&gt;&gt;</button>
            </div>

            <!-- Share Your Feedback CTA -->
            <div style="text-align:center; margin-top:20px;">
                <?php if (isset($_SESSION['is_login'])): ?>
                    <a href="student/stufeedback.php"
                       style="display:inline-block; background:#e74c3c; color:#fff; padding:10px 28px; border-radius:4px; text-decoration:none; font-weight:600; font-size:0.95rem;">
                        <i class="fas fa-pen me-2"></i>Share Your Feedback
                    </a>
                <?php else: ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#stuLoginModalCenter"
                       style="display:inline-block; background:rgba(255,255,255,0.15); color:#fff; padding:10px 28px; border-radius:4px; text-decoration:none; font-weight:600; font-size:0.95rem; border:1px solid rgba(255,255,255,0.4);">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to Share Your Feedback
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <script>
        (function() {
            var track   = document.getElementById('testimonialTrack');
            var cards   = track.querySelectorAll('.testi-card');
            var total   = cards.length;
            var visible = 3;
            var current = 0;

            function getCardWidth() {
                return cards[0].offsetWidth + 20; // card width + gap
            }

            function updateSlider() {
                track.style.transform = 'translateX(-' + (current * getCardWidth()) + 'px)';
            }

            function getMax() {
                if (window.innerWidth < 576)  return total - 1;
                if (window.innerWidth < 992)  return total - 2;
                return total - 3;
            }

            window.slideTestimonial = function(dir) {
                current += dir;
                if (current < 0) current = 0;
                if (current > getMax()) current = getMax();
                updateSlider();
            };

            // Auto-slide every 4 seconds
            setInterval(function() {
                current++;
                if (current > getMax()) current = 0;
                updateSlider();
            }, 4000);

            window.addEventListener('resize', function() {
                if (current > getMax()) current = getMax();
                updateSlider();
            });
        })();
        </script>

    </div>
</div>
<!-- ===================== END STUDENT FEEDBACK ===================== -->

<div class="container-fluid bg-danger">
    <div class="row text-white text-center p-3">
        <div class="col-sm-3">
            <a class="text-white social-hover" href="#"><i class="fab fa-facebook-f mr-2"></i>FACEBOOK</a>
        </div>
        <div class="col-sm-3">
            <a class="text-white social-hover" href="#"><i class="fab fa-twitter mr-2"></i>Twitter</a>
        </div>
        <div class="col-sm-3">
            <a class="text-white social-hover" href="#"><i class="fab fa-whatsapp mr-2"></i>WhatsApp</a>
        </div>
        <div class="col-sm-3">
            <a class="text-white social-hover" href="#"><i class="fab fa-instagram mr-2"></i>Instagram</a>
        </div>
    </div>
</div>

<div class="container-fluid p-5" style="background-color: #E9ECEF">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <h5>About Us</h5>
                <p>Learn Pro provides Universal access to the world's best education, partnering with top Universities
                    and organizations to offer courses online.</p>
            </div>

            <div class="col-md-4 text-center">
                <h5>Category</h5>
                <ul class="list-unstyled">
                    <li><a class="text-dark" href="#">Web Development</a></li>
                    <li><a class="text-dark" href="#">Web Design</a></li>
                    <li><a class="text-dark" href="#">Android App Development</a></li>
                    <li><a class="text-dark" href="#">iOS Development</a></li>
                    <li><a class="text-dark" href="#">Data Analysis</a></li>
                </ul>
            </div>

            <div class="col-md-4 text-center">
                <h5>Contact Us</h5>
                <p>
                    Learn Pro Education Pvt Ltd<br>
                    Near Aji Dam Chokadi<br>
                    Rajkot, Gujarat<br>
                    <strong>Ph. 9106610455</strong>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
include 'maininclude/footer.php';
?>
