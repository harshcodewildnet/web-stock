
<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';

if (isset($_POST['submit'])) {

    if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "No file uploaded or upload failed.";
        header("Location: ../uploads.php");
        exit;
    }

    $file = $_FILES['csv_file'];
    $filename = basename($file['name']);
    $fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $tempPath = $file['tmp_name'];
    $uploadDir = "../uploads/";
    $targetPath = $uploadDir . $filename;

    // Check file type and size
    if (!in_array($fileType, ['csv'])) {
        $_SESSION['error'] = "Only CSV files are allowed.";
        header("Location: ../uploads.php");
        exit;
    }

    if ($file['size'] > 5 * 1024 * 1024) {
        $_SESSION['error'] = "File size exceeds 5MB limit.";
        header("Location: ../uploads.php");
        exit;
    }

    // Step 1: Check if file already exists (in DB)
    $stmt = $conn->prepare("SELECT * FROM uploads WHERE filename = ?");
    $stmt->bind_param("s", $filename);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $_SESSION['error'] = "This file is already uploaded.";
        header("Location: ../uploads.php");
        exit;
    }

    // Step 2: Validate headers
    $handle = fopen($tempPath, 'r');
    if ($handle === false) {
        $_SESSION['error'] = "Unable to read the uploaded file.";
        header("Location: ../uploads.php");
        exit;
    }

    $expectedHeader = [
        'Category', 'Url', 'Currency', 'Price', 'Client Name',
        'Blogger Name', 'Blogger Email', 'Blogger Mobile', 'Spam Score',
        'DR', 'Traffic', 'DA', 'Location', 'Mode',
        'Added By', 'Status'
    ];
    $header = fgetcsv($handle);
    if ($header === false || array_map('trim', $header) !== $expectedHeader) {
        $_SESSION['error'] = "Invalid headers. Use the official CSV template.";
        fclose($handle);
        header("Location: ../uploads.php");
        exit;
    }

    // Step 3: Validate and Insert rows into DB
    $stmtInsert = $conn->prepare("INSERT INTO websites (
        category, url, currency, price, client_name, blogger_name,
        blogger_email, blogger_mobile, spam_score, dr, traffic, da,
        location, mode, added_by, status, date_added
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

    if ($stmtInsert === false) {
        $_SESSION['error'] = "DB error (prepare): " . $conn->error;
        fclose($handle);
        header("Location: ../uploads.php");
        exit;
    }

    $lineNum = 2;
    $rowCount = 0;
    $errorCount = 0;
    $invalidRows = [];
    $rowsToInsert = [];

    // Validation mappings
    $columnMap = [
        3 => 'Price',
        8 => 'Spam Score',
        9 => 'DR',
        10 => 'Traffic',
        11 => 'DA',
        16 => 'Approved'
    ];
    $allowedSelects = [
        'currency' => ['USD', 'INR', 'EUR', 'GBP','JPY','CHF','CAD','AUD','NZD','CNY','INR','KRW','RUB','BR L','ZAR','SGD','HKD','SEK','NOK','DKK','MXN','TRY','THB','IDR','MYR','PHP','AED'],
        'mode' => ['Manual', 'CSV Upload'],
        'status' => ['1', '0']
    ];

    while (($row = fgetcsv($handle)) !== false) {
        if (count(array_filter($row)) === 0) {
            $lineNum++;
            continue;
        }

        if (count($row) !== count($expectedHeader)) {
            $invalidRows[] = "Line $lineNum: Incorrect number of columns.";
            $errorCount++;
            $lineNum++;
            continue;
        }

        $data = array_map('trim', $row);

        if (!filter_var($data[1], FILTER_VALIDATE_URL)) {
            $invalidRows[] = "Line $lineNum: Invalid URL.";
            $errorCount++;
            $lineNum++;
            continue;
        }

        if (!filter_var($data[6], FILTER_VALIDATE_EMAIL)) {
            $invalidRows[] = "Line $lineNum: Invalid Email.";
            $errorCount++;
            $lineNum++;
            continue;
        }

        $fieldErrors = [];

        foreach ($columnMap as $index => $name) {
            if ($index == 16 && !in_array($data[$index], ['0', '1'])) {
                $fieldErrors[] = "$name must be 0 or 1";
            } elseif (!is_numeric($data[$index])) {
                $fieldErrors[] = "$name must be numeric";
            }
        }

        if (!in_array($data[2], $allowedSelects['currency'])) {
            $fieldErrors[] = "Currency must be one of: " . implode(', ', $allowedSelects['currency']);
        }
        if (!in_array($data[13], $allowedSelects['mode'])) {
            $fieldErrors[] = "Mode must be one of: " . implode(', ', $allowedSelects['mode']);
        }
        if (!in_array($data[15], $allowedSelects['status'])) {
            $fieldErrors[] = "Status must be one of: " . implode(', ', $allowedSelects['status']);
        }

        if (!empty($fieldErrors)) {
            $invalidRows[] = "Line $lineNum: " . implode("; ", $fieldErrors);
            $errorCount++;
            $lineNum++;
            continue;
        }

        // All validated
        $rowsToInsert[] = $data;
        $lineNum++;
    }
    fclose($handle);

    // If any row has error, stop here
    if ($errorCount > 0) {
        $_SESSION['error'] = "$errorCount row(s) had errors:<br>" . implode("<br>", $invalidRows);
        header("Location: ../uploads.php");
        exit;
    }

    // Step 4: Insert all rows
    foreach ($rowsToInsert as $data) {
        $stmtInsert->bind_param(
            "sssdssssdddissssi",
            $data[0], $data[1], $data[2], $data[3], $data[4],
            $data[5], $data[6], $data[7], $data[8], $data[9],
            $data[10], $data[11], $data[12], $data[13], $data[14],
            $data[15], $data[16]
        );

        if ($stmtInsert->execute()) {
            $rowCount++;
        } else {
            $_SESSION['error'] = "DB insert error at line $lineNum: " . $stmtInsert->error;
            header("Location: ../uploads.php");
            exit;
        }
    }

    $stmtInsert->close();

    // Step 5: Move uploaded file and log in uploads table
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!move_uploaded_file($tempPath, $targetPath)) {
        $_SESSION['error'] = "Rows inserted but failed to move uploaded file.";
        header("Location: ../uploads.php");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO uploads (filename) VALUES (?)");
    $stmt->bind_param("s", $filename);
    $stmt->execute();

    $conn->close();

    $_SESSION['success'] = "$rowCount row(s) imported and file uploaded successfully.";
    header("Location: ../uploads.php");
    exit;
}
?>
