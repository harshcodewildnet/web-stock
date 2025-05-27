<?php
session_start();
require_once '../includes/auth.php';
requireRole('admin');
require_once '../includes/db.php';

// Get and validate inputs
$user_id = intval($_POST['user_id'] ?? 0);
$email = trim($_POST['email']);
$password = trim($_POST['password'] ?? '');
$status = $_POST['status'] ?? null;

if (!$user_id || empty($email) || !in_array($status, ['0', '1'])) {
    $_SESSION['error'] = "Invalid input.";
    header("Location: ../edit-user.php?id=" . $user_id);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email format.";
    header("Location: ../edit-user.php?id=" . $user_id);
    exit;
}

// Check if another user already has the same email
$checkStmt = $conn->prepare("SELECT user_id FROM user WHERE email = ? AND user_id != ?");
$checkStmt->bind_param("si", $email, $user_id);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    $_SESSION['error'] = "Email is already in use by another user.";
    $checkStmt->close();
    header("Location: ../edit-user.php?id=" . $user_id);
    exit;
}
$checkStmt->close();


// Prepare SQL
if (!empty($password)) {
    // Password provided — hash it and update
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters.";
        header("Location: ../edit-user.php?id=" . $user_id);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE user SET email = ?, password = ?, status = ? WHERE user_id = ?");
    $stmt->bind_param("ssii", $email, $hashedPassword, $status, $user_id);
} else {
    // No password change
    $stmt = $conn->prepare("UPDATE user SET email = ?, status = ? WHERE user_id = ?");
    $stmt->bind_param("sii", $email, $status, $user_id);
}

// Execute and handle result
if ($stmt->execute()) {
    $_SESSION['success'] = "User updated successfully.";
    $stmt->close();
    header("Location: ../edit-user.php?id=" . $user_id . "&redirect=1");
    exit;
} else {
    $_SESSION['error'] = "Failed to update user.";
    $stmt->close();
    header("Location: ../edit-user.php?id=" . $user_id);
    exit;
}
