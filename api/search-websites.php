<?php
header('Content-Type: application/json');
require_once '../includes/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$query = trim($data['query'] ?? '');
$page = $data['page'] ?? '';

// if (empty($query)) {
//     echo json_encode(['status' => 'error', 'message' => 'Query is required']);
//     exit;
// }

try {
    if (empty($query)) {
        if ($page == 'dblist') // fetch all approved websites
        {
            $stmt = $conn->prepare("SELECT * FROM websites WHERE status = 1 ORDER BY id DESC");
        } else // fetch all websites 
        {
            $stmt = $conn->prepare("SELECT * FROM websites ORDER BY id DESC");
        }
    } else {
        $like = '%' . $query . '%';
        // fetch approved websites with search string
        if ($page == 'dblist') {
            $stmt = $conn->prepare("
            SELECT * FROM websites 
            WHERE status = 1 AND 
            (url LIKE ? 
            OR client_name LIKE ? 
            OR blogger_email LIKE ?)
            ORDER BY id DESC
        ");
        } else //fetch all websites with search string 
        {
            $stmt = $conn->prepare("
            SELECT * FROM websites 
            WHERE url LIKE ? 
            OR client_name LIKE ? 
            OR blogger_email LIKE ? 
            ORDER BY id DESC
        ");
        }

        $stmt->bind_param("sss", $like, $like, $like);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $websites = [];
    while ($row = $result->fetch_assoc()) {
        // $websites[] = $row;
        $websites[] = [
            'id' => $row['id'],
            'category' => $row['category'],
            'url' => $row['url'],
            'live_link' => $row['live_url'],
            'currency' => $row['currency'],
            'price' => $row['price'],
            'client_name' => $row['client_name'],
            'blogger_name' => $row['blogger_name'],
            'blogger_email' => $row['blogger_email'],
            'blogger_mobile' => $row['blogger_mobile'],
            'spam_score' => $row['spam_score'],
            'dr' => $row['dr'],
            'da' => $row['da'],
            'traffic' => $row['traffic'],
            'location' => $row['location'],
            'mode' => $row['mode'],
            'added_by' => $row['added_by'],
            'status' => (int) $row['status'],
            // 'payment_status' => 'in progress',
            'date_added' => $row['date_added']
        ];
    }

    echo json_encode([
        'status' => 'success',
        'count' => count($websites),
        'websites' => $websites
    ]);

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}

