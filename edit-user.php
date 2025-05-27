<?php
session_start();
require_once 'includes/auth.php';
requireRole('admin'); // Only admin can access

require_once 'includes/db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Invalid user ID.";
    header('Location: manage-users.php');
    exit;
}

$user_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT email, status FROM user where user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($email, $status);
if (!$stmt->fetch()) {
    $_SESSION['error'] = "User not found.";
    $stmt->close();
    header('Location: manage-users.php');
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


    <!-- Edit User Form -->
    <div class="container edit-container">
        <div class="logo">
            <img src="assets/wnet-image.png" alt="wildnet-img">
        </div>
        <div class="login-box">
            <div class="form-container">
                <h3 class="head">Edit User</h3>
                <h4>User Id : <?php echo $user_id; ?></h4>
                <form id="editUserForm" action="api/edit-user.php" method="POST" novalidate>

                    <!--Send User Id As Input -->
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Enter email"
                            value="<?php echo $email; ?>" required>
                        <small class="error" style="color:red;display:none;">Please enter a valid email.</small>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter new password"
                            minlength="6">
                        <small class="error" style="color:red;display:none;">Password must be at least 6
                            characters.</small>
                    </div>

                    <!-- Retype Password -->
                    <div class="form-group">
                        <label for="retype_password" class="form-label">Retype Password</label>
                        <input type="password" name="retype_password" id="retype_password" placeholder="Retype password"
                            minlength="6">
                        <small class="error" style="color:red;display:none;">Passwords do not match.</small>
                    </div>

                    <!-- Role (User/Admin) -->
                    <div class="form-group">
                        <label for="status" class="form-label" id="status-label">Status</label>
                        <select name="status" id="status" required>
                            <option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Active</option>
                            <option value="0" <?php echo ($status == 0) ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="login-btn">Update</button>
                    <a class="back-btn" href="manage-user.php"><i class="fa-solid fa-arrow-left"></i>Back</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->

    <!-- JavaScript for Front-end Validation -->
    <script>
        document.getElementById("editUserForm").addEventListener("submit", function (event) {
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

            // Password Validation
            const passwordField = document.getElementById("password");
            const passwordError = passwordField.nextElementSibling;

            const retypePasswordField = document.getElementById("retype_password");
            const retypePasswordError = retypePasswordField.nextElementSibling;

            // Only validate passwords if password is not empty
            if (passwordField.value.length > 0) {
                if (passwordField.value.length < 6) {
                    passwordError.style.display = "inline";
                    isValid = false;
                } else {
                    passwordError.style.display = "none";
                }

                if (retypePasswordField.value !== passwordField.value) {
                    retypePasswordError.style.display = "inline";
                    isValid = false;
                } else {
                    retypePasswordError.style.display = "none";
                }
            } else {
                // No password update; hide both errors
                passwordError.style.display = "none";
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