$(function () {
    // populate department list
    $.getJSON('api/fetch_master_data.php?url=https://fileadalath.kerala.gov.in/api/department?office_typeId=1', function (departments) {
        var select = $('<select class="form-select mb-3" id="deptSelect"></select>');
        select.append('<option value="">Select Department</option>');
        $.each(departments, function (_, d) {
            select.append(`<option value="${d.department_id}">${d.department_name}</option>`);
        });
        $('#fileTableContainer').before(select);
    });

    // when department selected load files
    $(document).on('change', '#deptSelect', function () {
        var deptId = $(this).val();
        if (!deptId) return;
        $('#fileTableContainer').html('<div class="text-center">Loading...</div>');
        $.getJSON(`api/fetch_master_data.php?url=https://fileadhalath.kerala.gov.in/api/department-files/${deptId}`, function (files) {
            var rows = '';
            files.forEach(function (file, idx) {
                rows += `<tr data-file-id="${file.id}">
                    <td>${idx + 1}</td>
                    <td>${file.section_name || ''}</td>
                    <td>${file.year}</td>
                    <td>${file.file_no} - ${file.subject}</td>
                    <td><select class="form-select category-select" data-file-id="${file.id}"></select></td>
                    <td><select class="form-select status-select"><option>Pending</option><option>Closed</option></select></td>
                </tr>`;
            });
            var table = `<table class="table table-bordered">
                <thead><tr><th>Sl.No</th><th>Section</th><th>Year</th><th>File & Subject</th><th>Category</th><th>Status</th></tr></thead>
                <tbody>${rows}</tbody></table>`;
            $('#fileTableContainer').html(table);
            loadCategories();
        });
    });

    function loadCategories() {
        $.getJSON('api/fetch_master_data.php?url=https://fileadhalath.kerala.gov.in/api/department-category', function (cats) {
            $('.category-select').each(function () {
                var sel = $(this);
                cats.forEach(function (c) {
                    sel.append(`<option value="${c.id}">${c.category_name}</option>`);
                });
            });
        });
    }

    // update status ajax
    $(document).on('change', '.status-select', function () {
        var row = $(this).closest('tr');
        var fileId = row.data('file-id');
        var status = $(this).val();
        $.post('update_status.php', {file_id: fileId, status: status}, function (res) {
            if (res.success) {
                row.addClass('table-success');
            }
        }, 'json');
    });
});
