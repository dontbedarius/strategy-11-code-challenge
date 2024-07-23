// JS For Admin 
document.addEventListener('DOMContentLoaded', function() {
    const refreshButton = document.getElementById('refresh-data-button');
    const apiResponseDiv = document.getElementById('api-response');

    refreshButton.addEventListener('click', function() {
        // Perform AJAX request to fetch data
        fetch(directoryPlugin.ajax_url + '?action=refresh_data')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display the HTML formatted data
                    apiResponseDiv.innerHTML = data.data.html;
                } else {
                    // Handle errors
                    apiResponseDiv.innerHTML = '<p>An error occurred: ' + data.data.message + '</p>';
                }
            })
            .catch(error => {
                apiResponseDiv.innerHTML = '<p>An error occurred: ' + error.message + '</p>';
            });
    });
});