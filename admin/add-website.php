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
    </header>

    <!-- SideBar Menu -->
    <aside>
        <nav class="sidenav">
            <div class="nav-tabs">
                <a href="dashboard.php">
                    <button type="button" class="tab"><i class="fa-solid fa-house"></i>Dashboard</button>
                </a>
                <a>
                    <button type="button" class="tab active" id="addButton"><i class="fa-solid fa-square-plus"></i>Add
                        Website</button>
                </a>
                <a href="dblist.php">
                    <button type="button" class="tab"><i class="fa-solid fa-bars-staggered"></i>DB List</button>
                </a>
                <a href="manage-user.php">
                    <button type="button" class="tab"><i class="fa-solid fa-user"></i>Manage User</button>
                </a>
            </div>
            <button type="button" class="logout-btn" id="logout-btn"><i class="fa-solid fa-power-off"></i>Log
                out</button>
        </nav>
    </aside>

    <!-- Main Content -->
    <main>
        <!-- Filter Boxes -->
        <div class="filters">
            <div class="filter-multiselect">
                <div class="select-box">Category<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" value="cat1">Technology</label>
                    <label><input type="checkbox" value="cat2">Travel</label>
                    <label><input type="checkbox" value="cat3">Food & Recipes</label>
                    <label><input type="checkbox" value="cat4">Lifestyle</label>
                    <label><input type="checkbox" value="cat5">Education</label>
                    <label><input type="checkbox" value="cat6">Finance</label>
                    <label><input type="checkbox" value="cat7">Fashion</label>
                    <label><input type="checkbox" value="cat8">Health & Fitness</label>
                    <label><input type="checkbox" value="cat9">Gaming</label>
                    <label><input type="checkbox" value="cat10">DIY & Home</label>
                    <label><input type="checkbox" value="cat11">News & Politics</label>
                    <label><input type="checkbox" value="cat12">Entertainment</label>
                    <label><input type="checkbox" value="cat13">Business & Marketing</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Traffic<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" value="traffic1">0 - 1K</label>
                    <label><input type="checkbox" value="traffic2">1 - 5K</label>
                    <label><input type="checkbox" value="traffic3">5 - 10K</label>
                    <label><input type="checkbox" value="traffic4">10 - 15K</label>
                    <label><input type="checkbox" value="traffic5">15 - 20K</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Location<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    Global


                    <label><input type="checkbox" value="location1">United States</label>
                    <label><input type="checkbox" value="location2">United Kingdom</label>
                    <label><input type="checkbox" value="location3">Canada</label>
                    <label><input type="checkbox" value="location4">Australia</label>
                    <label><input type="checkbox" value="location5">India</label>
                    <label><input type="checkbox" value="location6">Germany</label>
                    <label><input type="checkbox" value="location7">France</label>
                    <label><input type="checkbox" value="location8">Philippines</label>
                    <label><input type="checkbox" value="location9">Brazil</label>
                    <label><input type="checkbox" value="location10">Italy</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">DA Range<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" value="da1">0 - 10</label>
                    <label><input type="checkbox" value="da2">11 - 20</label>
                    <label><input type="checkbox" value="da3">21 - 30</label>
                    <label><input type="checkbox" value="da4">31 - 40</label>
                    <label><input type="checkbox" value="da5">41 - 50</label>
                    <label><input type="checkbox" value="da6">51 - 60</label>
                    <label><input type="checkbox" value="da7">61 - 70</label>
                    <label><input type="checkbox" value="da8">71 - 80</label>
                    <label><input type="checkbox" value="da9">81 - 90</label>
                    <label><input type="checkbox" value="da10">91 - 100</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">DR Range<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" value="dr1">0 - 10</label>
                    <label><input type="checkbox" value="dr2">11 - 20</label>
                    <label><input type="checkbox" value="dr3">21 - 30</label>
                    <label><input type="checkbox" value="dr4">31 - 40</label>
                    <label><input type="checkbox" value="dr5">41 - 50</label>
                    <label><input type="checkbox" value="dr6">51 - 60</label>
                    <label><input type="checkbox" value="dr7">61 - 70</label>
                    <label><input type="checkbox" value="dr8">71 - 80</label>
                    <label><input type="checkbox" value="dr9">81 - 90</label>
                    <label><input type="checkbox" value="dr10">91 - 100</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Price Range<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" value="price1">$0 - $50</label>
                    <label><input type="checkbox" value="price2">$0 - $100</label>
                    <label><input type="checkbox" value="price3">$0 - $250</label>
                    <label><input type="checkbox" value="price4">$0 - $500</label>
                    <label><input type="checkbox" value="price5">$0 - $1000</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Spam Score<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" value="spamscore1">0 - 10% (Low risk)</label>
                    <label><input type="checkbox" value="spamscore2">11% - 30% (Moderate Risk)</label>
                    <label><input type="checkbox" value="spamscore3">31% - 60% (High Risk)</label>
                    <label><input type="checkbox" value="spamscore4">61% - 100% (Very High Risk)</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Status<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" value="status1">Active</label>
                    <label><input type="checkbox" value="status2">inactive</label>
                    <label><input type="checkbox" value="status3">Under Review</label>
                    <label><input type="checkbox" value="status4">Blocked</label>
                    <label><input type="checkbox" value="status5">Draft</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Added By<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" value="addedby1">Admin</label>
                    <label><input type="checkbox" value="addedby2">Team Member</label>
                    <label><input type="checkbox" value="addedby3">External Conributor</label>
                    <label><input type="checkbox" value="addedby4">Blogger</label>
                    <label><input type="checkbox" value="addedby5">CSV Upload</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Timeline<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" value="timeline1">Today</label>
                    <label><input type="checkbox" value="timeline2">Last 7 Days</label>
                    <label><input type="checkbox" value="timeline3">Last 30 Days</label>
                    <label><input type="checkbox" value="timeline4">This Year</label>
                </div>
            </div>
        </div>
        <!-- Filter Actions -->
        <!-- <div class="more-filter"><a href="#">More Filters</a></div> -->
        <div class="filter-actions">
            <button type="button" class="filter-action" id="apply">Apply Filters</button>
            <button type="button" class="filter-action" id="clear">Clear Filters</button>
        </div>

        <hr>

        <div class="site-count">
            <h4>Total Websites :</h4>
            <h2>48k</h2>
        </div>

        <!--Stats Graph -->
        <div class="sitegraph">
            <canvas id="myChart"></canvas>
        </div>
    </main>

    <!-- <div class="modal-dialog show" id="modal-dialog">
        <div class="modal">
            <div class="modal-header">
                <h3>Add Website</h3>
                <button class="close-btn"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            <hr>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Category Name</label>
                    <select class="form-control">
                        <option value="Technology">Technology</option>
                        <option value="Finance">Finance</option>
                        <option value="Health">Health</option>
                        <option value="Education">Education</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="under-review">Under Review</option>
                        <option value="blocked">Blocked</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Currency</label>
                    <input type="text" class="form-control" value="USD">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" class="form-control" value="280">
                </div>
                <div class="form-group">
                    <label for="">Client Name</label>
                    <input type="text" class="form-control" value="ABV Media Pvt Ltd">
                </div>
                <div class="form-group">
                    <label for="">Blogger Name</label>
                    <input type="text" class="form-control" value="Jasper Kavetzki">
                </div>
                <div class="form-group">
                    <label for="">Blogger Email</label>
                    <input type="text" class="form-control" value="jasper@xyz.com">
                </div>
                <div class="form-group">
                    <label for="">Blogger Mobile</label>
                    <input type="text" class="form-control" value="9895565454">
                </div>
                <div class="form-group">
                    <label for="">Spam Score</label>
                    <input type="text" class="form-control" value="15%">
                </div>
                <div class="form-group">
                    <label for="">DR</label>
                    <input type="text" class="form-control" value="7.6">
                </div>
                <div class="form-group">
                    <label for="">Traffic</label>
                    <input type="text" class="form-control" value="22000">
                </div>
                <div class="form-group">
                    <label for="">DA</label>
                    <input type="text" class="form-control" value="44">
                </div>
                <div class="form-group">
                    <label for="">Web URL</label>
                    <input type="text" class="form-control" value="dailyinvest.com">
                </div>
                <div class="form-group">
                    <label for="">Location</label>
                    <select class="form-control">
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="India">India</option>
                        <option value="Australia">Australia</option>
                        <option value="Australia">Canada</option>
                        <option value="Australia">France</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Mode</label>
                    <select class="form-control">
                        <option value="mode1">Mode 1</option>
                        <option value="mode2">Mode 2</option>
                        <option value="mode3">Mode 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Added By</label>
                    <select class="form-control">
                        <option value="admin">Admin</option>
                        <option value="super-admin">Super Admin</option>
                        <option value="team">Team</option>
                        <option value="outsider">Outsider</option>
                    </select>
                </div>
                <input type="submit" name="addsubmit" class="addsubmit" id="addsubmit" value="Save">
            </div>
            <div class="modal-footer"></div>
        </div>
    </div> -->


    <!-- Common Modal for View/Edit/Add -->
    <div class="modal-dialog" id="modal-dialog-add">
        <div class="modal">
            <div class="modal-header">
                <h3 id="modal-title">Edit Website</h3>
                <button class="close-btn" id="close-btn"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            <hr>
            <div class="modal-body">
                <div class="form-group">
                    <label for="modal-category">Category Name</label>
                    <select id="modal-category" class="form-control">
                        <option value="Technology">Technology</option>
                        <option value="Travel">Travel</option>
                        <option value="Finance">Finance</option>
                        <option value="Lifestyle">Lifestyle</option>
                        <option value="News & Politics">News & Politics</option>
                        <option value="Education">Education</option>
                        <option value="Gaming">Gaming</option>
                        <option value="Health & Fitness">Health & Fitness</option>
                        <option value="Fashion">Fashion</option>
                        <option value="Food & Recipes">Food & Recipes</option>
                        <option value="Business & Marketing">Business & Marketing</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="DIY & Home">DIY & Home</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="modal-status">Status</label>
                    <select id="modal-status" class="form-control">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Blocked">Blocked</option>
                        <option value="Draft">Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="modal-currency">Currency</label>
                    <input type="text" id="modal-currency" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-price">Price</label>
                    <input type="text" id="modal-price" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-client-name">Client Name</label>
                    <input type="text" id="modal-client-name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-blogger-name">Blogger Name</label>
                    <input type="text" id="modal-blogger-name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-blogger-email">Blogger Email</label>
                    <input type="text" id="modal-blogger-email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-blogger-mobile">Blogger Mobile</label>
                    <input type="text" id="modal-blogger-mobile" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-spam-score">Spam Score</label>
                    <input type="text" id="modal-spam-score" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-dr">DR</label>
                    <input type="text" id="modal-dr" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-traffic">Traffic</label>
                    <input type="text" id="modal-traffic" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-da">DA</label>
                    <input type="text" id="modal-da" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-url">Web URL</label>
                    <input type="text" id="modal-url" class="form-control">
                </div>
                <div class="form-group">
                    <label for="modal-location">Location</label>
                    <select id="modal-location" class="form-control">
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="India">India</option>
                        <option value="Australia">Australia</option>
                        <option value="Canada">Canada</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="Italy">Italy</option>
                        <option value="Philippines">Philippines</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="modal-mode">Mode</label>
                    <select id="modal-mode" class="form-control">
                        <option value="Manual">Manual</option>
                        <option value="CSV Upload">CSV Upload</option>
                        <option value="API">API</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="modal-added-by">Added By</label>
                    <select id="modal-added-by" class="form-control">
                        <option value="Admin">Admin</option>
                        <option value="Team Member">Team Member</option>
                        <option value="CSV Upload">CSV Upload</option>
                        <option value="Blogger">Blogger</option>
                        <option value="External Contributor">External Contributor</option>
                    </select>
                </div>
                <input type="submit" class="addsubmit" id="modal-save-btn" value="Save">
            </div>
        </div>
    </div>


    <!-- Footer (optional) -->
    <!-- <footer></footer> -->

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

    <!-- Message Alert
    <div id="message-alert" class="alert-overlay">
        <div class="alert-box">
            <p>Website Added Successfully!</p>
            <div class="alert-actions">
                <button id="ok-btn">Ok</button>
            </div>
        </div>
    </div> -->

    <!-- Scripts -->

    <!-- Save Script -->
    <!-- <script>
        const saveButton = document.getElementById('addsubmit');
        const msgAlert = document.getElementById('message-alert');
        const okBtn = document.getElementById('ok-btn');

        // show message box
        saveButton.onclick = () => {
            msgAlert.style.display = 'flex';
        }

        // close on ok button
        okBtn.onclick = () => {
            msgAlert.style.display = 'none';
            window.location.href = 'dblist.php';
        }

    </script> -->

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
            // Put your logout logic here
            alert("Logged out!");
            window.location.href = 'index.php';
        };

        // If user cancels
        cancelLogout.onclick = () => {
            customAlert.style.display = 'none';
        };
    </script> -->

    <!-- Filter Script -->
    <script>
        const filters = document.querySelectorAll('.filter-multiselect');
        filters.forEach(filter => {
            const selectBox = filter.querySelector('.select-box');
            selectBox.addEventListener('click', (e) => {
                e.stopPropagation();

                // Close all other filters
                filters.forEach(f => {
                    if (f !== filter)
                        f.classList.remove('active');
                })

                //toggle this one
                filter.classList.add('active');
            })
        });

        // click outside to close
        window.addEventListener('click', (e) => {
            filters.forEach(filter => {
                if (!filter.contains(e.target))
                    filter.classList.remove('active');
            });
        });
    </script>

    <!-- Modal Script -->
    <script>
        const modal = document.getElementById('modal-dialog-add');
        const closeBtn = document.querySelector('.close-btn');
        const addBtn = document.getElementById('addButton');

        modal.classList.add('show');

        addBtn.addEventListener('click', function () {
            modal.classList.add('show');
        })

        // when close button inside modal is clicked, close the modal 
        closeBtn.addEventListener('click', () => {
            modal.classList.remove('show');
        });

        window.addEventListener('click', (e) => {
            if (modal === e.target) modal.classList.remove('show');
        })

    </script>

    <script>
        document.getElementById('modal-save-btn').addEventListener('click', function () {
            // Collect input values
            const data = {
                category: document.getElementById('modal-category').value,
                status: document.getElementById('modal-status').value,
                currency: document.getElementById('modal-currency').value,
                price: document.getElementById('modal-price').value,
                client_name: document.getElementById('modal-client-name').value,
                blogger_name: document.getElementById('modal-blogger-name').value,
                blogger_email: document.getElementById('modal-blogger-email').value,
                blogger_mobile: document.getElementById('modal-blogger-mobile').value,
                spam_score: document.getElementById('modal-spam-score').value,
                dr: document.getElementById('modal-dr').value,
                traffic: document.getElementById('modal-traffic').value,
                da: document.getElementById('modal-da').value,
                url: document.getElementById('modal-url').value,
                location: document.getElementById('modal-location').value,
                mode: document.getElementById('modal-mode').value,
                added_by: document.getElementById('modal-added-by').value
            };

            // Send via fetch to backend
            fetch('api/add-website.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(response => {
                    alert(response.message);
                    if (response.status === 'success') {
                        window.location.href = 'dblist.php';
                    }
                })
                .catch(err => {
                    alert('Error adding website');
                    console.error(err);
                });
        });
    </script>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // can be 'line', 'pie', etc.
            data: {
                labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Sample Data',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>