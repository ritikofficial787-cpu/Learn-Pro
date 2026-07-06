<?php 
  // Line 2: Added a slash between the folder and the filename
  include 'maininclude/header.php'; 
  include 'dbConnection.php';
?>

<!-- Hero Banner with books image (same as payment page) -->
<div class="container-fluid bg-dark p-0">
    <div class="row m-0">
        <img src="./image/courseimg/books.jpg" alt="All Courses" style="height:500px; width:100%; object-fit:cover; box-shadow:0 4px 20px rgba(0,0,0,0.5);"/>
    </div>
</div>

<!-- All Courses Section on white background so text is visible -->
<style>
.course-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}
</style>

<div class="container mt-5 mb-5">
    <h1 class="text-center mb-5" style="color:#1a1a2e; font-weight:700;">All Courses</h1>

    <!-- Search Bar Added -->
    <div class="text-center mb-4">
        <input
            type="text"
            id="courseSearchInput"
            placeholder="Search courses..."
            oninput="filterCourses()"
            style="
                width: 100%;
                max-width: 480px;
                padding: 10px 18px;
                font-size: 15px;
                border: 2px solid #1a1a2e;
                border-radius: 30px;
                outline: none;
                color: #1a1a2e;
                background: #fff;
                box-shadow: 0 2px 8px rgba(26,26,46,0.10);
                transition: border-color 0.2s;
            "
            onfocus="this.style.borderColor='#0d6efd'"
            onblur="this.style.borderColor='#1a1a2e'"
        />
    </div>
    <!-- End Search Bar Added -->

    <!-- ===== ORIGINAL STATIC COURSES (unchanged) ===== -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/guitar.jpg" class="course-img" alt="Learn Guitar">
                <div class="card-body">
                    <h5 class="card-title" style="color:#1a1a2e;">Learn Guitar</h5>
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
                <img src="image/courseimg/python.jpg" class="course-img" alt="Learn Python">
                <div class="card-body">
                    <h5 class="card-title" style="color:#1a1a2e;">Learn Python</h5>
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
                <img src="image/courseimg/webdesign.png" class="course-img" alt="Web Design">
                <div class="card-body">
                    <h5 class="card-title" style="color:#1a1a2e;">Web Design</h5>
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
                <img src="image/courseimg/android.png" class="course-img" alt="Android App Dev">
                <div class="card-body">
                    <h5 class="card-title" style="color:#1a1a2e;">Android App Dev</h5>
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

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/ios.png" class="course-img" alt="iOS Development">
                <div class="card-body"><h5 style="color:#1a1a2e;">iOS Development</h5><p class="small text-muted">Master Swift and Xcode.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 1500</span><a href="payment.php?title=iOS+Development&price=1500&img=ios.png&desc=Master+Swift+and+Xcode.&duration=40+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/dataanalysis.png" class="course-img" alt="Data Analysis">
                <div class="card-body"><h5 style="color:#1a1a2e;">Data Analysis</h5><p class="small text-muted">Analyze data with Excel and SQL.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 850</span><a href="payment.php?title=Data+Analysis&price=850&img=dataanalysis.png&desc=Analyze+data+with+Excel+and+SQL.&duration=25+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/php.png" class="course-img" alt="PHP Masterclass">
                <div class="card-body"><h5 style="color:#1a1a2e;">PHP Masterclass</h5><p class="small text-muted">Server-side programming with MySQL.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 599</span><a href="payment.php?title=PHP+Masterclass&price=599&img=php.png&desc=Server-side+programming+with+MySQL.&duration=30+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/reactjs.png" class="course-img" alt="React JS">
                <div class="card-body"><h5 style="color:#1a1a2e;">React JS</h5><p class="small text-muted">Build modern single-page applications.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 1100</span><a href="payment.php?title=React+JS&price=1100&img=reactjs.png&desc=Build+modern+single-page+applications.&duration=35+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/hacking.png" class="course-img" alt="Ethical Hacking">
                <div class="card-body"><h5 style="color:#1a1a2e;">Ethical Hacking</h5><p class="small text-muted">Learn cybersecurity and penetration testing.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 1999</span><a href="payment.php?title=Ethical+Hacking&price=1999&img=hacking.png&desc=Learn+cybersecurity+and+penetration+testing.&duration=60+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/javadeep.png" class="course-img" alt="Java Deep Dive" onerror="this.src='image/courseimg/books.jpg'">
                <div class="card-body"><h5 style="color:#1a1a2e;">Java Deep Dive</h5><p class="small text-muted">Advanced Java concepts and DSA.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 799</span><a href="payment.php?title=Java+Deep+Dive&price=799&img=books.jpg&desc=Advanced+Java+concepts+and+DSA.&duration=45+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/download (4).jpg" class="course-img" alt="C++ for Beginners" onerror="this.src='image/courseimg/books.jpg'">
                <div class="card-body"><h5 style="color:#1a1a2e;">C++ for Beginners</h5><p class="small text-muted">Foundations of programming and logic.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 450</span><a href="payment.php?title=C%2B%2B+for+Beginners&price=450&img=books.jpg&desc=Foundations+of+programming+and+logic.&duration=20+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/graphic.png" class="course-img" alt="Graphic Design" onerror="this.src='image/courseimg/books.jpg'">
                <div class="card-body"><h5 style="color:#1a1a2e;">Graphic Design</h5><p class="small text-muted">Master Photoshop and Illustrator.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 900</span><a href="payment.php?title=Graphic+Design&price=900&img=graphic.png&desc=Master+Photoshop+and+Illustrator.&duration=25+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/digital_marketing.png" class="course-img" alt="Digital Marketing" onerror="this.src='image/courseimg/books.jpg'">
                <div class="card-body"><h5 style="color:#1a1a2e;">Digital Marketing</h5><p class="small text-muted">SEO, SEM, and Social Media strategies.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 550</span><a href="payment.php?title=Digital+Marketing&price=550&img=books.jpg&desc=SEO,+SEM,+and+Social+Media+strategies.&duration=30+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/images.jpg" class="course-img" alt="Node JS" onerror="this.src='image/courseimg/books.jpg'">
                <div class="card-body"><h5 style="color:#1a1a2e;">Node JS</h5><p class="small text-muted">Backend development with Javascript.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 899</span><a href="payment.php?title=Node+JS&price=899&img=books.jpg&desc=Backend+development+with+Javascript.&duration=35+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/flutter.png" class="course-img" alt="Flutter Mobile" onerror="this.src='image/courseimg/books.jpg'">
                <div class="card-body"><h5 style="color:#1a1a2e;">Flutter Mobile</h5><p class="small text-muted">Cross-platform apps with Dart.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 1250</span><a href="payment.php?title=Flutter+Mobile&price=1250&img=flutter.png&desc=Cross-platform+apps+with+Dart.&duration=40+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/cloud.png" class="course-img" alt="Cloud Computing" onerror="this.src='image/courseimg/books.jpg'">
                <div class="card-body"><h5 style="color:#1a1a2e;">Cloud Computing</h5><p class="small text-muted">Introduction to AWS and Azure.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 1800</span><a href="payment.php?title=Cloud+Computing&price=1800&img=books.jpg&desc=Introduction+to+AWS+and+Azure.&duration=45+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="image/courseimg/ml.png" class="course-img" alt="Machine Learning" onerror="this.src='image/courseimg/books.jpg'">
                <div class="card-body"><h5 style="color:#1a1a2e;">Machine Learning</h5><p class="small text-muted">Algorithms and Predictive Modeling.</p></div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between"><span class="font-weight-bold">&#8377; 2500</span><a href="payment.php?title=Machine+Learning&price=2500&img=ml.png&desc=Algorithms+and+Predictive+Modeling.&duration=60+Days" class="btn btn-primary btn-sm">Enroll</a></div>
            </div>
        </div>

        <!-- ===== ADMIN-ADDED COURSES FROM DATABASE (appended at the end) ===== -->
        <?php
        $sql    = "SELECT * FROM course ORDER BY course_id ASC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
                // Normalise image path for frontend
                $rawImg = $row['course_img'] ?? '';
                if ($rawImg !== '') {
                    $imgSrc = ltrim(str_replace(['../','./'], '', $rawImg), '/');
                    if (strpos($imgSrc, '/') === false && $imgSrc !== '') {
                        $imgSrc = 'image/courseimg/' . $imgSrc;
                    }
                } else {
                    $imgSrc = 'image/courseimg/books.jpg';
                }

                $courseId    = intval($row['course_id']);
                $courseName  = htmlspecialchars($row['course_name']);
                $courseDesc  = htmlspecialchars($row['course_desc']);
                $coursePrice = htmlspecialchars($row['course_price']);
                $enrollUrl   = "payment.php?course_id={$courseId}";

                echo <<<HTML
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{$imgSrc}" class="course-img" alt="{$courseName}" onerror="this.src='image/courseimg/books.jpg'">
                <div class="card-body">
                    <h5 class="card-title" style="color:#1a1a2e;">{$courseName}</h5>
                    <p class="card-text small text-muted">{$courseDesc}</p>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">&#8377; {$coursePrice}</span>
                        <a href="{$enrollUrl}" class="btn btn-primary btn-sm">Enroll</a>
                    </div>
                </div>
            </div>
        </div>
