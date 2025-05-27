<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/login3.css">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="assets/wnet-image.png" alt="wildnet-img">
        </div>
        <div class="login-box">
            <form id="resetpasswordform" action="" method="POST" novalidate>
                <h3 class="head">Reset Passord</h3>
                <!-- <input type="hidden" name="email" id="email" value=""> -->
                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input type="text" name="password" id="password" placeholder="Enter a new password" minlength="6"
                        required>
                    <small class="error" style="color:red;display:none;">Password must be at least 6
                        characters.</small>
                </div>
                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="retype_password" class="form-label">Confirm Password</label>
                    <input type="password" name="retype_password" id="retype_password" placeholder="Retype new password"
                        minlength="6" required>
                    <small class="error" style="color:red;display:none;">Passwords do not match.</small>
                </div>
                <button type="submit" class="login-btn">Update</button>
                <a href="forgot-password.php" class="forgot-password">Back</a>
            </form>
        </div>
    </div>
    <footer></footer>

    <script>
        document.getElementById('resetpasswordform').addEventListener('submit', function (e) {
            e.preventDefault();

            let isValid = true;

            // Password Validation
            const passwordField = document.getElementById("password");
            const passwordError = passwordField.nextElementSibling;
            const password = passwordField.value;
            const retypePasswordField = document.getElementById("retype_password");
            const retypePasswordError = retypePasswordField.nextElementSibling;
            const button = document.querySelector('.login-btn');

            if (passwordField.value.length < 6) {
                passwordError.style.display = "inline";
                isValid = false;
            } else {
                passwordError.style.display = "none";
            }

            // Retype Password Validation
            
            if (retypePasswordField.value !== passwordField.value) {
                retypePasswordError.style.display = "inline";
                isValid = false;
            } else {
                retypePasswordError.style.display = "none";
            }

            if (!isValid) return;

            button.disabled =true;

            fetch('api/reset-password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    password: password
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Password Changed. Redirecting to Login Page ...');
                        console.log(data.message);
                        window.location.href = 'index.php';
                    } else {
                        alert(data.message || 'Password Update Failed.');
                        console.log(data.message);
                    }
                    button.disabled = false;
                });


        });
    </script>


</body>

</html>