<?php
require 'includes/auth.php';
require 'config/db.php';

$stats = $pdo->query("SELECT 
    COUNT(*) as total,
    SUM(status='Closed') as closed,
    SUM(status='Pending') as pending,
    COUNT(DISTINCT department_id) as departments,
    COUNT(DISTINCT section_id) as sections
 FROM file_status_updates")->fetch(PDO::FETCH_ASSOC);

$logFile = __DIR__.'/data/update_log.json';
$log = file_exists($logFile) ? json_decode(file_get_contents($logFile), true) : [];
function last_time($key, $arr) { return $arr[$key] ?? 'Never'; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - File Adalath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Welcome, <?= htmlspecialchars($user['name']) ?></h2>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary me-2 api-update-btn" data-type="departments">Update Departments</button>
        <button class="btn btn-primary me-2 api-update-btn" data-type="categories">Update Categories</button>
        <button class="btn btn-primary api-update-btn" data-type="files">Update Files</button>
    </div>
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="card text-center"><div class="card-body"><h6>Total Updates</h6><p class="display-6"><?= $stats['total'] ?? 0 ?></p></div></div>
        </div>
        <div class="col-md-2">
            <div class="card text-center"><div class="card-body"><h6>Closed</h6><p class="display-6"><?= $stats['closed'] ?? 0 ?></p></div></div>
        </div>
        <div class="col-md-2">
            <div class="card text-center"><div class="card-body"><h6>Pending</h6><p class="display-6"><?= $stats['pending'] ?? 0 ?></p></div></div>
        </div>
        <div class="col-md-3">
            <div class="card text-center"><div class="card-body"><h6>Departments</h6><p class="display-6"><?= $stats['departments'] ?? 0 ?></p></div></div>
        </div>
        <div class="col-md-3">
            <div class="card text-center"><div class="card-body"><h6>Sections</h6><p class="display-6"><?= $stats['sections'] ?? 0 ?></p></div></div>
        </div>
    </div>
    <div class="row" id="apiCards">
        <?php foreach(['departments','categories','files'] as $t): ?>
        <div class="col-md-4">
            <div class="card mb-3 text-center">
                <div class="card-body">
                    <h5 class="card-title text-capitalize"><?= $t ?></h5>
                    <button class="btn btn-sm btn-outline-primary api-update-btn" data-type="<?= $t ?>">Update</button>
                    <p class="mt-2 mb-0"><small class="text-muted">Last updated: <span class="last-updated"><?= htmlspecialchars(last_time($t,$log)) ?></span></small></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
$(function(){
    $('.api-update-btn').click(function(){
        var type = $(this).data('type');
        var btn = $(this);
        btn.prop('disabled', true).text('Updating...');
        $.post('api/update_data.php', {type:type}, function(res){
            if(res.success){
                btn.closest('.card, .d-flex').find('.last-updated').text(res.time);
            }else{
                alert('Update failed');
            }
        }, 'json').always(function(){
            btn.prop('disabled', false).text('Update '+type.charAt(0).toUpperCase()+type.slice(1));
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
