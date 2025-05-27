<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="css/login3.css">
    <style>
        .alert {
            position: absolute;
            top: 2%;
            right: 5%;
            padding: 12px 40px;
            margin: 20px 0;
            border: 1px solid transparent;
            border-radius: 4px;
            display: flex;
            align-items: center;
            /* font-size: 14px;
            text-align: center;
            line-height: 2rem; */
        }

        .alert i {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .alert span {
            /* display: inline-block; */
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
    <div class="container">
        <div class="logo">
            <img src="assets/wnet-image.png" alt="wildnet-img">
        </div>
        <div class="login-box">
            <form id="sendotpform" action="" method="POST" novalidate>
                <h3 class="head">Forgot Passord</h3>
                <div class="form-group">
                    <label for="email" class="form-label">Enter Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter email to get password OTP" required>
                    <small class="error" style="color:red;display:none;">Please enter a valid email.</small>
                    <a id="edit-link" style="display: none;" href="#">Edit Email Id</a>
                </div>
                <!-- <div class="form-group otp-notice" style="display:none;">
                    <h4>OTP Sent to Email Id</h4>
                    <a class="edit-link" href="#">Edit Email Id</a>
                </div> -->
                <div class="form-group otp-field" style="display:none;">
                    <label for="otp" class="form-label">Enter OTP</label>
                    <input type="text" name="otp" id="otp" placeholder="Enter OTP To Reset Passord" required>
                    <small class="error" style="color:red;display:none;">Please enter a valid 6 digit otp.</small>
                </div>
                <button type="submit" class="login-btn">Request OTP</button>
                <a href="index.php" class="forgot-password">Back</a>

            </form>
        </div>
    </div>


    <div id="messageBox" class="alert" style="display: none;">
        <i id="alertIcon" class="fa-solid"></i>
        <span id="alertMessage"></span>
    </div>

    <footer></footer>

    <!-- <script>
        document.getElementById('sendotpform').addEventListener('submit', function (e) {
            let valid = true;

            // Email validation
            const email = document.getElementById('email');
            const emailError = email.nextElementSibling;
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.value.match(emailPattern)) {
                emailError.style.display = 'block';
                valid = false;
            } else {
                emailError.style.display = 'none';
            }

            // Password validation
            // const otp = document.getElementById('otp');
            // const otpError = otp.nextElementSibling;
            // if (password.value.length < 6) {
            //     passwordError.style.display = 'block';
            //     valid = false;
            // } else {
            //     passwordError.style.display = 'none';
            // }

            if (!valid) {
                e.preventDefault(); // Stop form submission if validation fails
            }
        });
    </script> -->


    <script>
        document.getElementById('sendotpform').addEventListener('submit', function (e) {
            e.preventDefault();

            const emailInput = document.getElementById('email');
            const emailError = emailInput.nextElementSibling;
            const otpInput = document.getElementById('otp');
            const otpError = otpInput.nextElementSibling;
            const otpField = document.querySelector('.otp-field');
            const editLink = document.getElementById('edit-link');
            const button = document.querySelector('.login-btn');

            const email = emailInput.value.trim();
            const otp = otpInput.value.trim();

            // Validate email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[a-z]{2,}$/i;
            let isValid = true;

            if (!emailPattern.test(email)) {
                emailError.style.display = 'block';
                isValid = false;
            } else {
                emailError.style.display = 'none';
            }

            // If OTP is visible, validate OTP too
            if (otpField.style.display !== 'none') {
                if (!/^\d{6}$/.test(otp)) {
                    otpError.style.display = 'block';
                    isValid = false;
                } else {
                    otpError.style.display = 'none';
                }
            }

            editLink.addEventListener('click', function () {
                emailInput.disabled = false;
                otpField.style.display = 'none';
                button.textContent = 'Request OTP';
                this.style.display = 'none';
            });


            if (!isValid) return;

            // Proceed based on phase
            if (otpField.style.display === 'none') {
                // STEP 1: Request OTP
                button.disabled = true;
                button.textContent = 'Please Wait';

                fetch('api/otp-handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify({
                        action: 'send',
                        email: email
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // alert(data.message);
                            otpField.style.display = 'block';
                            emailInput.disabled = true;
                            editLink.style.display = 'inline-block';
                            button.textContent = 'Verify OTP';
                        } else {
                            // alert(data.message || 'Failed to send OTP.');
                            if (data.message == 'Email not registered.') emailError.textContent = data.message;
                            emailError.style.display = 'block';
                            button.textContent = 'Request OTP';
                        }
                        showMessage(data.message, data.success, null, 8000);
                        button.disabled = false;
                    });
            } else {
                // STEP 2: Verify OTP
                button.disabled = true;
                button.textContent = 'Please Wait';

                fetch('api/otp-handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify({
                        action: 'verify',
                        email: email,
                        otp: otp
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showMessage(data.message, true, 'reset-password.php', 3000);
                            // alert('OTP verified. Redirecting to password reset...');
                        } else {
                            showMessage(data.message, false , null, 8000);
                            // alert(data.message || 'Invalid OTP.');
                            button.textContent = 'Verify OTP';
                        }
                        button.disabled = false;
                    });
            }
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
                box.style.display = 'none';

                if (redirectUrl) {
                    window.location.href = redirectUrl;
                }
            }, delay);

        }
    </script>


</body>

</html>