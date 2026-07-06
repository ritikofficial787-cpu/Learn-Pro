<?php 
  include 'maininclude/header.php'; 
  include 'dbConnection.php';

  // Default fallback values
  $course_name = "Learn Guitar";
  $course_desc = "Best Guitar Course Available Online.<br>You also learn about other instruments.";
  $duration = "20 Days";
  $price = "2000";
  $img = "guitar.jpg";

  $has_db_lessons = false;
  $c_id = null;

  // Check if real DB course ID is provided
  if(isset($_GET['course_id']) && is_numeric($_GET['course_id'])){
      $c_id = $_GET['course_id'];
      $sql = "SELECT * FROM course WHERE course_id = '$c_id'";
      $result = $conn->query($sql);
      if($result && $result->num_rows > 0){
          $row = $result->fetch_assoc();
          $course_name = $row['course_name'];
          $course_desc = $row['course_desc'];
          $duration = $row['course_duration'];
          $price = $row['course_price'];
          $img_path = $row['course_img']; 
          $has_db_lessons = true;
      }
  } elseif(isset($_GET['title'])) {
      // Get from URL parameters for static homepage cards
      $course_name = $_GET['title'];
      $course_desc = isset($_GET['desc']) ? $_GET['desc'] : $course_desc;
      $price = isset($_GET['price']) ? $_GET['price'] : $price;
      $duration = isset($_GET['duration']) ? $_GET['duration'] : $duration;
      $img = isset($_GET['img']) ? $_GET['img'] : $img;
  }
  
  $img_src = isset($img_path) ? str_replace('..', '.', $img_path) : "./image/courseimg/" . $img;
?>

<div class="container-fluid bg-dark p-0">
    <div class="row m-0">
        <img src="./image/courseimg/books.jpg" alt="course banner" style="height:500px; width:100%; object-fit:cover; box-shadow:0 4px 20px rgba(0,0,0,0.5);">
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4">
            <img src="<?php echo $img_src; ?>" class="img-fluid rounded shadow-sm" alt="<?php echo htmlspecialchars($course_name); ?>" />
        </div>
        <div class="col-md-8">
            <div class="card-body bg-white shadow-sm rounded p-4">
                <h2 class="card-title text-primary mb-3"><?php echo htmlspecialchars($course_name); ?></h2>
                <p class="card-text fs-5 text-muted"><strong>Description:</strong> <?php echo htmlspecialchars($course_desc); ?></p>
                <p class="card-text fs-5"><strong>Duration:</strong> <?php echo htmlspecialchars($duration); ?></p>
                