HTML;
            endwhile;
        endif;
        ?>
        <!-- ===== END ADMIN-ADDED COURSES ===== -->
    </div>

    <!-- Search Bar Added: No results message -->
    <div id="noCoursesMsg" style="display:none; text-align:center; color:#888; font-size:17px; margin-top:20px; margin-bottom:10px;">
        No courses found
    </div>
    <!-- End Search Bar Added: No results message -->

</div>

<!-- Search Bar Added: JavaScript for real-time filtering -->
<script>
    function filterCourses() {
        // Search Bar Added
        var query = document.getElementById('courseSearchInput').value.toLowerCase().trim();
        // Get all course card columns (direct children col-md-3 inside the container rows)
        var cards = document.querySelectorAll('.container .col-md-3');
        var visibleCount = 0;

        cards.forEach(function(col) {
            // Search Bar Added: find the card title h5 inside this column
            var titleEl = col.querySelector('.card-title, .card-body h5');
            var title = titleEl ? titleEl.textContent.toLowerCase() : '';

            if (query === '' || title.indexOf(query) !== -1) {
                col.style.display = '';
                visibleCount++;
            } else {
                col.style.display = 'none';
            }
        });

        // Search Bar Added: show or hide the "No courses found" message
        var msg = document.getElementById('noCoursesMsg');
        if (visibleCount === 0 && query !== '') {
            msg.style.display = 'block';
        } else {
            msg.style.display = 'none';
        }
    }
</script>
<!-- End Search Bar Added -->

<?php 
  // Line 9: Added the folder name because footer.php is also inside maininclude
  include 'maininclude/footer.php'; 
?>
