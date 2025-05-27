<?php
header('Content-Type: application/json');
require_once '../includes/db.php';
require_once '../includes/auth.php';


$data = json_decode(file_get_contents('php://input'), true);

// Required fields for both add and edit
$required = ['category', 'currency', 'price', 'blogger_name', 'blogger_email', 'spam_score', 'da', 'dr', 'traffic', 'location', 'url'];


foreach ($required as $field) {
    if (empty($data[$field])) {
        echo json_encode(['status' => 'error', 'message' => "Field '$field' is required."]);
        exit;
    }
}

// Sanitize optional fields 
$clientName = !empty($data['client_name']) ? $data['client_name'] : 'General';
$liveUrl = !empty($data['live_url']) ? $data['live_url'] : '-';
$addedBy = isset($data['added_by']) ? $data['added_by'] : $_SESSION['name'];
$status = isset($data['status']) ? $data['status'] : ($_SESSION['user_role'] == 'admin' ? '1' : '0');
$mode = isset($data['mode']) ? $data['mode'] : 'Manual';
$mobile = isset($data['blogger_mobile']) ? $data['blogger_mobile'] : '';

if (!empty($data['id'])) {
    // -------- UPDATE (edit) --------
    $stmt = $conn->prepare("
        UPDATE websites SET
            category=?, url=?, live_url=?, currency=?, price=?, client_name=?, blogger_name=?, blogger_email=?,
            blogger_mobile=?, spam_score=?, dr=?, traffic=?, da=?, location=?, mode=?, added_by=?, status=?
        WHERE id=?
    ");

    $stmt->bind_param(
        "ssssisssssiiissssi",
        $data['category'],
        $data['url'],
        $liveUrl,
        $data['currency'],
        $data['price'],
        $clientName,
        $data['blogger_name'],
        $data['blogger_email'],
        $mobile,
        $data['spam_score'],
        $data['dr'],
        $data['traffic'],
        $data['da'],
        $data['location'],
        $mode,
        $addedBy,
        $status,
        $data['id']
    );

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Website updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Update failed: ' . $stmt->error]);
    }
} else {
    // -------- INSERT (add) --------

    $checkStmt = $conn->prepare("SELECT * FROM websites WHERE url = ? AND client_name = ? AND blogger_email = ?");
    $checkStmt->bind_param("sss", $data['url'], $data['client_name'], $data['blogger_email']);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Error! Entry already exists for same url, client_name and blogger_email']);
        $checkStmt->close();
        $conn->close();
        exit;
    }
    $checkStmt->close();

    // Proceed with insertion
    $stmt = $conn->prepare("
        INSERT INTO websites (
            category, url, live_url, currency, price, client_name, blogger_name, blogger_email,
            blogger_mobile, spam_score, dr, traffic, da, location, mode, added_by, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "ssssisssssiiissss",
        $data['category'],
        $data['url'],
        $liveUrl,
        $data['currency'],
        $data['price'],
        $clientName,
        $data['blogger_name'],
        $data['blogger_email'],
        $mobile,
        $data['spam_score'],
        $data['dr'],
        $data['traffic'],
        $data['da'],
        $data['location'],
        $mode,
        $addedBy,
        $status
    );

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Website added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Insert failed: ' . $stmt->error]);
    }
}

$stmt->close();
$conn->close();
