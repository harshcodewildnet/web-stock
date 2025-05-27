<?php
require_once 'includes/auth.php';
requireRole('admin');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <style>
        /* Toggle Switch Styles */
        .switch {
            position: relative;
            display: inline-block;
            width: 36px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* Slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 36px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        /* When Checked */
        input:checked+.slider {
            background-color: #4caf50;
        }

        input:checked+.slider:before {
            transform: translateX(16px);
        }


        .status-text {
            text-transform: capitalize;
        }
    </style>
</head>

<body data-page="quality-checklist">
    <!-- Header Dblist-->
    <header>
        <a href="dashboard.php">
            <div class="logo">
                <img src="assets/wnet-image.png" alt="WildNet logo">
            </div>
        </a>
        <div class="search-area">
            <div class="search-bar">
                <input type="text" class="search-text" id="search-query" placeholder="Search for a website">
                <button id="search-btn" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
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
        <!-- <div class="actions">
        <label id="profile-label">
                <i class="fa-solid fa-user"></i>
                <button>
                    <i class="fa-solid fa-caret-down"></i>
                </button>
            </label>
        </div> -->
    </header>

    <!-- SideBar Menu -->
    <?php
    if ($_SESSION['user_role'] === 'admin') {
        include 'includes/sidebar-admin.php';
    } else {
        include 'includes/sidebar-client.php';
    }
    ?>

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
                                value="United Kingdom">United
                            Kingdom</label>
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
                <div class="filter-multiselect">
                    <div class="select-box">Status<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option status-filter" value="1">Approved</label>
                        <label><input type="checkbox" class="filter-option status-filter" value="0">Pending</label>

                    </div>
                </div>
                <div class="filter-multiselect">
                    <div class="select-box">Added By<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option addedby-filter" value="Admin">Admin</label>
                        <label><input type="checkbox" class="filter-option addedby-filter"
                                value="Execution">Execution</label>
                    </div>
                </div>
                <div class="filter-multiselect">
                    <div class="select-box">Timeline<i class="fa-solid fa-caret-down"></i></div>
                    <div class="options">
                        <label><input type="checkbox" class="select-all timeline-filter" value="">Select All</label>
                        <label><input type="checkbox" class="filter-option timeline-filter" value="today"> Today</label>
                        <label><input type="checkbox" class="filter-option timeline-filter" value="last7"> Last 7
                            Days</label>
                        <label><input type="checkbox" class="filter-option timeline-filter" value="last30"> Last 30
                            Days</label>
                        <label><input type="checkbox" class="filter-option timeline-filter" value="lastyear"> Last
                            Year</label>
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
        <!-- Content Area -->
        <div class="content-area">
            <div class="site-count">
                <h4>Total Websites :</h4>
                <h3 id="website-count">0</h3>
                <div class="pagination">
                    <span class="page" id="first-page-btn">First</span>
                    <span class="" id="prev-btn"><i class="fa-solid fa-chevron-left"></i></span>
                    <span class="page" id="page-no">1</span>
                    <span class="" id="next-btn"><i class="fa-solid fa-chevron-right"></i></span>
                    <span class="page" id="last-page-btn">Last</span>
                </div>
                <?php echo ($_SESSION['user_role'] == 'admin') ? '<a id="download-list-link"><i class="fa-solid fa-download"></i></a>' : '' ?>
            </div>
            <div class="table-wrapper">
                <table class="sitelist">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Website URL</th>
                            <th>Price</th>
                            <th>Client Name</th>
                            <th>DA</th>
                            <th>DR</th>
                            <th>Spam Score</th>
                            <th>Live Link</th>
                            <th>Added By</th>
                            <th>Status</th>
                            <th>Approve</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="siteTableBody">
                        <!-- Dynamic rows will be injected via js> -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Common Modal for View/Edit -->
    <div class="modal-dialog" id="modal-dialog-common">
        <div class="modal">
            <div class="modal-header">
                <h3 id="modal-title">Edit Website</h3>
                <button class="close-btn" id="close-btn"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            <hr>
            <div class="modal-body">
                <!-- Hidden Input For Website Id -->
                <input type="text" id="modal-id" class="form-control" hidden>
                <div class="form-group">
                    <label for="modal-url">Web URL<sup>*</sup></label>
                    <input type="text" id="modal-url" class="form-control" required>
                    <span class="error-message" id="error-modal-url"></span>
                </div>
                <div class="form-group">
                    <label for="modal-live-url">Live URL</label>
                    <input type="text" id="modal-live-url" class="form-control" required>
                    <span class="error-message" id="error-modal-url"></span>
                </div>
                <div class="form-group">
                    <label for="modal-category">Category<sup>*</sup></label>
                    <select id="modal-category" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="General">General</option>
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
                    <span class="error-message" id="error-modal-category"></span>
                </div>
                <!-- <div class="form-group">
                    <label for="modal-status">Status</label>
                    <select id="modal-status" class="form-control">
                        <option value="">-- Select --</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Blocked">Blocked</option>
                        <option value="Draft">Draft</option>
                    </select>
                    <span class="error-message" id="error-modal-status"></span>
                </div> -->
                <div class="form-group">
                    <label for="modal-currency">Currency<sup>*</sup></label>
                    <select id="modal-currency" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="JPY">JPY</option>
                        <option value="CHF">CHF</option>
                        <option value="CAD">CAD</option>
                        <option value="AUD">AUD</option>
                        <option value="NZD">NZD</option>
                        <option value="CNY">CNY</option>
                        <option value="INR">INR</option>
                        <option value="KRW">KRW</option>
                        <option value="RUB">RUB</option>
                        <option value="BRL">BRL</option>
                        <option value="ZAR">ZAR</option>
                        <option value="SGD">SGD</option>
                        <option value="HKD">HKD</option>
                        <option value="SEK">SEK</option>
                        <option value="NOK">NOK</option>
                        <option value="DKK">DKK</option>
                        <option value="MXN">MXN</option>
                        <option value="TRY">TRY</option>
                        <option value="THB">THB</option>
                        <option value="IDR">IDR</option>
                        <option value="MYR">MYR</option>
                        <option value="PHP">PHP</option>
                        <option value="AED">AED</option>
                    </select>
                    <span class="error-message" id="error-modal-currency"></span>
                </div>
                <!-- <div class="form-group">
                    <label for="modal-currency">Currency<sup>*</sup></label>
                    <input type="text" id="modal-currency" class="form-control">
                </div> -->
                <div class="form-group">
                    <label for="modal-price">Price<sup>*</sup></label>
                    <input type="text" id="modal-price" class="form-control" required>
                    <span class="error-message" id="error-modal-price"></span>
                </div>
                <div class="form-group">
                    <label for="modal-client-name">Client Name</label>
                    <input type="text" id="modal-client-name" class="form-control">
                    <span class="error-message" id="error-modal-client-name"></span>
                </div>
                <div class="form-group">
                    <label for="modal-blogger-name">Blogger Name<sup>*</sup></label>
                    <input type="text" id="modal-blogger-name" class="form-control" required>
                    <span class="error-message" id="error-modal-blogger-name"></span>
                </div>
                <div class="form-group">
                    <label for="modal-blogger-email">Blogger Email<sup>*</sup></label>
                    <input type="email" id="modal-blogger-email" class="form-control" required>
                    <span class="error-message" id="error-modal-blogger-email"></span>
                </div>
                <div class="form-group">
                    <label for="modal-blogger-mobile">Blogger Mobile</label>
                    <input type="text" id="modal-blogger-mobile" class="form-control">
                    <span class="error-message" id="error-modal-blogger-mobile"></span>
                </div>
                <div class="form-group">
                    <label for="modal-da">DA<sup>*</sup></label>
                    <input type="text" id="modal-da" class="form-control" required>
                    <span class="error-message" id="error-modal-da"></span>
                </div>
                <div class="form-group">
                    <label for="modal-dr">DR<sup>*</sup></label>
                    <input type="text" id="modal-dr" class="form-control" required>
                    <span class="error-message" id="error-modal-dr"></span>
                </div>

                <div class="form-group">
                    <label for="modal-spam-score">Spam Score<sup>*</sup></label>
                    <input type="text" id="modal-spam-score" class="form-control" required>
                    <span class="error-message" id="error-modal-spam-score"></span>
                </div>

                <div class="form-group">
                    <label for="modal-traffic">Traffic<sup>*</sup></label>
                    <input type="text" id="modal-traffic" class="form-control" required>
                    <span class="error-message" id="error-modal-traffic"></span>
                </div>

                <div class="form-group">
                    <label for="modal-location">Location<sup>*</sup></label>
                    <select id="modal-location" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="United States">United States</option>
                        <option value="Eurozone">Eurozone</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Japan">Japan</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="China">China</option>
                        <option value="India">India</option>
                        <option value="South Korea">South Korea</option>
                        <option value="Russia">Russia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Norway">Norway</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Philippines">Philippines</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                    </select>
                    <span class="error-message" id="error-modal-location"></span>
                </div>

                <!-- <div class="form-group">
                    <label for="modal-mode">Mode</label>
                    <select id="modal-mode" class="form-control">
                        <option value="">-- Select --</option>
                        <option value="Manual">Manual</option>
                        <option value="CSV Upload">CSV Upload</option>
                        <option value="API">API</option>
                    </select>
                    <span class="error-message" id="error-modal-mode"></span>
                </div> -->

                <!-- <div class="form-group">
                    <label for="modal-added-by">Added By<sup>*</sup></label>
                    <select id="modal-added-by" class="form-control" required>
                        <option value="">-- Select --</option>
                        <option value="Admin">Admin</option>
                        <option value="Team Member">Team Member</option>
                    </select>
                    <span class="error-message" id="error-modal-added-by"></span>
                </div> -->
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

    <!-- Message Alert -->
    <div id="message-alert" class="alert-overlay">
        <div class="alert-box">
            <p>Website Updated!</p>
            <div class="alert-actions">
                <button id="ok-btn">Ok</button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/main.js"></script>
    <script src="js/dblist.js"></script>
    <script src="js/download.js"></script>

    <!-- Search Websites Script -->
    <script>

        document.getElementById('search-btn').addEventListener('click', runSearch);
        document.getElementById('search-query').addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                runSearch();
            }
        });

        function runSearch() {
            const query = document.getElementById('search-query').value.trim();
            // if (!query) return alert("Please enter search text.");

            fetch('api/search-websites.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ query })
            })
                .then(res => res.json())
                .then(data => {
                    updateTable(data.websites);
                    document.getElementById('website-count').textContent = data.count;
                })
                .catch(err => {
                    console.error('Search error:', err);
                    alert('Failed to fetch search results.');
                });
        }
    </script>


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

    <!-- Modal Script -->
    <!-- <script>
        const viewModal = document.getElementById('modal-dialog-view');
        const editModal = document.getElementById('modal-dialog-edit');
        const closeBtnView = document.getElementById('close-btn-view');
        const closeBtnEdit = document.getElementById('close-btn-edit');

        // when any view button is clicked open the modal
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.modal-body .form-group input').forEach(inputElement => {
                    inputElement.disabled = true;
                })
                viewModal.classList.add('show');
            })
        });

        // when any view button is clicked open the modal
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.modal-body .form-group input').forEach(inputElement => {
                    inputElement.disabled = false;
                })
                editModal.classList.add('show');
            })
        });

        // when close button inside modal is clicked, close the modal 
        closeBtnView.addEventListener('click', () => {
            viewModal.classList.remove('show');
        });

        // when close button inside modal is clicked, close the modal 
        closeBtnEdit.addEventListener('click', () => {
            editModal.classList.remove('show');
        });

        window.addEventListener('click', (e) => {
            if (viewModal === e.target) viewModal.classList.remove('show');
        })

        window.addEventListener('click', (e) => {
            if (editModal === e.target) editModal.classList.remove('show');
        })

    </script> -->


    <!-- Save Script-->
    <script>
        document.getElementById('modal-save-btn').addEventListener('click', function () {
            const fields = {
                id: 'modal-id',
                category: 'modal-category',
                // status: 'modal-status',
                currency: 'modal-currency',
                price: 'modal-price',
                client_name: 'modal-client-name',
                blogger_name: 'modal-blogger-name',
                blogger_email: 'modal-blogger-email',
                blogger_mobile: 'modal-blogger-mobile',
                spam_score: 'modal-spam-score',
                dr: 'modal-dr',
                traffic: 'modal-traffic',
                da: 'modal-da',
                url: 'modal-url',
                location: 'modal-location',
                // mode: 'modal-mode',
                // added_by: 'modal-added-by'
            };

            // const nameRegex = /^[A-Za-z\s]+$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const mobileRegex = /^\d{10,15}$/;
            const urlRegex = /^(https?:\/\/)?[\w\-]+(\.[\w\-]+)+[/#?]?.*$/i;
            const requiredFields = ['category', 'currency', 'spam_score', 'da', 'dr', 'traffic', 'price', 'blogger_name', 'blogger_email', 'location', 'url'];
            const numericFields = ['price', 'spam_score', 'dr', 'traffic', 'da'];

            let isValid = true;
            const data = {};

            // Clear previous errors
            Object.keys(fields).forEach(key => {
                const input = document.getElementById(fields[key]);
                console.log(input);
                const errorEl = document.getElementById(`error-${fields[key]}`);
                input.classList.remove('error');
                if (errorEl) errorEl.textContent = '';
            });

            // Validate fields
            Object.keys(fields).forEach(key => {
                const value = document.getElementById(fields[key]).value.trim();
                data[key] = value;

                const input = document.getElementById(fields[key]);
                const errorEl = document.getElementById(`error-${fields[key]}`);

                if (requiredFields.includes(key) && !value) {
                    errorEl.textContent = 'This field is required.';
                    input.classList.add('error');
                    isValid = false;
                }

                // if ((key === 'client_name' || key === 'blogger_name') && value && !nameRegex.test(value)) {
                //     errorEl.textContent = 'Only alphabets and spaces are allowed.';
                //     input.classList.add('error');
                //     isValid = false;
                // }

                if (key === 'blogger_email' && value && !emailRegex.test(value)) {
                    errorEl.textContent = 'Invalid email format.';
                    input.classList.add('error');
                    isValid = false;
                }

                if (key === 'url' && value && !urlRegex.test(value)) {
                    errorEl.textContent = 'Invalid URL.';
                    input.classList.add('error');
                    isValid = false;
                }

                if (key === 'blogger_mobile' && value && !mobileRegex.test(value)) {
                    errorEl.textContent = 'Mobile number must be numeric and 10 to 15 digits.';
                    input.classList.add('error');
                    isValid = false;
                }

                if (numericFields.includes(key) && value && isNaN(value)) {
                    errorEl.textContent = 'Must be a number.';
                    input.classList.add('error');
                    isValid = false;
                }
            });

            if (!isValid) {
                // Scroll to first invalid field
                const firstErrorField = document.querySelector('.error');
                if (firstErrorField) {
                    firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstErrorField.focus();
                }
                return;
            }

            // If all validations pass, submit data
            fetch('api/add-website.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(response => {
                    alert(response.message);
                    if (response.status === 'success') {
                        window.location.href = 'quality-checklist.php';
                    }
                })
                .catch(err => {
                    alert('Error updating website');
                    console.error(err);
                });
        });
    </script>
</body>

</html>