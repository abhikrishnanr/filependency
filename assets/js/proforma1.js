$(function() {
    // Example: fetch department list, then files for department
    $.getJSON('api/fetch_master_data.php?url=https://fileadalath.kerala.gov.in/api/department', function(departments) {
        // Populate department dropdown, then fetch files etc.
    });

    // For inline status update (AJAX)
    $(document).on('change', '.status-select', function() {
        var row = $(this).closest('tr');
        var fileId = row.data('file-id');
        var status = $(this).val();
        $.post('update_status.php', {file_id: fileId, status: status}, function(res) {
            if (res.success) {
                // Show toast/success
            }
        }, 'json');
    });
});