<form action="checkout.php" method="post" class="mt-4" id="buyForm">
                    <input type="hidden" name="course_name" value="<?php echo htmlspecialchars($course_name); ?>">
                    <!-- final_price hidden field is updated by JS before submit -->
                    <input type="hidden" name="price" id="hiddenFinalPrice" value="<?php echo htmlspecialchars($price); ?>">
                    <!-- Part 3/4: pass course_id to checkout for order recording -->
                    <input type="hidden" name="course_id" value="<?php echo intval($c_id ?? 0); ?>">

                    <!-- ===== COUPON BOX ===== -->
                    <div class="coupon-box mb-3">
                        <label class="coupon-label">&#127881; Have a Coupon?</label>
                        <div class="coupon-row">
                            <input type="text" id="couponCode" maxlength="20" placeholder="Enter Coupon Code (e.g. SAVE20)" class="coupon-input" oninput="this.value=this.value.toUpperCase()">
                            <button type="button" onclick="applyCoupon()" class="coupon-btn">Apply</button>
                        </div>
                        <div id="couponMsg" class="coupon-msg" aria-live="polite"></div>
                        <div class="coupon-hint">Available: <span class="coupon-tag">SAVE10</span> <span class="coupon-tag">SAVE20</span> <span class="coupon-tag">FLAT100</span></div>
                    </div>
                    <!-- ===== END COUPON BOX ===== -->

                    <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded price-block">
                        <p class="card-text m-0 fs-5">
                            <strong>Price:</strong>
                            <small class="text-danger ms-1"><del id="origPrice">&#8377; <?php echo round(intval($price) + (intval($price) * 2 / 3)); ?></del></small>
                            <span class="font-weight-bold fs-4 ms-2" id="displayPrice">&#8377; <?php echo htmlspecialchars($price); ?></span>
                            <span id="savingsBadge" class="savings-badge" style="display:none;"></span>
                        </p>
                        <button type="submit" class="btn btn-primary text-white font-weight-bolder px-5 py-2 shadow" name="buy" id="buyNowBtn">Buy Now</button>
                    </div>
                </form>

                <!-- ===== COUPON STYLES ===== -->
                <style>
                .coupon-box {
                    background: linear-gradient(135deg, #f0f4ff 0%, #e8f5e9 100%);
                    border: 1.5px dashed #4361ee;
                    border-radius: 12px;
                    padding: 16px 20px 12px;
                }
                .coupon-label {
                    font-weight: 600;
                    color: #1a1a2e;
                    font-size: 14px;
                    margin-bottom: 8px;
                    display: block;
                }
                .coupon-row {
                    display: flex;
                    gap: 10px;
                    flex-wrap: wrap;
                }
                .coupon-input {
                    flex: 1;
                    min-width: 160px;
                    padding: 10px 16px;
                    font-size: 15px;
                    border: 2px solid #c5cae9;
                    border-radius: 8px;
                    outline: none;
                    letter-spacing: 1px;
                    font-weight: 600;
                    color: #1a1a2e;
                    background: #fff;
                    transition: border-color 0.2s, box-shadow 0.2s;
                }
                .coupon-input:focus {
                    border-color: #4361ee;
                    box-shadow: 0 0 0 3px rgba(67,97,238,0.15);
                }
                .coupon-btn {
                    padding: 10px 24px;
                    background: linear-gradient(135deg, #4361ee, #3a0ca3);
                    color: #fff;
                    border: none;
                    border-radius: 8px;
                    font-weight: 700;
                    font-size: 15px;
                    cursor: pointer;
                    transition: transform 0.15s, box-shadow 0.2s;
                    box-shadow: 0 4px 14px rgba(67,97,238,0.3);
                }
                .coupon-btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 18px rgba(67,97,238,0.4);
                }
                .coupon-btn:active { transform: translateY(0); }
                .coupon-msg {
                    margin-top: 8px;
                    font-size: 13.5px;
                    font-weight: 600;
                    min-height: 20px;
                }
                .coupon-msg.success { color: #2e7d32; }
                .coupon-msg.error   { color: #c62828; }
                .coupon-hint {
                    margin-top: 8px;
                    font-size: 12px;
                    color: #666;
                }
                .coupon-tag {
                    background: #e3f2fd;
                    color: #1565c0;
                    border-radius: 4px;
                    padding: 2px 7px;
                    font-weight: 700;
                    font-size: 11px;
                    margin-right: 4px;
                    cursor: pointer;
                    border: 1px solid #bbdefb;
                    display: inline-block;
                    transition: background 0.15s;
                }
                .coupon-tag:hover { background: #bbdefb; }
                .savings-badge {
                    background: linear-gradient(135deg, #43e97b, #38f9d7);
                    color: #1a3a2e;
                    border-radius: 20px;
                    padding: 3px 12px;
                    font-size: 12px;
                    font-weight: 700;
                    margin-left: 8px;
                    vertical-align: middle;
                    animation: popIn 0.3s ease;
                }
                @keyframes popIn {
                    0%   { transform: scale(0.7); opacity: 0; }
                    80%  { transform: scale(1.05); }
                    100% { transform: scale(1); opacity: 1; }
                }
                .price-block { transition: background 0.3s; }
                </style>

                <!-- ===== COUPON JAVASCRIPT ===== -->
                <script>
                // Base price from PHP (numeric)
                var BASE_PRICE = <?php echo intval($price); ?>;
                var currentFinalPrice = BASE_PRICE;

                // Coupon definitions
                var COUPONS = {
                    'SAVE10':  { type: 'percent', value: 10,  label: '10% OFF'  },
                    'SAVE20':  { type: 'percent', value: 20,  label: '20% OFF'  },
                    'FLAT100': { type: 'flat',    value: 100, label: '&#8377;100 OFF' }
                };

                // Calculate discounted price for a coupon
                function calcDiscount(coupon) {
                    if (coupon.type === 'percent') {
                        return Math.round(BASE_PRICE - (BASE_PRICE * coupon.value / 100));
                    } else {
                        return Math.max(0, BASE_PRICE - coupon.value);
                    }
                }

                // Make coupon tags clickable
                document.querySelectorAll('.coupon-tag').forEach(function(el) {
                    el.addEventListener('click', function() {
                        document.getElementById('couponCode').value = el.textContent.trim();
                        applyCoupon();
                    });
                });

                function applyCoupon() {
                    var code    = document.getElementById('couponCode').value.trim().toUpperCase();
                    var msgEl   = document.getElementById('couponMsg');
                    var priceEl = document.getElementById('displayPrice');
                    var badge   = document.getElementById('savingsBadge');
                    var hidden  = document.getElementById('hiddenFinalPrice');

                    if (!code) {
                        showMsg(msgEl, 'Please enter a coupon code.', 'error');
                        return;
                    }

                    if (!COUPONS[code]) {
                        showMsg(msgEl, '&#10008; Invalid Coupon Code. Try SAVE10, SAVE20 or FLAT100.', 'error');
                        // Reset price
                        currentFinalPrice = BASE_PRICE;
                        priceEl.innerHTML = '&#8377; ' + BASE_PRICE;
                        hidden.value = BASE_PRICE;
                        badge.style.display = 'none';
                        return;
                    }

                    // Find best coupon automatically
                    var bestCode  = null;
                    var bestPrice = BASE_PRICE;
                    Object.keys(COUPONS).forEach(function(k) {
                        var p = calcDiscount(COUPONS[k]);
                        if (p < bestPrice) { bestPrice = p; bestCode = k; }
                    });

                    var enteredPrice = calcDiscount(COUPONS[code]);

                    if (bestCode && bestCode !== code && bestPrice < enteredPrice) {
                        // Suggest best coupon
                        currentFinalPrice = bestPrice;
                        priceEl.innerHTML = '&#8377; ' + bestPrice;
                        hidden.value = bestPrice;
                        badge.innerHTML  = 'Best coupon applied: ' + bestCode;
                        badge.style.display = 'inline-block';
                        showMsg(msgEl, '&#9733; Best coupon applied: <strong>' + bestCode + '</strong> (' + COUPONS[bestCode].label + '). You save more!', 'success');
                        document.getElementById('couponCode').value = bestCode;
                    } else {
                        // Apply entered coupon
                        currentFinalPrice = enteredPrice;
                        priceEl.innerHTML = '&#8377; ' + enteredPrice;
                        hidden.value = enteredPrice;
                        var savings = BASE_PRICE - enteredPrice;
                        badge.innerHTML  = 'You save &#8377; ' + savings + '!';
                        badge.style.display = 'inline-block';
                        showMsg(msgEl, '&#10004; Coupon Applied: <strong>' + code + '</strong> &mdash; ' + COUPONS[code].label, 'success');
                    }
                }

                function showMsg(el, html, type) {
                    el.className = 'coupon-msg ' + type;
                    el.innerHTML = html;
                }
                </script>
            </div>
        </div>
    </div>

    <!-- Dynamic Lessons List (10+ Lessons) -->
    <div class="row mt-5">
        <div class="col-sm-12">
            <h3 class="mb-4 text-center">Course Content</h3>
            <div class="table-responsive shadow-sm">
                <table class="table table-bordered table-hover bg-white text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col" style="width: 15%;">Lesson No.</th>
                            <th scope="col">Lesson Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($has_db_lessons) {
                            $sql = "SELECT * FROM lesson WHERE course_id = '$c_id'";
                            $result = $conn->query($sql);
                            if($result && $result->num_rows > 0) {
                                $num = 1;
                                while($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                            <th scope="row" class="align-middle">'.$num.'</th>
                                            <td class="text-start ps-4 py-3">'.htmlspecialchars($row['lession_name']).'</td>
                                          </tr>';
                                    $num++;
                                }
                            } else {
                                echo '<tr><td colspan="2" class="py-4 text-muted">No lessons available yet. Please check back later.</td></tr>';
                            }
                        } else {
                            // Automatically Generate 10+ Dynamic Lessons for beautifully filled UI preview
                            $dummy_lessons = [
                                "1. Introduction to the Course",
                                "2. Setting Up the Environment",
                                "3. Core Fundamentals & Basic Syntax",
                                "4. Understanding the Architecture",
                                "5. Working with Variables and Data Types",
                                "6. Control Flow and Loops",
                                "7. Deep Dive into Functions",
                                "8. Error Handling and Debugging",
                                "9. Object-Oriented Concepts",
                                "10. Advanced Features and Techniques",
                                "11. Building a Real-World Project - Part 1",
                                "12. Building a Real-World Project - Part 2",
                                "13. Performance Optimization",
                                "14. Deployment and Best Practices",
                                "15. Course Review & Next Steps"
                            ];
                            
                            $count = 1;
                            foreach($dummy_lessons as $lesson) {
                                // Strip the "number." part from the array string to keep it clean in column 2
                                $nameParts = explode(". ", $lesson, 2);
                                $lessonName = isset($nameParts[1]) ? $nameParts[1] : $lesson;
                                
                                echo '<tr>
                                        <th scope="row" class="align-middle">'.$count.'</th>
                                        <td class="text-start ps-4 py-3">'.htmlspecialchars($lessonName).'</td>
                                      </tr>';
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
  include 'maininclude/footer.php'; 
?>
