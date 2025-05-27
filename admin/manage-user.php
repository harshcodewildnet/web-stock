<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="assets/wnet-image.png" alt="WildNet logo">
        </div>
        <div class="search-area">
            <input type="text" class="search-text" placeholder="Search for a user">
        </div>
    </header>

    <!-- SideBar Menu -->
    <aside>
        <nav class="sidenav">
            <div class="nav-tabs">
                <a href="dashboard.php">
                    <button type="button" class="tab"><i class="fa-solid fa-house"></i>Dashboard</button>
                </a>
                <a href="add-website.php">
                    <button type="button" class="tab" id="addButton"><i class="fa-solid fa-square-plus"></i>Add
                        Website</button>
                </a>
                <a href="dblist.php">
                    <button type="button" class="tab"><i class="fa-solid fa-bars-staggered"></i>DB List</button>
                </a>
                <a href="#">
                    <button type="button" class="tab active"><i class="fa-solid fa-user"></i>Manage User</button>
                </a>
            </div>
            <button type="button" class="logout-btn" id="logout-btn"><i class="fa-solid fa-power-off"></i>Log
                out</button>
        </nav>
    </aside>

    <!-- Main Content -->
    <main style="padding-top: 0;">
        <div class="top-row">
            <div class="site-count">
                <h4>Total Users :</h4>
                <h2>1232</h2>
            </div>
            <a href="add-user.php" class="add-user-btn">Add User</a>
        </div>
        <hr>
        <!-- Content Area -->
        <div class="content-area">
            <div class="table-wrapper">
                <table class="sitelist userlist" style="width: 90%; margin: auto;">
                    <colgroup>
                        <col style="width: 20%;"> <!-- S. No. -->
                        <col style="width: 30%;"> <!-- User Email -->
                        <col style="width: 30%;"> <!-- Password -->
                        <col style="width: 20%;"> <!-- Status -->
                    </colgroup>
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>User Email</th>
                            <th>Password</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>john_rick@testmail.com</td>
                            <td>xyz</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>john_rick@testmail.com</td>
                            <td>123</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>john_rick@testmail.com</td>
                            <td>abc</td>
                            <td>Active</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>john_rick@testmail.com</td>
                            <td>xyz</td>
                            <td>Inactive</td>
                        </tr>
                    </tbody>
                </table>
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

    <!-- Scripts -->

    <!-- Logout Script -->
    <script>
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
            // Put your logout logic here
            alert("Logged out!");
            window.location.href = 'index.php';
        };

        // If user cancels
        cancelLogout.onclick = () => {
            customAlert.style.display = 'none';
        };
    </script>

</body>

</html>