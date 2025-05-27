<?php
header('Content-Type: application/json');
require_once '../includes/db.php';
require_once '../includes/auth.php';
// requireRole('admin');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing Website Id'
    ]);
    exit;
}

$id = intval($data['id']);

$stmt = $conn->prepare('DELETE FROM websites WHERE id = ?');

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'stmt prepare error' . $conn->error
    ]);
    exit;
}

if ($stmt->bind_param('i', $id) && $stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Website deleted successfully.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Delete Failed : ' . $stmt->error
    ]);
}
