<?php
session_start();
require_once 'includes/auth.php';
// requireRole('admin'); // Only admin can access

require_once 'includes/db.php';

// if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
//     $_SESSION['error'] = "Invalid user ID.";
//     header('Location: manage-user.php');
//     exit;
// }

$user_id = intval($_SESSION['user_id']);

$stmt = $conn->prepare("SELECT email, role, status FROM user where user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($email, $user_role, $status);
if (!$stmt->fetch()) {
    $_SESSION['error'] = "User not found.";
    $stmt->close();
    header('Location: ' . ($_SESSION['user_role'] === 'admin' ? 'dashboard.php' : 'dashboard-client.php') . '');
    exit;
}

$stmt->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="css/add-user.css">
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/alert.css">
</head>

<body>
    <!-- Alert Box -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success" id="messageBox">
            <?php echo $_SESSION['success']; ?> Redirecting in <span id="countdown">3</span> seconds...
        </div>

        <script>
            let countdown = 3;
            const countdownElement = document.getElementById('countdown');

            const interval = setInterval(function () {
                countdown--;
                countdownElement.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(interval);
                    window.location.href = 'manage-user.php';
                }
            }, 1000);
        </script>

        <?php unset($_SESSION['success']); endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" id="messageBox">
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); endif; ?>


    <!-- Edit Profile Form -->
    <div class="container">
        <div class="logo">
            <img src="assets/wnet-image.png" alt="wildnet-img">
        </div>
        <div class="login-box">
            <div class="form-container">
                <h3 class="head">Edit Profile</h3>
                <h4>User Id : <?php echo $user_id; ?></h4>
                <form id="editProfileForm" action="api/edit-profile.php" method="POST" novalidate>

                    <!--Send User Id As Input -->
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Enter email"
                            value="<?php echo $email; ?>" required disabled>
                        <small class="error" style="color:red;display:none;">Please enter a valid email.</small>
                    </div>

                    <!-- Old Password -->
                    <div class="form-group">
                        <label for="password-old" class="form-label">Old Password</label>
                        <input type="password" name="password-old" id="password-old"
                            placeholder="Enter current password" minlength="6" required>
                        <small class="error" style="color:red;display:none;">Password must be at least 6
                            characters.</small>
                    </div>

                    <!-- New Password -->
                    <div class="form-group">
                        <label for="password-new" class="form-label">New Password</label>
                        <input type="password" name="password-new" id="password-new" placeholder="Enter new password"
                            minlength="6" required>
                        <small class="error" style="color:red;display:none;">Password must be at least 6
                            characters.</small>
                        <small class="error" style="color:red;display:none;">Old and New Password cannot be
                            same.</small>
                    </div>

                    <!-- Retype Password -->
                    <div class="form-group">
                        <label for="retype_password" class="form-label">Retype New Password</label>
                        <input type="password" name="retype_password" id="retype_password"
                            placeholder="Retype New password" minlength="6" required>
                        <small class="error" style="color:red;display:none;">Passwords do not match.</small>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="login-btn">Update</button>
                    <a class="back-btn"
                        href="<?php echo ($user_role == 'admin') ? 'dashboard.php' : 'dashboard-client.php' ?>"><i
                            class="fa-solid fa-arrow-left"></i>Back</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->

    <!-- JavaScript for Front-end Validation -->
    <script>
        document.getElementById("editProfileForm").addEventListener("submit", function (event) {
            let isValid = true;

            // Email Validation
            const emailField = document.getElementById("email");
            const emailError = emailField.nextElementSibling;
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailField.value.trim() || !emailRegex.test(emailField.value)) {
                emailError.style.display = "inline";
                isValid = false;
            } else {
                emailError.style.display = "none";
            }

            // Old Password Validation
            const oldPasswordField = document.getElementById("password-old");
            const oldPasswordError = oldPasswordField.nextElementSibling;
            if (oldPasswordField.value.length < 6) {
                oldPasswordError.style.display = "inline";
                isValid = false;
            } else {
                oldPasswordError.style.display = "none";
            }

            // New Password Validation
            const newPasswordField = document.getElementById("password-new");
            const newPasswordError = newPasswordField.nextElementSibling;
            const passwordSameError = newPasswordError.nextElementSibling;
            if (newPasswordField.value.length < 6) {
                newPasswordError.style.display = "inline";
                isValid = false;
            }
            else {
                newPasswordError.style.display = "none";
            }

            // Old and New Passwords are same
            if (newPasswordField.value == oldPasswordField.value && oldPasswordField.value.length > 0) {
                passwordSameError.style.display = 'inline';
                isValid = false;
            } else {
                passwordSameError.style.display = 'none';
            }

            // Retype Password Validation
            const retypePasswordField = document.getElementById("retype_password");
            const retypePasswordError = retypePasswordField.nextElementSibling;
            if (retypePasswordField.value !== newPasswordField.value || retypePasswordField.value.length < 6) {
                retypePasswordError.style.display = "inline";
                isValid = false;
            } else {
                retypePasswordError.style.display = "none";
            }

            // If the form is invalid, prevent submission
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

</body>

</html>