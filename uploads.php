<?php
session_start();
require_once 'includes/auth.php';
// requireRole('admin'); // Only admin can access


require_once('includes/db.php');

$result = $conn->query("SELECT * FROM uploads");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Uploads</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/alert.css">

</head>

<body>

    <header>
        <a href="dashboard.php">
            <div class="logo">
                <img src="assets/wnet-image.png" alt="WildNet logo">
            </div>
        </a>
        <div class="search-area">
            <div class="actions">
                <label id="profile-label">
                    <i class="fa-solid fa-user"></i>
                    <button id="profile-toggle">
                        <i class="fa-solid fa-caret-down"></i>
                    </button>
                    <div id="profile-dropdown" class="profile-dropdown">
                        <a href="manage-profile.php" class="dropdown-item">My Profile</a>
                        <hr>
                        <a href="manage-profile.php" class="dropdown-item">Reset Password</a>
                    </div>
                </label>
                <a href="#" id="logout-link">
                    <i class="fa-solid fa-power-off"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </header>

    <!-- SideBar Menu -->
    <?php include 'includes/sidebar-admin.php'; ?>

    <!-- Main Content -->
    <main>
        <div class="top-row">
            <div class="site-count">
                <h2>File Uploads</h2>
            </div>
            <a id="upload-file-link" href="#" class="add-user-btn"><i class="fa-solid fa-circle-plus"></i>Upload CSV</a>
        </div>
        <hr>
        <div class="content-area">
            <div class="table-wrapper">
                <table class="sitelist filelist">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>File Name</th>
                            <th>Uploaded</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while ($file = $result->fetch_assoc()):
                            $filepath = "uploads/" . rawurlencode($file['filename']);
                            ?>
                            <tr>
                                <td><?php echo $i . " ."; ?></td>
                                <td><?php echo htmlspecialchars($file['filename']); ?></td>
                                <td><?php echo htmlspecialchars($file['added']); ?></td>
                                <td><a class="download-link" href="<?php echo htmlspecialchars($filepath); ?>" download><i
                                            class="fa-solid fa-download"></i></a></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- File Upload Modal -->
        <div class="modal-dialog <?php echo (isset($_SESSION['success']) || isset($_SESSION['error'])) ? 'show' : '' ?>"
            id="modal-dialog-upload">
            <div class="modal">
                <div class="modal-header">
                    <h3 id="modal-title">Add File</h3>
                    <button class="close-btn" id="close-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                </div>
                <hr>
                <div class="modal-content">
                    <!-- Alert Box -->
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success" id="messageBox">
                            <?php echo $_SESSION['success']; ?>
                        </div>

                        <script>
                            let countdown = 10;
                            const interval = setInterval(function () {
                                countdown--;
                                if (countdown <= 0) {
                                    clearInterval(interval);
                                    window.location.href = 'uploads.php';
                                }
                            }, 1000);
                        </script>

                        <?php unset($_SESSION['success']); endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger" id="messageBox">
                            <?php echo $_SESSION['error']; ?>
                        </div>

                        <script>
                            let countdown = 10;
                            const interval = setInterval(function () {
                                countdown--;
                                if (countdown <= 0) {
                                    clearInterval(interval);
                                    window.location.href = 'uploads.php';
                                }
                            }, 1000);
                        </script>

                        <?php unset($_SESSION['error']); endif; ?>
                    <?php $templatepath = "data/" . urlencode('template.csv'); ?>
                    <!-- <a class="download-link" href="<?php echo $templatepath; ?>" download><i
                                            class="fa-solid fa-download"></i></a> -->
                    <a id="sample-csv" class="download-link" href="<?php echo $templatepath; ?>" download>Download
                        Template</a>
                    <!-- <form action="api/uploads.php" id="upload-file-form" method="post" enctype="multipart/form-data">
                        <label for="file-input" class="custom-file-label">
                            <i class="fa-solid fa-upload"></i> Select File to Upload
                        </label>
                        <input type="file" name="file-input" id="file-input">
                        <p id="file-name">No file selected</p>
                        <input class="upload-btn" type="submit" value="Upload">
                    </form> -->
                    <form action="api/upload.php" id="upload-file-form" method="post" enctype="multipart/form-data">
                        <label for="file-input" class="custom-file-label">
                            <i class="fa-solid fa-upload"></i> Select File to Upload
                        </label>
                        <input type="file" name="csv_file" id="file-input">
                        <p id="file-name">No file selected</p>
                        <input class="upload-btn" name="submit" type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Logout alert box -->
    <div id="custom-alert" class="alert-overlay">
        <div class="alert-box">
            <p>Are you sure you want to logout?</p>
            <div class="alert-actions">
                <button id="confirm-logout">Yes</button>
                <button id="cancel-logout">No</button>
            </div>
        </div>
    </div>

    <!-- Upload Modal Script -->
    <script>
        const uploadLink = document.getElementById('upload-file-link');
        const uploadModal = document.getElementById('modal-dialog-upload');
        const closeBtn = document.getElementById('close-btn');
        const form = document.getElementById('upload-file-form');
        const fileInput = document.getElementById('file-input');
        const fileNameDisplay = document.getElementById('file-name');

        // Show Upload Modal
        uploadLink.addEventListener('click', function (e) {
            uploadModal.classList.add('show');
        })

        // Close modal on close button
        closeBtn.addEventListener('click', function () {
            uploadModal.classList.remove('show');
        });

        // Close modal when clicking outside modal content
        uploadModal.addEventListener('click', function (e) {
            if (e.target === uploadModal) {
                uploadModal.classList.remove('show');
            }
        });
        // Display Selected File name
        fileInput.addEventListener('change', function () {
            const fileName = this.files[0]?.name || "No file selected";
            fileNameDisplay.textContent = `Selected: ${fileName}`;
        });

        // Prevent form submission if no file selected
        form.addEventListener('submit', function (e) {
            if (!fileInput.value) {
                e.preventDefault();
                alert("Please select a file before submitting.");
            }
        });

    </script>
</body>

</html>