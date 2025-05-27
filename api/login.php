<?php
// api/login.php
session_start();
require_once '../includes/db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? 'user'; // default to user if not provided

if (!$email || !$password) {
    die('Email and password are required.');
}

// print_r($_POST);die;

// Find user by email and role
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND role = ?");
$stmt->bind_param("ss", $email, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    // Verify password
    if (password_verify($password, $user['password'])) {
        // Save session data
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['name'] = $user['name'];

        // Redirect based on role
        if ($role === 'admin') {
            header("Location: ../dashboard.php");
        } else {
            header("Location: ../dashboard-client.php");
        }
        exit;
    } else {
        
    }
}

$_SESSION['error'] = 'Invalid Login credentials';

if ($role === "admin") {
    header("Location: ../admin/login.php");

} else {
    header("Location: ../login.php");

}