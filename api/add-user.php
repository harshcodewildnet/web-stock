<?php
// process-add-user.php

session_start();
require_once '../includes/db.php';

// Collect and validate form data

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$retypePassword = $_POST['retype_password'] ?? '';
$role = $_POST['role'] ?? 'user';
$status = $_POST['status'] ?? '1';

// (Validation)

if ($password !== $retypePassword) {
    $_SESSION['error'] = "Passwords do not match.";
    header('Location: ../add-user.php');
    exit;
}

// Check if email already exists
$stmt = $conn->prepare("SELECT user_id FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['error'] = "Email already registered.";
    header('Location: ../add-user.php');
    exit;
}

// Hash the password and insert user
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO user (name, email, password, role, status) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi",$name, $email, $hashedPassword, $role, $status);
$inserted = $stmt->execute();

if ($inserted) {
    $_SESSION['success'] = "User created successfully!";
    header('Location: ../add-user.php');
    exit;
} else {
    $_SESSION['error'] = "Failed to create user.";
    header('Location: ../add-user.php');
    exit;
}

