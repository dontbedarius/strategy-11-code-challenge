// JS For Admin 
document.addEventListener('DOMContentLoaded', function() {
    const refreshButtonPublic = document.getElementById('public-refresh-data-button');
    const tableContainer = document.getElementById('directory-plugin-table');

    refreshButtonPublic.addEventListener('click', function() {
        fetch(directoryPlugin.ajax_url + '?action=refresh_data')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Assuming data.html contains the formatted table HTML
                    tableContainer.innerHTML = data.data.html;
                } else {
                    tableContainer.innerHTML = 'Failed to load data.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                tableContainer.innerHTML = 'An error occurred.';
            });
    });
});