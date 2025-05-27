<?php
header('Content-Type: application/json');
require_once '../includes/db.php'; // DB connection

// Get incoming JSON and decode
$input = json_decode(file_get_contents('php://input'), true);

$pageNo = $input['pageNo'];
$pagelimit = 20;
$offset = ($pageNo -1) * $pagelimit; 

// Initialize where conditions array
$conditions = [];

// Helper to map filters into SQL-safe conditions
function buildInCondition($column, $values, $conn)
{
    // Escape each value to prevent SQL injection
    $escaped = array_map(function ($val) use ($conn) {
        return "'" . $conn->real_escape_string($val) . "'";
    }, $values);

    // Join values as comma-separated for SQL IN clause
    return "$column IN (" . implode(",", $escaped) . ")";
}

// Category
if (!empty($input['category'])) {
    $conditions[] = buildInCondition("category", $input['category'], $conn);
}

// Traffic (e.g., "0-1000" => traffic BETWEEN 0 AND 1000)
// Traffic (e.g., "0-1000" => traffic BETWEEN 0 AND 1000, "20000+" => traffic >= 20000)
if (!empty($input['traffic'])) {
    $trafficParts = [];
    foreach ($input['traffic'] as $range) {
        if ($range === '20000+') {
            $trafficParts[] = "(traffic >= 20000)";
        } elseif (strpos($range, '-') !== false) {
            [$min, $max] = explode("-", $range);
            $trafficParts[] = "(traffic BETWEEN $min AND $max)";
        }
    }
    if (!empty($trafficParts)) {
        $conditions[] = "(" . implode(" OR ", $trafficParts) . ")";
    }
}


// Location
if (!empty($input['location'])) {
    $conditions[] = buildInCondition("location", $input['location'], $conn);
}

// DA Range
if (!empty($input['da'])) {
    $daParts = [];
    foreach ($input['da'] as $range) {
        [$min, $max] = explode("-", $range);
        $daParts[] = "(da BETWEEN $min AND $max)";
    }
    $conditions[] = "(" . implode(" OR ", $daParts) . ")";
}

// DR Range
if (!empty($input['dr'])) {
    $drParts = [];
    foreach ($input['dr'] as $range) {
        [$min, $max] = explode("-", $range);
        $drParts[] = "(dr BETWEEN $min AND $max)";
    }
    $conditions[] = "(" . implode(" OR ", $drParts) . ")";
}

// // Price Range
// if (!empty($input['price'])) {
//     $priceParts = [];
//     foreach ($input['price'] as $range) {
//         [$min, $max] = explode("-", str_replace("$", "", $range));
//         $priceParts[] = "(price BETWEEN $min AND $max)";
//     }
//     $conditions[] = "(" . implode(" OR ", $priceParts) . ")";
// }

// Price Range
if (!empty($input['price'])) {
    $priceParts = [];
    foreach ($input['price'] as $range) {
        // Remove $ and spaces
        $range = str_replace(["$", " "], "", $range);

        // Handle "1000-" style open-ended range
        if (strpos($range, '-') !== false) {
            [$min, $max] = explode("-", $range);

            if ($max === '') {
                // Open-ended upper range (e.g., 1000+)
                $priceParts[] = "(price > $min)";
            } else {
                $priceParts[] = "(price BETWEEN $min AND $max)";
            }
        }
    }

    if (!empty($priceParts)) {
        $conditions[] = "(" . implode(" OR ", $priceParts) . ")";
    }
}


// Spam Score
// if (!empty($input['spam'])) {
//     $spamParts = [];
//     foreach ($input['spam'] as $range) {
//         preg_match('/(\d+)%.*?(\d+)%/', $range, $matches);
//         if (count($matches) === 3) {
//             $spamParts[] = "(spam_score BETWEEN {$matches[1]} AND {$matches[2]})";
//         }
//     }
//     if (!empty($spamParts)) {
//         $conditions[] = "(" . implode(" OR ", $spamParts) . ")";
//     }
// }


// Spam Score
if (!empty($input['spam'])) {
    $spamParts = [];

    // Loop through each range (e.g., "0-10", "11-30")
    foreach ($input['spam'] as $range) {
        // Split the string into min and max values
        [$min, $max] = explode('-', $range);

        // Make sure both values are numeric before using in SQL
        if (is_numeric($min) && is_numeric($max)) {
            $spamParts[] = "(spam_score BETWEEN $min AND $max)";
        }
    }

    // Add combined condition to the final list
    if (!empty($spamParts)) {
        $conditions[] = '(' . implode(' OR ', $spamParts) . ')';
    }
}


// Status
if (!empty($input['status'])) {
    $conditions[] = buildInCondition("status", $input['status'], $conn);
}

// Added By
if (!empty($input['addedby'])) {
    $conditions[] = buildInCondition("added_by", $input['addedby'], $conn);
}

// Timeline filter (using date_added range)
if (!empty($input['timeline'])) {
    $timelineParts = [];
    foreach ($input['timeline'] as $range) {
        switch ($range) {
            case 'today':
                $timelineParts[] = "DATE(date_added) = CURDATE()";
                break;
            case 'last7':
                $timelineParts[] = "date_added >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                break;
            case 'last30':
                $timelineParts[] = "date_added >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
                break;
            case 'custom':
                if (!empty($input['custom_from']) && !empty($input['custom_to'])) {
                    // $from = $input['custom_from'];
                    // $to = $input['custom_to'];
                    // $timelineParts[] = "(date_added BETWEEN $from AND $to)";
                    $timelineParts[] = "(date_added BETWEEN '" . $input['custom_from'] . "' AND '" . $input['custom_to'] . "')";
                    // $params[] = $input['custom_from'];
                    // $params[] = $input['custom_to'];
                    // $types .= 'ss';
                }
                break;
        }
    }
    if (!empty($timelineParts)) {
        $conditions[] = "(" . implode(" OR ", $timelineParts) . ")";
    }
}


// Count sql
$countSql = "SELECT COUNT(*) as total FROM websites";
if (!empty($conditions)) {
    $countSql .= " WHERE " . implode(" AND ", $conditions);
}

$countResult = $conn->query($countSql);
$total = $countResult->fetch_assoc()['total'];
$totalPages = ceil($total / $pagelimit);

// Build final query
$sql = "SELECT * FROM websites";
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// order by desc id (show latest entry on top)
$sql .= " ORDER BY id DESC";
$sql .= " LIMIT $pagelimit OFFSET $offset";


// Execute the query
$result = $conn->query($sql);
$websites = [];

// Collect results
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
}

// Return as JSON
echo json_encode([
    'totalPages' => $totalPages,
    'status' => 'success',
    // 'count' => count($websites),
    'count' => $total,
    'websites' => $websites,
    'sql' => $sql
]);
