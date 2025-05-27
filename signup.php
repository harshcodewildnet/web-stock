<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Client Signup</title>
    <link rel="stylesheet" href="css/login1.css">
</head>

<body>

    <div class="container">
        <div class="logo">
            <img src="assets/wnet-image.png" alt="Logo">
        </div>
        <div class="login-box">
            <div class="form-container">
                <h3 class="head">Create Your Account</h3>
                <form action="api/signup.php" method="POST">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="you@example.com" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="login-btn">Sign Up</button>
                    <p>Already have an account? <a href="login.php">Log in here</a></p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>