$(function () {
    // Fetch summary per department for super admin
    $.getJSON('api/fetch_master_data.php?url=https://fileadalath.kerala.gov.in/api/department', function (departments) {
        var cards = '';
        departments.slice(0, 5).forEach(function (dept) { // limit to few for demo
            cards += `<div class="col-md-4"><div class="card mb-3"><div class="card-body">
                <h5 class="card-title">${dept.department_name}</h5>
                <p class="card-text">Total Files: ...</p>
                <div class="progress"><div class="progress-bar" style="width:50%">50%</div></div>
            </div></div></div>`;
        });
        $('#summaryCards').html(cards);
    });
});
