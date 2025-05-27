<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="../assets/wnet-image.png" alt="WildNet logo">
        </div>
        <!-- <div class="search-area">
            <select name="serach-cat" id="search-cat" required>
                <option value="" selected disabled hidden>Search By</option>
                <option value="cat1">Cat 1</option>
                <option value="cat2">Cat 2</option>
                <option value="cat3">Cat 3</option>
                <option value="cat4">Cat 4</option>
            </select>
            <input type="text" class="search-text" placeholder="Search for a website">
        </div> -->
    </header>

    <!-- SideBar Menu -->
    <aside>
        <nav class="sidenav">
            <div class="nav-tabs">
                <a href="#">
                    <button type="button" class="tab active"><i class="fa-solid fa-house"></i>Dashboard</button>
                </a>
                <a href="add-website.php">
                    <button type="button" class="tab" id="addButton"><i class="fa-solid fa-square-plus"></i>Add
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


    <!-- <div class="modal-dialog" id="modal-dialog">
        <div class="modal">
            <div class="modal-header">
                <h3>Add Website</h3>
                <button class="close-btn"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" value="Technology" disabled>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <input type="text" class="form-control" value="Active" disabled>
                </div>
                <div class="form-group">
                    <label for="">Currency</label>
                    <input type="text" class="form-control" value="USD" disabled>
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" class="form-control" value="280" disabled>
                </div>
                <div class="form-group">
                    <label for="">Client Name</label>
                    <input type="text" class="form-control" value="ABV Media Pvt Ltd" disabled>
                </div>
                <div class="form-group">
                    <label for="">Blogger Name</label>
                    <input type="text" class="form-control" value="Jasper Kavetzki" disabled>
                </div>
                <div class="form-group">
                    <label for="">Blogger Email</label>
                    <input type="text" class="form-control" value="jasper@xyz.com" disabled>
                </div>
                <div class="form-group">
                    <label for="">Blogger Mobile</label>
                    <input type="text" class="form-control" value="9895565454" disabled>
                </div>
                <div class="form-group">
                    <label for="">Spam Score</label>
                    <input type="text" class="form-control" value="15%" disabled>
                </div>
                <div class="form-group">
                    <label for="">DR</label>
                    <input type="text" class="form-control" value="7.6" disabled>
                </div>
                <div class="form-group">
                    <label for="">Traffic</label>
                    <input type="text" class="form-control" value="22000" disabled>
                </div>
                <div class="form-group">
                    <label for="">DA</label>
                    <input type="text" class="form-control" value="44" disabled>
                </div>
                <div class="form-group">
                    <label for="">Web URL</label>
                    <input type="text" class="form-control" value="dailyinvest.com" disabled>
                </div>
                <div class="form-group">
                    <label for="">Location</label>
                    <input type="text" class="form-control" value="United Kingdom" disabled>
                </div>
                <div class="form-group">
                    <label for="">Mode</label>
                    <input type="text" class="form-control" value="-" disabled>
                </div>
                <div class="form-group">
                    <label for="">Added By</label>
                    <input type="text" class="form-control" value="Team" disabled>
                </div>
                <div class="form-group">
                    <button type="button" class="addsubmit" id="addsubmit">Save</button>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div> -->

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
    <!-- <script>
        const modal = document.getElementById('modal-dialog');
        const closeBtn = document.querySelector('.close-btn');
        const addBtn = document.getElementById('addButton');

        addBtn.addEventListener('click' , function(){
            modal.classList.add('show');
        })

        // when close button inside modal is clicked, close the modal 
        closeBtn.addEventListener('click', () => {
            modal.classList.remove('show');
        });

        window.addEventListener('click', (e) => {
            if (modal === e.target) modal.classList.remove('show');
        })

    </script> -->

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