<?php
header('Content-Type: application/json');
require_once '../includes/db.php';

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);
$query = trim($data['query'] ?? '');

try {
    if (empty($query)) {
        // fetch all users
        $stmt = $conn->prepare("SELECT * FROM user where role = 'user'");
    } else {
        $like = '%' . $query . '%';
        $stmt = $conn->prepare("
            SELECT * FROM user 
            WHERE role = 'user' 
            AND (name LIKE ? 
            OR email LIKE ?)
        ");
        $stmt->bind_param("ss", $like, $like);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    echo json_encode([
        'status' => 'success',
        'count' => count($users),
        'users' => $users
    ]);

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}
