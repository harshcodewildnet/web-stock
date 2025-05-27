let currentPage = 1;
const pageSize = 10;


document.addEventListener('DOMContentLoaded', () => {
    const page = document.body.dataset.page;
    const applyButton = document.getElementById('apply');
    const clearButton = document.getElementById('clear');
    const pageNo = document.getElementById('page-no');
    const firstPageButton = document.getElementById('first-page-btn');
    const lastPageButton = document.getElementById('last-page-btn');
    const previousButton = document.getElementById('prev-btn');
    const nextButton = document.getElementById('next-btn');
    const tableBody = document.getElementById('siteTableBody');
    const modal = document.getElementById('modal-dialog-common');
    const websiteCount = document.getElementById('website-count');
    let currentWebsiteList = []; //used below in dblist.php
    let totalPages = 1;

    // Helper function to get all checked checkbox values for a given group
    function getCheckedValues(groupClass) {
        const checkboxes = document.querySelectorAll(`.${groupClass}:checked`);
        return Array.from(checkboxes).map(cb => cb.value);
    }

    // Create a filters object from all groups
    function getSelectedFilters() {
        const filters = {
            category: getCheckedValues('category-filter'),
            traffic: getCheckedValues('traffic-filter'),
            location: getCheckedValues('location-filter'),
            da: getCheckedValues('da-filter'),
            dr: getCheckedValues('dr-filter'),
            price: getCheckedValues('price-filter'),
            spam: getCheckedValues('spam-filter'),
            status: getCheckedValues('status-filter'),
            addedby: getCheckedValues('addedby-filter'),
            timeline: getCheckedValues('timeline-filter'),
            // Additional 'pageNo' filter for pagination
            pageNo: currentPage || '1',
        };

        // Force status = 1 for dblist.php
        // const page = document.body.dataset.page;
        if (page === 'dblist') {
            filters.status = ['1'];
        }

        // Include custom date range if "custom" is selected
        if (filters.timeline.includes('custom')) {
            const fromDate = document.querySelector('.custom-from-date')?.value;
            const toDate = document.querySelector('.custom-to-date')?.value;

            if (fromDate && toDate) {
                filters.custom_from = fromDate;
                filters.custom_to = toDate;
            }
        }

        return filters;
    }

    // Function to send filters to server and update table
    function applyFilters() {
        const filters = getSelectedFilters();

        fetch('api/filter-websites.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(filters)
        })
            .then(response => response.json())
            .then(data => {
                updateTable(data.websites);
                if (websiteCount) {
                    websiteCount.textContent = data.count;
                }
                totalPages = data.totalPages;
                pageNo.textContent = `Page ${currentPage}`;
                // console.log("Total pages :" + data.totalPages);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Event: Apply button clicked
    applyButton.addEventListener('click', () => {
        currentPage = 1;
        applyFilters();
    });

    // Event: Clear button clicked
    clearButton.addEventListener('click', () => {
        // Clear all checkboxes
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        // Clear the table
        // tableBody.innerHTML = '';
        currentPage = 1;
        applyFilters();
    });

    firstPageButton.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage = 1;
            applyFilters();
        }
    });

    previousButton.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            applyFilters();
        }
    });

    nextButton.addEventListener('click', function () {
        if (currentPage < totalPages) {
            currentPage++;
            applyFilters();
        }
    });

    lastPageButton.addEventListener('click', function () {
        if (currentPage < totalPages) {
            currentPage = totalPages;
            applyFilters();
        }
    });

    // Optional: Fetch all data initially
    applyFilters();

    // Attaching Event Listener to tableBody for dynamic data (view, edit, toggle)
    tableBody.addEventListener('click', async (e) => {
        const target = e.target;

        // View button
        if (target.classList.contains('view-btn')) {
            const data = JSON.parse(target.dataset.site);
            openModal('view', data);
            return;
        }

        // Edit button
        if (target.classList.contains('edit-btn')) {
            const data = JSON.parse(target.dataset.site);
            openModal('edit', data);
            return;
        }

        // Delete button
        if (target.classList.contains('delete-btn')) {
            const siteId = target.dataset.siteId;
            const confirmDelete = confirm('Are you sure you want to delete this entry : ID : ' + siteId);
            if (!confirmDelete) return;

            try {
                const response = await fetch('api/delete-website.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: siteId })
                });

                const result = await response.json();

                if (response.ok && result.status === 'success') {
                    const row = target.closest('tr');
                    row.remove();
                    alert(result.message);

                    const rows = tableBody.querySelectorAll('tr');
                    if (rows.length === 0) {
                        tableBody.innerHTML = '<tr id="empty-row"><td colspan="12">No websites found.</td></tr>';
                    } else {
                        rows.forEach((tr, index) => {
                            const snCell = tr.querySelector('td.short'); //first td.short is S.No. 
                            if (snCell) snCell.textContent = index + 1;
                        });
                    }
                    websiteCount.textContent = rows.length;

                } else {
                    alert(result.message || 'Failed to delete website');
                }
            }
            catch (error) {
                console.log('Delete Error : ' + error);
                alert('Server or network error. Please try again later');
            }

        }

        // Toggle switch click (for label or span click fallback)
        if (target.classList.contains('slider') || target.classList.contains('switch')) {
            // Do nothing
            return;
        }

        // Toggle input
        if (target.classList.contains('toggle-status')) {
            const toggle = target;
            const siteId = toggle.dataset.id;
            const newStatus = toggle.checked ? 'approved' : 'pending';

            try {
                const response = await fetch('api/update-status.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: siteId, status: newStatus })
                });

                const result = await response.json();

                if (response.ok && result.status === 'success') {
                    const row = toggle.closest('tr');
                    row.querySelector('.status-text').textContent = newStatus;
                    // alert(result.message);
                } else {
                    const errorMsg = result.message || 'Failed to update status.';
                    alert(errorMsg);
                    toggle.checked = !toggle.checked; // revert toggle
                }
            } catch (error) {
                console.error('Status update error:', error);
                alert('Network or server error. Please try again later.');
                toggle.checked = !toggle.checked; // revert toggle
            }

        }
    });


    function openModal(mode, data) {

        // const modal = document.getElementById('modal-dialog-common');

        const fields = [
            'id', 'category', 'status', 'currency', 'price', 'client-name',
            'blogger-name', 'blogger-email', 'blogger-mobile',
            'spam-score', 'dr', 'traffic', 'da', 'url', 'live-url',
            'location', 'mode', 'added-by'
        ];

        fields.forEach(key => {
            const input = document.getElementById(`modal-${key}`);
            if (input) input.value = data[key.replace(/-/g, '_')] || '';
        });

        const isView = mode === 'view';
        fields.forEach(key => {
            const input = document.getElementById(`modal-${key}`);
            if (input) input.disabled = isView;
        });

        document.getElementById('modal-title').textContent = isView ? 'View Website' : 'Edit Website';
        document.getElementById('modal-save-btn').style.display = isView ? 'none' : 'inline-block';

        // document.getElementById('modal-dialog-common').classList.add('show');
        modal.classList.add('show');
    }

    // Close modal
    document.getElementById('close-btn').addEventListener('click', () => {
        // document.getElementById('modal-dialog-common').classList.remove('show');
        modal.classList.remove('show');
    });

    window.addEventListener('click', (e) => {
        if (modal === e.target) modal.classList.remove('show');
    })


});

