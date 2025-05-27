<?php
require_once 'includes/auth.php';
// requireRole('admin');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/main.js"></script>
    <style>
        .alert {
            padding: 8px;
            margin: 10px 0;
            border: 1px solid transparent;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .alert i {
            font-size: 1.2rem;
            margin-right: 10px;
        }

        .alert span {
            font-size: 1rem;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>
    <!-- Header Dblist-->
    <header>
        <a href="dashboard.php">
            <div class="logo">
                <img src="assets/wnet-image.png" alt="WildNet logo">
            </div>
        </a>
        <div class="search-area">
            <div class="actions">
                <label id="profile-label">
                    <i class="fa-solid fa-user"></i>
                    <button id="profile-toggle">
                        <i class="fa-solid fa-caret-down"></i>
                    </button>
                    <div id="profile-dropdown" class="profile-dropdown">
                        <a href="manage-profile.php" class="dropdown-item">My Profile</a>
                        <hr>
                        <a href="manage-profile.php" class="dropdown-item">Reset Password</a>
                    </div>
                </label>
                <a href="#" id="logout-link">
                    <i class="fa-solid fa-power-off"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
        <!-- <div class="actions">
        <label id="profile-label">
                <i class="fa-solid fa-user"></i>
                <button>
                    <i class="fa-solid fa-caret-down"></i>
                </button>
            </label>
        </div> -->
    </header>

    <!-- SideBar Menu -->
    <?php
    if ($_SESSION['user_role'] === 'admin') {
        include 'includes/sidebar-admin.php';
    } else {
        include 'includes/sidebar-client.php';
    }
    ?>

    <!-- Main Content -->
    <main>
        <div class="top-row">
            <div class="site-count">
                <h2>Add Website</h2>
            </div>
        </div>
        <hr>
        <div class="content-area add-website-content">
            <!-- Custom Alert -->
            <div id="messageBox" class="alert" style="display: none;">
                <i id="alertIcon" class="fa-solid"></i>
                <span id="alertMessage"></span>
            </div>
            <div class="add-form" id="add-form">
                <div class="form-group">
                    <label for="modal-url">Web URL<sup>*</sup></label>
                    <input type="text" id="modal-url" class="form-control" required>
                    <span class="error-message" id="error-modal-url"></span>
                </div>
                <div class="form-group">
                    <label for="modal-category">Category<sup>*</sup></label>
                    <select id="modal-category" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="General">General</option>
                        <option value="Technology">Technology</option>
                        <option value="Travel">Travel</option>
                        <option value="Food & Recipes">Food & Recipes</option>
                        <option value="Lifestyle">Lifestyle</option>
                        <option value="Education">Education</option>
                        <option value="Business & Marketing">Business & Marketing</option>
                        <option value="Finance">Finance</option>
                        <option value="News & Politics">News & Politics</option>
                        <option value="Health & Fitness">Health & Fitness</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Gaming">Gaming</option>
                        <option value="Fashion">Fashion</option>
                        <option value="DIY & Home">DIY & Home</option>
                    </select>
                    <span class="error-message" id="error-modal-category"></span>
                </div>
                <!-- <div class="form-group">
                    <label for="modal-status">Status</label>
                    <select id="modal-status" class="form-control">
                        <option value="">-- Select --</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Blocked">Blocked</option>
                        <option value="Draft">Draft</option>
                    </select>
                    <span class="error-message" id="error-modal-status"></span>
                </div> -->
                <div class="form-group">
                    <label for="modal-currency">Currency<sup>*</sup></label>
                    <select id="modal-currency" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="JPY">JPY</option>
                        <option value="CHF">CHF</option>
                        <option value="CAD">CAD</option>
                        <option value="AUD">AUD</option>
                        <option value="NZD">NZD</option>
                        <option value="CNY">CNY</option>
                        <option value="INR">INR</option>
                        <option value="KRW">KRW</option>
                        <option value="RUB">RUB</option>
                        <option value="BRL">BRL</option>
                        <option value="ZAR">ZAR</option>
                        <option value="SGD">SGD</option>
                        <option value="HKD">HKD</option>
                        <option value="SEK">SEK</option>
                        <option value="NOK">NOK</option>
                        <option value="DKK">DKK</option>
                        <option value="MXN">MXN</option>
                        <option value="TRY">TRY</option>
                        <option value="THB">THB</option>
                        <option value="IDR">IDR</option>
                        <option value="MYR">MYR</option>
                        <option value="PHP">PHP</option>
                        <option value="AED">AED</option>
                    </select>
                    <span class="error-message" id="error-modal-currency"></span>
                </div>
                <!-- <div class="form-group">
                    <label for="modal-currency">Currency<sup>*</sup></label>
                    <input type="text" id="modal-currency" class="form-control">
                </div> -->
                <div class="form-group">
                    <label for="modal-price">Price<sup>*</sup></label>
                    <input type="text" id="modal-price" class="form-control" required>
                    <span class="error-message" id="error-modal-price"></span>
                </div>
                <div class="form-group">
                    <label for="modal-client-name">Client Name</label>
                    <input type="text" id="modal-client-name" class="form-control" required>
                    <span class="error-message" id="error-modal-client-name"></span>
                </div>
                <div class="form-group">
                    <label for="modal-blogger-name">Blogger Name<sup>*</sup></label>
                    <input type="text" id="modal-blogger-name" class="form-control" required>
                    <span class="error-message" id="error-modal-blogger-name"></span>
                </div>
                <div class="form-group">
                    <label for="modal-blogger-email">Blogger Email<sup>*</sup></label>
                    <input type="email" id="modal-blogger-email" class="form-control" required>
                    <span class="error-message" id="error-modal-blogger-email"></span>
                </div>
                <div class="form-group">
                    <label for="modal-blogger-mobile">Blogger Mobile</label>
                    <input type="text" id="modal-blogger-mobile" class="form-control">
                    <span class="error-message" id="error-modal-blogger-mobile"></span>
                </div>
                <div class="form-group">
                    <label for="modal-da">DA<sup>*</sup></label>
                    <input type="text" id="modal-da" class="form-control" required>
                    <span class="error-message" id="error-modal-da"></span>
                </div>
                <div class="form-group">
                    <label for="modal-dr">DR<sup>*</sup></label>
                    <input type="text" id="modal-dr" class="form-control" required>
                    <span class="error-message" id="error-modal-dr"></span>
                </div>

                <div class="form-group">
                    <label for="modal-spam-score">Spam Score<sup>*</sup></label>
                    <input type="text" id="modal-spam-score" class="form-control" required>
                    <span class="error-message" id="error-modal-spam-score"></span>
                </div>

                <div class="form-group">
                    <label for="modal-traffic">Traffic<sup>*</sup></label>
                    <input type="text" id="modal-traffic" class="form-control" required>
                    <span class="error-message" id="error-modal-traffic"></span>
                </div>

                <div class="form-group">
                    <label for="modal-location">Location<sup>*</sup></label>
                    <select id="modal-location" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="Global">Global</option>
                        <option value="United States">United States</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="China">China</option>
                        <option value="India">India</option>
                        <option value="South Korea">South Korea</option>
                        <option value="Russia">Russia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Norway">Norway</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Philippines">Philippines</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                    </select>
                    <span class="error-message" id="error-modal-location"></span>
                </div>
                <div class="blank-div"></div>

                <!-- <div class="form-group">
                    <label for="modal-mode">Mode</label>
                    <select id="modal-mode" class="form-control">
                        <option value="">-- Select --</option>
                        <option value="Manual">Manual</option>
                        <option value="CSV Upload">CSV Upload</option>
                        <option value="API">API</option>
                    </select>
                    <span class="error-message" id="error-modal-mode"></span>
                </div> -->

                <!-- <div class="form-group">
                    <label for="modal-added-by">Added By<sup>*</sup></label>
                    <select id="modal-added-by" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="Admin">Admin</option>
                        <option value="Team Member">Team Member</option>
                    </select>
                    <span class="error-message" id="error-modal-added-by"></span>
                </div> -->
                <input type="submit" class="addsubmit" id="save-btn" value="Save">
            </div>
        </div>
    </main>

    <!-- Logout alert box -->
    <div id="custom-alert" class="alert-overlay">
        <div class="alert-box">
            <p>Are you sure you want to logout?</p>
            <div class="alert-actions">
                <button id="confirm-logout">Yes</button>
                <button id="cancel-logout">No</button>
            </div>
        </div>
    </div>


    <!-- Save Script-->
    <script>
        const addForm = document.getElementById('add-form');
        document.getElementById('save-btn').addEventListener('click', function () {

            const fields = {
                category: 'modal-category',
                // status: 'modal-status',
                currency: 'modal-currency',
                price: 'modal-price',
                client_name: 'modal-client-name',
                blogger_name: 'modal-blogger-name',
                blogger_email: 'modal-blogger-email',
                blogger_mobile: 'modal-blogger-mobile',
                spam_score: 'modal-spam-score',
                dr: 'modal-dr',
                traffic: 'modal-traffic',
                da: 'modal-da',
                url: 'modal-url',
                location: 'modal-location',
                // mode: 'modal-mode',
                // added_by: 'modal-added-by'
            };

            const nameRegex = /^[A-Za-z\s]+$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const mobileRegex = /^\d{10,15}$/;
            const urlRegex = /^(https?:\/\/)?[\w\-]+(\.[\w\-]+)+[/#?]?.*$/i;
            const requiredFields = ['category', 'currency', 'spam_score', 'da', 'dr', 'traffic', 'price', 'blogger_name', 'blogger_email', 'location', 'url'];
            const numericFields = ['price', 'spam_score', 'dr', 'traffic', 'da'];

            let isValid = true;
            const data = {};

            // Clear previous errors
            Object.keys(fields).forEach(key => {
                const input = document.getElementById(fields[key]);
                const errorEl = document.getElementById(`error-${fields[key]}`);
                input.classList.remove('error');
                if (errorEl) errorEl.textContent = '';
            });

            // Validate fields
            Object.keys(fields).forEach(key => {
                const value = document.getElementById(fields[key]).value.trim();
                data[key] = value;
                // Set default value for client_name field
                // if (key === 'client_name' && !value) {
                //     data[key] = 'General';
                // } else {
                //     data[key] = value;
                // }

                const input = document.getElementById(fields[key]);
                const errorEl = document.getElementById(`error-${fields[key]}`);

                if (requiredFields.includes(key) && !value) {
                    errorEl.textContent = 'This field is required.';
                    input.classList.add('error');
                    isValid = false;
                }

                // if ((key === 'client_name' || key === 'blogger_name') && value && !nameRegex.test(value)) {
                if ((key === 'blogger_name') && value && !nameRegex.test(value)) {
                    errorEl.textContent = 'Only alphabets and spaces are allowed.';
                    input.classList.add('error');
                    isValid = false;
                }

                if (key === 'blogger_email' && value && !emailRegex.test(value)) {
                    errorEl.textContent = 'Invalid email format.';
                    input.classList.add('error');
                    isValid = false;
                }

                if (key === 'url' && value && !urlRegex.test(value)) {
                    errorEl.textContent = 'Invalid URL.';
                    input.classList.add('error');
                    isValid = false;
                }

                if (key === 'blogger_mobile' && value && !mobileRegex.test(value)) {
                    errorEl.textContent = 'Mobile number must be numeric and 10 to 15 digits.';
                    input.classList.add('error');
                    isValid = false;
                }

                if (numericFields.includes(key) && value && isNaN(value)) {
                    errorEl.textContent = 'Must be a number.';
                    input.classList.add('error');
                    isValid = false;
                }
            });

            if (!isValid) {
                // Scroll to first invalid field
                const firstErrorField = document.querySelector('.error');
                if (firstErrorField) {
                    firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstErrorField.focus();
                }
                return;
            }
            // Disable Inputs temporarily
            addForm.querySelectorAll('input, select, button').forEach(el => {
                el.disabled = true;
            });
            // If all validations pass, submit data
            fetch('api/add-website.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(response => {
                    // alert(response.message);
                    if (response.status === 'success') {
                        // window.location.href = 'quality-checklist.php';
                        showMessage(response.message, true, 'quality-checklist.php', 3000);
                    } else {
                        showMessage(response.message, false, null, 3000);
                    }
                    addForm.querySelectorAll('input, select, button').forEach(el => {
                        el.disabled = false;
                    });
                })
                .catch(err => {
                    // alert('Error adding website');
                    showMessage(err, false, null, 5000);
                    console.error(err);
                    addForm.querySelectorAll('input, select, button').forEach(el => {
                        el.disabled = false;
                    });
                });
        });


        function showMessage(message, isSuccess, redirectUrl = null, delay = 2000) {
            const box = document.getElementById('messageBox');
            const icon = document.getElementById('alertIcon');
            const text = document.getElementById('alertMessage');

            text.textContent = message;

            box.className = isSuccess ? 'alert alert-success' : 'alert alert-danger';
            icon.className = isSuccess ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-exclamation';

            box.style.display = 'flex';

            setTimeout(() => {
                // box.style.display = 'none';

                if (redirectUrl) {
                    window.location.href = redirectUrl;
                }
            }, delay);

        }
    </script>

</body>

</html>