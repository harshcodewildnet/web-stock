<?php
header('Content-Type: application/json');
require_once '../includes/db.php';

// Read and decode JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($data['id'], $data['status'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required fields: id and status.'
    ]);
    exit;
}

$id = intval($data['id']);
$status = $data['status'] === 'approved' ? '1' : '0';

// Prepare SQL
$sql = "UPDATE websites SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Prepare failed: ' . $conn->error
    ]);
    exit;
}

if ($stmt->bind_param('si', $status, $id) && $stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Status updated successfully.'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Update failed: ' . $stmt->error
    ]);
}
?>
