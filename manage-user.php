<?php
session_start();
require_once 'includes/auth.php';
requireRole('admin'); // Only admin can access

require_once 'includes/db.php';

$result = $conn->query("SELECT * FROM user where role = 'user' ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="css/alert.css">
</head>

<body>

    <!-- Header-->
    <header>
        <a href="dashboard.php">
            <div class="logo">
                <img src="assets/wnet-image.png" alt="WildNet logo">
            </div>
        </a>
        <div class="search-area">
            <!-- <select name="serach-cat" id="search-cat" required>
                <option value="" selected disabled hidden>Search By</option>
                <option value="cat1">Name</option>
                <option value="cat2">URL</option>
                <option value="cat3">Domain</option>
            </select> -->
            <div class="search-bar">
                <input type="text" class="search-text" id="search-query" placeholder="Search for a user">
                <button id="search-btn" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <!-- <input type="text" name="search-user" class="search-text" id="search-user" placeholder="Search for a user"> -->
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
                <!-- <label id="logout-label">
                    <i class="fa-solid fa-power-off"></i>
                    <span>Logout</span>
                </label> -->
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
    <main style="padding-top: 0;">
        <div class="top-row">
            <div class="site-count">
                <h4>Total Users :</h4>
                <h2 id="users-count"><?php echo $result->num_rows; ?></h2>
            </div>
            <a href="add-user.php" class="add-user-btn"><i class="fa-solid fa-circle-plus"></i>Add User</a>
        </div>
        <hr>
        <!-- Content Area -->
        <div class="content-area">
            <!-- Alert Box -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success" id="messageBox">
                    <?php echo $_SESSION['success']; ?>
                </div>
                <script>
                    let countdown = 3;
                    const interval = setInterval(function () {
                        countdown--;
                        if (countdown <= 0) {
                            clearInterval(interval);
                            window.location.href = 'manage-user.php';
                        }
                    }, 1000);
                </script>
                <?php unset($_SESSION['success']); endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger" id="messageBox">
                    <?php echo $_SESSION['error']; ?>
                </div>
                <script>
                    let countdown = 3;
                    const interval = setInterval(function () {
                        countdown--;
                        if (countdown <= 0) {
                            clearInterval(interval);
                            window.location.href = 'manage-user.php';
                        }
                    }, 1000);
                </script>
                <?php unset($_SESSION['error']); endif; ?>
            <div class="table-wrapper">
                <table class="sitelist userlist" style="width: 100%; margin: auto;">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>User Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="siteTableBody">
                        <?php $i = 1; ?>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($user = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <!-- <td><?php echo htmlspecialchars($user['role']); ?></td> -->
                                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                                    <td><?php echo htmlspecialchars($user['status']) == 1 ? 'active' : 'inactive'; ?></td>
                                    <td>
                                        <a class="edit-user-btn" href="edit-user.php?id=<?php echo $user['user_id']; ?>"><i
                                                class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                        <a class="delete-user-btn" href="#"
                                            onclick="deleteUser(event, <?php echo $user['user_id'] ?>)"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr id="empty-row">
                                <td colspan="6">
                                    No Users
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Logout alert box -->
    <div id="custom-alert" class="alert-overlay">
        <div class="alert-box" id="alert-box-logout">
            <p>Are you sure you want to logout?</p>
            <div class="alert-actions">
                <button id="confirm-logout">Yes</button>
                <button id="cancel-logout">No</button>
            </div>
        </div>
    </div>

    <!-- Delete User Alert -->
    <div id="custom-alert-delete" class="alert-overlay">
        <div class="alert-box" id="alert-box-delete">
            <p id="delete-alert-msg"></p>
            <div class="alert-actions">
                <button id="confirm-delete">Delete</button>
                <button id="cancel-delete">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Scripts -->

    <!-- Logout Script -->
    <!-- <script>
        const logoutBtn = document.getElementById('logout-btn');
        const customAlert = document.getElementById('custom-alert');
        const confirmLogout = document.getElementById('confirm-logout');
        const cancelLogout = document.getElementById('cancel-logout');

        // Show the alert box
        logoutBtn.onclick = () => {
            customAlert.style.display = 'flex';
        };

        // If user confirms logout
        confirmLogout.onclick = () => {
            customAlert.style.display = 'none';
            window.location.href = 'logout.php';
        };

        // If user cancels
        cancelLogout.onclick = () => {
            customAlert.style.display = 'none';
        };
    </script> -->

    <script>
        // document.addEventListener('DOMContentLoaded', () => {
        //     const deleteBtn = document.getElementById('');
        //     const alertBox = document.querySelector('.alert-box');
        //     const logOutAlert = document.getElementById('custom-alert');
        //     const confirmLogout = document.getElementById('confirm-logout');
        //     const cancelLogout = document.getElementById('cancel-logout');

        //     logoutBtn.onclick = (e) => {
        //         e.preventDefault();
        //         logOutAlert.style.display = 'flex';
        //     };

        //     confirmLogout.onclick = () => {
        //         logOutAlert.style.display = 'none';
        //         window.location.href = 'logout.php';
        //     };

        //     cancelLogout.onclick = () => {
        //         logOutAlert.style.display = 'none';
        //     };

        //     document.addEventListener('click', (e) => {
        //         if (logOutAlert.style.display === 'flex') {
        //             if (!alertBox.contains(e.target) && !logoutBtn.contains(e.target)) {
        //                 logOutAlert.style.display = 'none';
        //             }
        //         }
        //     });
        // });
    </script>

    <script src="js/user.js"></script>

</body>

</html>