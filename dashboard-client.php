<?php
require_once 'includes/auth.php';
requireRole('user'); // or 'user'

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
</head>

<body>
    <!-- Alert Box -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success" id="messageBox">
            <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" id="messageBox">
            <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); endif; ?>

    <!-- Header Dblist-->
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
    <?php include 'includes/sidebar-client.php'; ?>

    <!-- Main Content -->
    <main>
        <div class="filters-container">
            <!-- Filter Boxes -->
            <div class="filters">
                <div class="filter-multiselect">
                    <div class="select-box">Category<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="General">General</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Technology">Technology</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Travel">Travel</label>
                        <label><input type="checkbox" class="filter-option category-filter" value="Food & Recipes">Food
                            &
                            Recipes</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Lifestyle">Lifestyle</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Education">Education</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Business & Marketing">Business & Marketing</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Finance">Finance</label>
                        <label><input type="checkbox" class="filter-option category-filter" value="News & Politics">News
                            &
                            Politics</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Health & Fitness">Health
                            & Fitness</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Entertainment">Entertainment</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Gaming">Gaming</label>
                        <label><input type="checkbox" class="filter-option category-filter"
                                value="Fashion">Fashion</label>
                        <label><input type="checkbox" class="filter-option category-filter" value="DIY & Home">DIY &
                            Home</label>
                    </div>
                </div>
                <div class="filter-multiselect">
                    <div class="select-box">Traffic<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option traffic-filter" value="0-1000">0 - 1K</label>
                        <label><input type="checkbox" class="filter-option traffic-filter" value="1000-5000">1K -
                            5K</label>
                        <label><input type="checkbox" class="filter-option traffic-filter" value="5000-10000">5K -
                            10K</label>
                        <label><input type="checkbox" class="filter-option traffic-filter" value="10000-15000">10K -
                            15K</label>
                        <label><input type="checkbox" class="filter-option traffic-filter" value="15000-20000">15K -
                            20K</label>
                        <label><input type="checkbox" class="filter-option traffic-filter" value="20000+">Above
                            20k</label>
                    </div>
                </div>
                <div class="filter-multiselect">
                    <div class="select-box">Location<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Global">Global</label>
                        <label><input type="checkbox" class="filter-option location-filter" value="United States">United
                            States</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="United Kingdom">United Kingdom</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="France">France</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Germany">Germany</label>
                        <label><input type="checkbox" class="filter-option location-filter" value="Italy">Italy</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Netherlands">Netherlands</label>
                        <label><input type="checkbox" class="filter-option location-filter" value="Japan">Japan</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Switzerland">Switzerland</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Canada">Canada</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Australia">Australia</label>
                        <label><input type="checkbox" class="filter-option location-filter" value="New Zealand">New
                            Zealand</label>
                        <label><input type="checkbox" class="filter-option location-filter" value="China">China</label>
                        <label><input type="checkbox" class="filter-option location-filter" value="India">India</label>
                        <label><input type="checkbox" class="filter-option location-filter" value="South Korea">South
                            Korea</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Russia">Russia</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Brazil">Brazil</label>
                        <label><input type="checkbox" class="filter-option location-filter" value="South Africa">South
                            Africa</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Singapore">Singapore</label>
                        <label><input type="checkbox" class="filter-option location-filter" value="Hong Kong">Hong
                            Kong</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Sweden">Sweden</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Norway">Norway</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Denmark">Denmark</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Mexico">Mexico</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Turkey">Turkey</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Thailand">Thailand</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Indonesia">Indonesia</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Malaysia">Malaysia</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="Philippines">Philippines</label>
                        <label><input type="checkbox" class="filter-option location-filter"
                                value="United Arab Emirates">United Arab Emirates</label>
                    </div>
                </div>
                <div class="filter-multiselect">
                    <div class="select-box">DA Range<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="0-10">0 - 10</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="10-20">10 - 20</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="20-30">20 - 30</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="30-40">30 - 40</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="40-50">40 - 50</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="50-60">50 - 60</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="60-70">60 - 70</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="70-80">70 - 80</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="80-90">80 - 90</label>
                        <label><input type="checkbox" class="filter-option da-filter" value="90-100">90 - 100</label>
                    </div>
                </div>
                <div class="filter-multiselect">
                    <div class="select-box">DR Range<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="0-10">0 - 10</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="10-20">10 - 20</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="20-30">20 - 30</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="30-40">30 - 40</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="40-50">40 - 50</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="50-60">50 - 60</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="60-70">60 - 70</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="70-80">70 - 80</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="80-90">80 - 90</label>
                        <label><input type="checkbox" class="filter-option dr-filter" value="90-100">90 - 100</label>
                    </div>
                </div>
                <div class="filter-multiselect">
                    <div class="select-box">Price Range<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option price-filter" value="0-50">$0 - $50</label>
                        <label><input type="checkbox" class="filter-option price-filter" value="50-100">$50 -
                            $100</label>
                        <label><input type="checkbox" class="filter-option price-filter" value="100-250">$100 -
                            $250</label>
                        <label><input type="checkbox" class="filter-option price-filter" value="250-500">$250 -
                            $500</label>
                        <label><input type="checkbox" class="filter-option price-filter" value="500-1000">$500 -
                            $1000</label>
                        <label><input type="checkbox" class="filter-option price-filter" value="1000+">Above
                            $1000</label>
                    </div>
                </div>
                <div class="filter-multiselect">
                    <div class="select-box">Spam Score<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option spam-filter" value="0-10">0 - 10% (Low
                            risk)</label>
                        <label><input type="checkbox" class="filter-option spam-filter" value="10-30">10% - 30%
                            (Moderate
                            Risk)</label>
                        <label><input type="checkbox" class="filter-option spam-filter" value="30-60">30% - 60% (High
                            Risk)</label>
                        <label><input type="checkbox" class="filter-option spam-filter" value="60-100">60% - 100% (Very
                            High
                            Risk)</label>
                    </div>
                </div>
                <!-- <div class="filter-multiselect">
                <div class="select-box">Status<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="select-all" value="">Select All</label>
                    <label><input type="checkbox" class="filter-option status-filter" value="Active">Active</label>
                    <label><input type="checkbox" class="filter-option status-filter" value="Inactive">Inactive</label>
                    <label><input type="checkbox" class="filter-option status-filter" value="Under">Under Review</label>
                    <label><input type="checkbox" class="filter-option status-filter" value="Blocked">Blocked</label>
                    <label><input type="checkbox" class="filter-option status-filter" value="Draft">Draft</label>
                </div>
            </div> -->
                <!-- <div class="filter-multiselect">
                <div class="select-box">Added By<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="select-all" value="">Select All</label>
                    <label><input type="checkbox" class="filter-option addedby-filter" value="Admin">Admin</label>
                    <label><input type="checkbox" class="filter-option addedby-filter" value="Team Member">Team Member</label>
                </div>
            </div> -->
                <div class="filter-multiselect">
                    <div class="select-box">Timeline<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all timeline-filter" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option timeline-filter" value="today"> Today</label>
                        <label><input type="checkbox" class="filter-option timeline-filter" value="last7"> Last 7
                            Days</label>
                        <label><input type="checkbox" class="filter-option timeline-filter" value="last30"> Last 30
                            Days</label>
                        <!-- <label><input type="checkbox" class="filter-option timeline-filter" value="lastyear"> Last
                        Year</label> -->
                        <label id="custom-range-label">
                            <input type="checkbox" class="timeline-filter custom-range-checkbox" value="custom"> Custom
                            <div class="custom-date-range" style="display: none;">
                                From -
                                <input type="date" class="custom-from-date" placeholder="From">
                                To -
                                <input type="date" class="custom-to-date" placeholder="To">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Filter Actions -->
            <!-- <div class="more-filter"><a href="#">More Filters</a></div> -->
            <div class="filter-actions">
                <button type="button" class="filter-action" id="apply">Apply Filters</button>
                <button type="button" class="filter-action" id="clear">Clear Filters</button>
            </div>
        </div>

        <hr>
        <div class="content-area graphcontent">
            <div class="site-count">
                <h4>Total Websites :</h4>
                <h3 id="website-count">0</h3>
            </div>
            <!-- Graphs -->
            <div class="sitegraph">
                <div class="graph">
                    <canvas id="categoryChart"></canvas>
                </div>
                <div class="graph">
                    <canvas id="trafficChart"></canvas>
                </div>
                <div class="graph">
                    <canvas id="daChart"></canvas>
                </div>
                <div class="graph">
                    <canvas id="approvalChart"></canvas>
                </div>
            </div>
        </div>
    </main>

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

    <!-- Filter Script -->
    <script>
        const filters = document.querySelectorAll('.filter-multiselect');

        filters.forEach(filter => {
            const selectBox = filter.querySelector('.select-box');
            const options = filter.querySelector('.options');

            // Toggle dropdown
            selectBox.addEventListener('click', (e) => {
                e.stopPropagation();

                if (filter.classList.contains('active')) {
                    filter.classList.remove('active');
                    return;
                }

                filters.forEach(f => {
                    if (f !== filter) f.classList.remove('active');
                });

                filter.classList.add('active');
            });

            if (options) {
                options.addEventListener('click', e => e.stopPropagation());
            }
        });

        // Close all on outside click
        window.addEventListener('click', () => {
            filters.forEach(filter => {
                filter.classList.remove('active');
            });
        });
    </script>

    <!-- Select All Checkbox Script -->
    <script>
        document.querySelectorAll('.select-all').forEach(selectAllCheckbox => {
            selectAllCheckbox.addEventListener('change', function () {
                const container = this.closest('.filter-multiselect');
                const checkboxes = container.querySelectorAll('input[type="checkbox"]:not(.select-all)');
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });

        // Sync "Select All" when individual checkboxes are changed
        document.querySelectorAll('.filter-option').forEach(option => {
            option.addEventListener('change', function () {
                const container = this.closest('.filter-multiselect');
                const allCheckboxes = container.querySelectorAll('.filter-option');
                const allChecked = Array.from(allCheckboxes).every(cb => cb.checked);
                container.querySelector('.select-all').checked = allChecked;
            });
        });

    </script>

    <!-- Timeline Calender -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const customCheckbox = document.querySelector('.custom-range-checkbox');
            const dateRange = document.querySelector('.custom-date-range');
            const allCheckboxes = document.querySelectorAll('.timeline-filter:not(.custom-range-checkbox)');
            const fromDate = document.querySelector('.custom-from-date');
            const toDate = document.querySelector('.custom-to-date');

            // Handle custom checkbox toggle
            customCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    dateRange.style.display = 'block';

                    // Disable other checkboxes
                    allCheckboxes.forEach(cb => {
                        cb.checked = false;
                    });
                } else {
                    dateRange.style.display = 'none';
                }
            });

            // Handle other checkboxes
            allCheckboxes.forEach(cb => {
                cb.addEventListener('change', function () {
                    if (this.checked) {
                        customCheckbox.checked = false;
                        dateRange.style.display = 'none';
                    }
                });
            });

            dateRange.style.display = customCheckbox.checked ? 'block' : 'none';
        });

    </script>


    <!-- Graphs Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="js/graph.js"></script>

</body>

</html>