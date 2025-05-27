<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    $_SESSION['error'] = 'Invalid request method.';
    header("Location: ../manage-user.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'Invalid or missing user ID.';
    header("Location: ../manage-user.php");
    exit;
}

$userId = (int) $_GET['id'];

if ($userId === 1) {
    $_SESSION['error'] = 'Cannot delete the admin account.';
    header("Location: ../manage-user.php");
    exit;
}

$stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
    $_SESSION['success'] = 'User deleted successfully.';
} else {
    $_SESSION['error'] = 'Delete failed: ' . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: ../manage-user.php");
exit;
