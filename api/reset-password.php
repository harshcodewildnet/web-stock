<?php
session_start();
header('Content-Type: application/json');
require '../includes/db.php';

if (!isset($_SESSION['verified_email'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized.']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$password = trim($data['password'] ?? '');
$email = $_SESSION['verified_email'];

if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters.']);
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
    if(!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Statement Prepare Failed']);
        exit;
    }
    $stmt->bind_param('ss', $hashedPassword, $email);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Password updated successfully.']);
        // Destroy session so OTP can't be reused
        session_destroy();
    } else {
        echo json_encode(['success' => false, 'message' => 'DB Error! Updating Password Failed!.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error.']);
}