// Update the website table with new rows
function updateTable(websites) {

    currentWebsiteList = websites;
    const tableBody = document.getElementById('siteTableBody');
    const page = document.body.dataset.page;
    const startingIndex = (currentPage - 1) * pageSize;
    // console.log("Page : " + page);

    if (!websites || websites.length === 0) {
        tableBody.innerHTML = '<tr id="empty-row"><td colspan="12">No websites found.</td></tr>';
        return;
    }

    const rows = websites.map((site, index) => {
        if (page === 'quality-checklist') {
            return `
                <tr data-site-id="${site.id}">
                    <td class="short">${startingIndex + index + 1}</td>
                    <td class="short"><a href="${site.url}" target="_blank">${site.url}</a></td>
                    <td class="short">${site.currency} ${site.price}</td>
                    <td>${site.client_name}</td>
                    <td class="short">${site.da}</td>
                    <td class="short">${site.dr}</td>
                    <td class="short">${site.spam_score}</td>
                    <td>${site.live_link}</td>
                    <td class="short">${site.added_by}</td>
                    <td class="status-text">${site.status === 1 ? 'approved' : 'pending'}</td>
                    <td class="short">
                        <label class="switch">
                            <input type="checkbox" class="toggle-status" data-id="${site.id}" ${site.status === 1 ? 'checked' : ''}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td class="list-actions">
                        <i class="fa-solid fa-eye view-btn" data-site='${JSON.stringify(site)}'></i>
                        <i class="fa-solid fa-pencil edit-btn" data-site='${JSON.stringify(site)}'></i>
                        <i class="fa-solid fa-trash delete-btn" data-site-id='${site.id}'></i>
                    </td>
                </tr>
            `;
        } else {
            return `
                <tr>
                    <td>${startingIndex + index + 1}</td>
                    <td><a href="${site.url}" target="_blank">${site.url}</a></td>
                    <td>${site.currency} ${site.price}</td>
                    <td>${site.client_name}</td>
                    <td>${site.da}</td>
                    <td>${site.dr}</td>
                    <td>${site.spam_score}</td>
                    <td>${site.live_link}</td>
                    <td>${site.added_by}</td>
                    <td class="list-actions">
                        <i class="fa-solid fa-eye view-btn" data-site='${JSON.stringify(site)}'></i>
                        <i class="fa-solid fa-pencil edit-btn" data-site='${JSON.stringify(site)}'></i>
                    </td>
                </tr>
            `;
        }
    }).join('');

    tableBody.innerHTML = rows;
}

// function updatePagination() {
//     pageNo.textContent = `Page ${currentPage}`;
// }

