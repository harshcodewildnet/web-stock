<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mode</title>
    <link rel="stylesheet" href="css/login1.css">
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="assets/wnet-image.png" alt="">
        </div>
        <div class="login-box">
            <div class="form-container">
            <h3 class="head">Login To Your Account</h3>
                <form action="">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" placeholder="Enter Password">
                    </div>
                    <div class="check-option">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                    <a href="dashboard-client.php"><button type="button" class="login-btn">Login</button></a>
                    <a href="#" class="forgot-password">Forgot Password</a>
                </form>
            </div>
        </div>
    </div>
    <footer></footer>

</body>

</html>