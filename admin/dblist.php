<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="js/dblist.js"></script>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="assets/wnet-image.png" alt="WildNet logo">
        </div>
        <div class="search-area">
            <select name="serach-cat" id="search-cat" required>
                <option value="" selected disabled hidden>Search By</option>
                <option value="cat1">Name</option>
                <option value="cat2">URL</option>
                <option value="cat3">Domain</option>
            </select>
            <input type="text" class="search-text" placeholder="Search for a website">
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
                    <button type="button" class="tab"><i class="fa-solid fa-square-plus"></i>Add Website</button>
                </a>
                <a href="#">
                    <button type="button" class="tab active"><i class="fa-solid fa-bars-staggered"></i>DB List</button>
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
                    <label><input type="checkbox" class="category-filter" value="Technology">Technology</label>
                    <label><input type="checkbox" class="category-filter" value="Travel">Travel</label>
                    <label><input type="checkbox" class="category-filter" value="Food & Recipes">Food & Recipes</label>
                    <label><input type="checkbox" class="category-filter" value="Lifestyle">Lifestyle</label>
                    <label><input type="checkbox" class="category-filter" value="Education">Education</label>
                    <label><input type="checkbox" class="category-filter" value="Finance">Finance</label>
                    <label><input type="checkbox" class="category-filter" value="Fashion">Fashion</label>
                    <label><input type="checkbox" class="category-filter" value="Health & Fitness">Health & Fitness</label>
                    <label><input type="checkbox" class="category-filter" value="Gaming">Gaming</label>
                    <label><input type="checkbox" class="category-filter" value="DIY & Home">DIY & Home</label>
                    <label><input type="checkbox" class="category-filter" value="News & Politics">News & Politics</label>
                    <label><input type="checkbox" class="category-filter" value="Entertainment">Entertainment</label>
                    <label><input type="checkbox" class="category-filter" value="Business & Marketing">Business & Marketing</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Traffic<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="traffic-filter" value="0-1000">0 - 1K</label>
                    <label><input type="checkbox" class="traffic-filter" value="1000-5000">1K - 5K</label>
                    <label><input type="checkbox" class="traffic-filter" value="5000-10000">5K - 10K</label>
                    <label><input type="checkbox" class="traffic-filter" value="10000-15000">10 - 15K</label>
                    <label><input type="checkbox" class="traffic-filter" value="15000-20000">15 - 20K</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Location<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="location-filter" value="Global">Global</label>
                    <label><input type="checkbox" class="location-filter" value="United States">United States</label>
                    <label><input type="checkbox" class="location-filter" value="United Kingdom">United Kingdom</label>
                    <label><input type="checkbox" class="location-filter" value="Canada">Canada</label>
                    <label><input type="checkbox" class="location-filter" value="Australia">Australia</label>
                    <label><input type="checkbox" class="location-filter" value="India">India</label>
                    <label><input type="checkbox" class="location-filter" value="Germany">Germany</label>
                    <label><input type="checkbox" class="location-filter" value="France">France</label>
                    <label><input type="checkbox" class="location-filter" value="Philippines">Philippines</label>
                    <label><input type="checkbox" class="location-filter" value="Brazil">Brazil</label>
                    <label><input type="checkbox" class="location-filter" value="Italy">Italy</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">DA Range<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="da-filter" value="0-10">0 - 10</label>
                    <label><input type="checkbox" class="da-filter" value="11-20">11 - 20</label>
                    <label><input type="checkbox" class="da-filter" value="21-30">21 - 30</label>
                    <label><input type="checkbox" class="da-filter" value="31-40">31 - 40</label>
                    <label><input type="checkbox" class="da-filter" value="41-50">41 - 50</label>
                    <label><input type="checkbox" class="da-filter" value="51-60">51 - 60</label>
                    <label><input type="checkbox" class="da-filter" value="61-70">61 - 70</label>
                    <label><input type="checkbox" class="da-filter" value="71-80">71 - 80</label>
                    <label><input type="checkbox" class="da-filter" value="81-90">81 - 90</label>
                    <label><input type="checkbox" class="da-filter" value="91-100">91 - 100</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">DR Range<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="dr-filter" value="0-10">0 - 10</label>
                    <label><input type="checkbox" class="dr-filter" value="11-20">11 - 20</label>
                    <label><input type="checkbox" class="dr-filter" value="21-30">21 - 30</label>
                    <label><input type="checkbox" class="dr-filter" value="31-40">31 - 40</label>
                    <label><input type="checkbox" class="dr-filter" value="41-50">41 - 50</label>
                    <label><input type="checkbox" class="dr-filter" value="51-60">51 - 60</label>
                    <label><input type="checkbox" class="dr-filter" value="61-70">61 - 70</label>
                    <label><input type="checkbox" class="dr-filter" value="71-80">71 - 80</label>
                    <label><input type="checkbox" class="dr-filter" value="81-90">81 - 90</label>
                    <label><input type="checkbox" class="dr-filter" value="91-100">91 - 100</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Price Range<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="price-filter" value="0-50">$0 - $50</label>
                    <label><input type="checkbox" class="price-filter" value="50-100">$50 - $100</label>
                    <label><input type="checkbox" class="price-filter" value="100-250">$100 - $250</label>
                    <label><input type="checkbox" class="price-filter" value="250-500">$250 - $500</label>
                    <label><input type="checkbox" class="price-filter" value="500-1000">$500 - $1000</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Spam Score<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="spam-filter" value="0-10">0 - 10% (Low risk)</label>
                    <label><input type="checkbox" class="spam-filter" value="11-30">11% - 30% (Moderate Risk)</label>
                    <label><input type="checkbox" class="spam-filter" value="31-60">31% - 60% (High Risk)</label>
                    <label><input type="checkbox" class="spam-filter" value="61-100">61% - 100% (Very High Risk)</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Status<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="status-filter" value="Active">Active</label>
                    <label><input type="checkbox" class="status-filter" value="Inactive">Inactive</label>
                    <label><input type="checkbox" class="status-filter" value="Under">Under Review</label>
                    <label><input type="checkbox" class="status-filter" value="Blocked">Blocked</label>
                    <label><input type="checkbox" class="status-filter" value="Draft">Draft</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Added By<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="addedby-filter" value="Admin">Admin</label>
                    <label><input type="checkbox" class="addedby-filter" value="Team Member">Team Member</label>
                    <label><input type="checkbox" class="addedby-filter" value="External Conributor">External Conributor</label>
                    <label><input type="checkbox" class="addedby-filter" value="Blogger">Blogger</label>
                    <label><input type="checkbox" class="addedby-filter" value="CSV Upload">CSV Upload</label>
                </div>
            </div>
            <div class="filter-multiselect">
                <div class="select-box">Timeline<i class="fa-solid fa-caret-down"></i></div>
                <div class="options">
                    <label><input type="checkbox" class="timeline-filter" value="Today">Today</label>
                    <label><input type="checkbox" class="timeline-filter" value="Last 7 Days">Last 7 Days</label>
                    <label><input type="checkbox" class="timeline-filter" value="Last 30 Days">Last 30 Days</label>
                    <label><input type="checkbox" class="timeline-filter" value="This Year">This Year</label>
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
        <!-- Content Area -->
        <div class="content-area">
            <div class="site-count">
                <h4>Total Websites :</h4>
                <h2>48k</h2>
            </div>
            <div class="table-wrapper">
                <table class="sitelist">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Website URL</th>
                            <th>Currency</th>
                            <th>Price</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="siteTableBody">
                        <tr>
                            <td>Travel</td>
                            <td><a href="">Travel.com</a></td>
                            <td>USD</td>
                            <td>250</td>
                            <td>Finzip Co.</td>
                            <td>finzip@xyz.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>Finance</td>
                            <td><a href="">finvest.com</a></td>
                            <td>USD</td>
                            <td>200</td>
                            <td>Accevate Inc.</td>
                            <td>accevate@abc.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Technology</td>
                            <td><a href="">techie.com</a></td>
                            <td>USD</td>
                            <td>220</td>
                            <td>Steve Williams</td>
                            <td>steve@xyz.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Business and Market</td>
                            <td><a href="">dailyinvest.com</a></td>
                            <td>USD</td>
                            <td>300</td>
                            <td>Quirl Corp.</td>
                            <td>hans121@xyz.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Home and DIY</td>
                            <td><a href="">mynest.com</a></td>
                            <td>USD</td>
                            <td>220</td>
                            <td>Semrush Inc.</td>
                            <td>amanda@xyz.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>News and Politics</td>
                            <td><a href="">global.com</a></td>
                            <td>USD</td>
                            <td>280</td>
                            <td>ABC Media</td>
                            <td>contact@abcmedia.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Finance</td>
                            <td><a href="">fintest.com</a></td>
                            <td>USD</td>
                            <td>200</td>
                            <td>David</td>
                            <td>david_m@abc.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Technology</td>
                            <td><a href="">techie.com</a></td>
                            <td>USD</td>
                            <td>220</td>
                            <td>Steve</td>
                            <td>steve@xyz.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Business and Market</td>
                            <td><a href="">dailyinvest.com</a></td>
                            <td>USD</td>
                            <td>300</td>
                            <td>Hans</td>
                            <td>hans121@xyz.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Business and Market</td>
                            <td><a href="">dailyinvest.com</a></td>
                            <td>USD</td>
                            <td>300</td>
                            <td>Hans</td>
                            <td>hans121@xyz.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr>
                        <tr>
                            <td>Business and Market</td>
                            <td><a href="">dailyinvest.com</a></td>
                            <td>USD</td>
                            <td>300</td>
                            <td>Hans</td>
                            <td>hans121@xyz.com</td>
                            <td class="list-actions">
                                <i class="fa-solid fa-eye view-btn"></i>
                                <i class="fa-solid fa-pencil edit-btn"></i>
                            </td>
                        </tr> -->
                        <!-- Dynamic rows will be injected via js> -->
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <span class="prev"><i class="fa-solid fa-chevron-left"></i></span>
                <span class="page">1</span>
                <span class="next"><i class="fa-solid fa-chevron-right"></i></span>
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



    <!-- <div class="modal-dialog" id="modal-dialog-view">
        <div class="modal">
            <div class="modal-header">
                <h3>View Website</h3>
                <button class="close-btn" id="close-btn-view"><i class="fa-solid fa-circle-xmark"></i></button>
            </div>
            <hr>
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
            </div>
            <div class="modal-footer"></div>
        </div>
    </div> -->


    <!-- <div class="modal-dialog" id="modal-dialog-edit">
        <div class="modal">
            <div class="modal-header">
                <h3>Edit Website</h3>
                <button class="close-btn" id="close-btn-edit"><i class="fa-solid fa-circle-xmark"></i></button>
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
</body>

</html>