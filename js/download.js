document.getElementById('download-list-link').addEventListener('click', () => {
    if (!currentWebsiteList.length) {
        alert('No data to download.');
        return;
    }

    const headers = [
        "Category", "URL", "Currency", "Price", "Client Name", "Blogger Name",
        "Blogger Email", "Blogger Mobile", "Spam Score", "DR", "Traffic", "DA",
        "Location", "Mode", "Added By", "Status", "Approved"
    ];

    const rows = currentWebsiteList.map(site => [
        site.category || '',
        site.url || '',
        site.currency || '',
        site.price || '',
        site.client_name || '',
        site.blogger_name || '',
        site.blogger_email || '',
        site.blogger_mobile || '',
        site.spam_score || '',
        site.dr || '',
        site.traffic || '',
        site.da || '',
        site.location || '',
        site.mode || '',
        site.added_by || '',
        site.status === 1 ? 'approved' : 'pending',
        site.status === 1 ? 'Yes' : 'No'
    ]);

    const csvContent = [headers, ...rows].map(row =>
        row.map(field => `"${String(field).replace(/"/g, '""')}"`).join(',')
    ).join('\n');

    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'sitelist.csv';
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
