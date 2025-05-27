<?php
header('Content-Type: application/json');
require '../includes/db.php';

$response = [
    'status' => 'error',
    'message' => '',
    'data' => null,
];

try {
    if (!$conn)
        throw new Exception("Database connection failed.");

    $input = json_decode(file_get_contents("php://input"), true);

    $traffic_ranges = [
        '0-1K' => [0, 1000],
        '1K-10K' => [1001, 10000],
        '10K-50K' => [10001, 50000],
        '50K+' => [50001, PHP_INT_MAX]
    ];

    $da_ranges = [
        '0-10' => [0, 10],
        '11-30' => [11, 30],
        '31-50' => [31, 50],
        '51+' => [51, PHP_INT_MAX]
    ];

    // Build WHERE clause
    $where = [];
    $params = [];
    $types = '';

    // Helper to add IN clauses
    function addInFilter($field, $values, &$where, &$params, &$types)
    {
        if (!empty($values)) {
            $in = implode(',', array_fill(0, count($values), '?'));
            $where[] = "$field IN ($in)";
            foreach ($values as $v) {
                $params[] = $v;
                $types .= 's';
            }
        }
    }

    addInFilter('category', $input['category'] ?? [], $where, $params, $types);
    addInFilter('location', $input['location'] ?? [], $where, $params, $types);
    addInFilter('status', $input['status'] ?? [], $where, $params, $types);
    addInFilter('added_by', $input['addedby'] ?? [], $where, $params, $types);

    // Numeric filters
    function addRangeFilter($field, $ranges, &$where, &$params, &$types)
    {
        $or = [];

        foreach ($ranges as $range) {
            $range = trim($range);

            if (preg_match('/^(\d+)\+$/', $range, $m)) {
                // e.g. "1000+"
                $min = (int) $m[1];
                $or[] = "($field >= ?)";
                $params[] = $min;
                $types .= 'i';

            } elseif (preg_match('/^(\d+)-(\d+)$/', $range, $m)) {
                // e.g. "100-500"
                $or[] = "($field BETWEEN ? AND ?)";
                $params[] = (int) $m[1];
                $params[] = (int) $m[2];
                $types .= 'ii';
            }
        }

        if (!empty($or)) {
            $where[] = '(' . implode(' OR ', $or) . ')';
        }
    }


    addRangeFilter('traffic', $input['traffic'] ?? [], $where, $params, $types);
    addRangeFilter('da', $input['da'] ?? [], $where, $params, $types);
    addRangeFilter('dr', $input['dr'] ?? [], $where, $params, $types);
    addRangeFilter('price', $input['price'] ?? [], $where, $params, $types);
    addRangeFilter('spam_score', $input['spam'] ?? [], $where, $params, $types);

    // Timeline (date_added range filter)
    if (!empty($input['timeline'])) {
        $or = [];
        foreach ($input['timeline'] as $t) {
            if ($t === 'today') {
                $or[] = "DATE(date_added) = CURDATE()";
            } elseif ($t === 'last7') {
                $or[] = "date_added >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
            } elseif ($t === 'last30') {
                $or[] = "date_added >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
            // } elseif ($t === 'lastyear') {
            //     $or[] = "date_added >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
            } elseif ($t === 'custom' && !empty($input['custom_from']) && !empty($input['custom_to'])) {
                $or[] = "(date_added BETWEEN ? AND ?)";
                $params[] = $input['custom_from'];
                $params[] = $input['custom_to'];
                $types .= 'ss';
            }
        }
        if ($or)
            $where[] = '(' . implode(' OR ', $or) . ')';
    }

    $whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

    $data = [
        'traffic' => [],
        'category' => [],
        'approval' => [],
        'da' => [],
        // 'count' => []
    ];

    // Prepare function with filters
    function runPreparedQuery($conn, $sql, $types, $params)
    {
        $stmt = $conn->prepare($sql);
        if (!$stmt)
            throw new Exception("Query preparation failed: $sql");
        if ($types && $params)
            $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 1. Traffic
    foreach ($traffic_ranges as $label => [$min, $max]) {
        $sql = "SELECT COUNT(*) as count FROM websites $whereSql" . ($whereSql ? ' AND' : ' WHERE') . " traffic BETWEEN ? AND ?";
        $rParams = $params;
        $rTypes = $types . 'ii';
        $rParams[] = $min;
        $rParams[] = $max;

        $result = runPreparedQuery($conn, $sql, $rTypes, $rParams)->fetch_assoc();
        $data['traffic'][$label] = (int) $result['count'];
    }

    // 2. Category
    $sql = "SELECT category, COUNT(*) as count FROM websites $whereSql GROUP BY category";
    $result = runPreparedQuery($conn, $sql, $types, $params);
    while ($row = $result->fetch_assoc()) {
        $data['category'][$row['category']] = (int) $row['count'];
    }
    $response['datacat'] = $data['category'];


    // 3. Approval per Category
    $sql = "SELECT category, COUNT(*) as count FROM websites $whereSql" . ($whereSql ? ' AND' : ' WHERE') . " status = 1 GROUP BY category";
    $result = runPreparedQuery($conn, $sql, $types, $params);
    while ($row = $result->fetch_assoc()) {
        $data['approval'][$row['category']] = (int) $row['count'];
    }

    // 4. DA
    foreach ($da_ranges as $label => [$min, $max]) {
        $sql = "SELECT COUNT(*) as count FROM websites $whereSql" . ($whereSql ? ' AND' : ' WHERE') . " da BETWEEN ? AND ?";
        $rParams = $params;
        $rTypes = $types . 'ii';
        $rParams[] = $min;
        $rParams[] = $max;

        $result = runPreparedQuery($conn, $sql, $rTypes, $rParams)->fetch_assoc();
        $data['da'][$label] = (int) $result['count'];
    }


    $sql = "SELECT COUNT(*) AS count FROM websites $whereSql";
    $result = runPreparedQuery($conn, $sql, $types, $params)->fetch_assoc();
    $data['count'] = (int) $result['count'];
    $response['status'] = 'success';
    $response['data'] = $data;

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
