document.addEventListener('DOMContentLoaded', () => {

    // Search User Script 
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

        fetch('api/search-users.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query })
        })
            .then(res => res.json())
            .then(data => {
                updateTable(data.users);
                document.getElementById('users-count').textContent = data.count;
            })
            .catch(err => {
                console.error('Search error:', err);
                alert('Failed to fetch search results.');
            });
    }
});


// Update the user table with new rows
function updateTable(users) {
    const tableBody = document.getElementById('siteTableBody')
    if (!users || users.length === 0) {
        tableBody.innerHTML = '<tr id="empty-row"><td colspan="10">No users found.</td></tr>';
        return;
    }

    const rows = users.map((user, index) => `
            <tr>
        <td>${index + 1}</td>
        <td>${user.user_id}</td>
        <td>${user.name}</td>
        <td>${user.email}</td>
        <td>${user.role}</td>
        <td>${user.status == 1 ? 'Active' : 'Inactive'}</td>
        <td>
            <a class="edit-user-btn" href="edit-user.php?id=${user.user_id}"><i
                class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <a class="delete-user-btn" href="#"
                onclick="deleteUser(event, ${user.user_id})"><i
                    class="fa-solid fa-trash"></i></a>
        </td>
    </tr>
        `).join('');

    tableBody.innerHTML = rows;

}

function deleteUser(e, id) {

    const deleteAlert = document.getElementById('custom-alert-delete');
    const alertBox = document.getElementById('alert-box-delete');
    const deleteMsg = document.getElementById('delete-alert-msg');
    const confirmDelete = document.getElementById('confirm-delete');
    const cancelDelete = document.getElementById('cancel-delete');
    deleteMsg.innerHTML = 'Are you sure you want to delete user with id :' + id;
    deleteAlert.style.display = 'flex';

    confirmDelete.onclick = () => {
        deleteAlert.style.display = 'none';
        window.location.href = 'api/delete-user.php?id=' + id;
    };

    cancelDelete.onclick = () => {
        deleteAlert.style.display = 'none';
    }
}