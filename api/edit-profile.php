<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';


$user_id = $_SESSION['user_id'];
$old_password = trim($_POST['password-old'] ?? '');
$new_password = trim($_POST['password-new'] ?? '');

if (empty($old_password) || empty($new_password)) {
    $_SESSION['error'] = "Both old and new passwords are required.";
    header("Location: ../manage-profile.php");
    exit;
}

if (strlen($new_password) < 6) {
    $_SESSION['error'] = "New password must be at least 6 characters.";
    header("Location: ../manage-profile.php");
    exit;
}

// Fetch current password hash
$stmt = $conn->prepare("SELECT password FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($currentHash);
$stmt->fetch();
$stmt->close();

if (!password_verify($old_password, $currentHash)) {
    $_SESSION['error'] = "Old password is incorrect.";
    header("Location: ../manage-profile.php");
    exit;
}

// Update to new password
$newHash = password_hash($new_password, PASSWORD_DEFAULT);
$updateStmt = $conn->prepare("UPDATE user SET password = ? WHERE user_id = ?");
$updateStmt->bind_param("si", $newHash, $user_id);

if ($updateStmt->execute()) {
    $_SESSION['success'] = "Password updated successfully.";
} else {
    $_SESSION['error'] = "Failed to update password. Please try again.";
}
$updateStmt->close();

header("Location: ../manage-profile.php");
exit;
