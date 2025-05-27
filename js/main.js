// Active Link Script 
document.addEventListener('DOMContentLoaded', function () {
    const currentPage = window.location.pathname.split('/').pop();
    const tabs = document.querySelectorAll('.nav-tabs a');

    tabs.forEach(tab => {
        if (tab.getAttribute('href') === currentPage) {
            tab.classList.add('active');
        }
    });
});

// Profile Dropdown Toggle
document.addEventListener('DOMContentLoaded', () => {
    const profileToggle = document.getElementById('profile-toggle');
    const profileDropdown = document.getElementById('profile-dropdown');
    // Toggle dropdown on click 
    profileToggle.addEventListener('click', (e) => {
        e.preventDefault(); // prevent form submission if inside a form 
        profileDropdown.classList.toggle('active');
        e.stopPropagation(); // prevent event from reaching document 
    });
    // Close dropdown if clicked outside 
    document.addEventListener('click', (e) => {
        if (!profileDropdown.contains(e.target) && e.target !== profileToggle) {
            profileDropdown.classList.remove('active');
        }
    });
});

// Logout Script
document.addEventListener('DOMContentLoaded', () => {
    const logoutBtn = document.getElementById('logout-link');
    const alertBox = document.getElementById('alert-box-logout');
    const logOutAlert = document.getElementById('custom-alert');
    const confirmLogout = document.getElementById('confirm-logout');
    const cancelLogout = document.getElementById('cancel-logout');

    logoutBtn.onclick = (e) => {
        e.preventDefault();
        logOutAlert.style.display = 'flex';
    };

    confirmLogout.onclick = () => {
        logOutAlert.style.display = 'none';
        window.location.href = 'logout.php';
    };

    cancelLogout.onclick = () => {
        logOutAlert.style.display = 'none';
    };

    document.addEventListener('click', (e) => {
        if (logOutAlert.style.display === 'flex') {
            if (!alertBox.contains(e.target) && !logoutBtn.contains(e.target)) {
                logOutAlert.style.display = 'none';
            }
        }
    });
});

