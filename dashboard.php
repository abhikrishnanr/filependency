<?php require 'includes/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - File Adalath</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php /* include 'includes/header.php'; */ ?>
<div class="container mt-4">
    <h2>Welcome, <?= htmlspecialchars($user['name']) ?></h2>
    <div class="row">
        <!-- Dynamic cards based on user role -->
        <?php if ($user['role'] == 'superadmin'): ?>
            <!-- Fetch and display all departments summary here -->
        <?php elseif ($user['role'] == 'deptadmin'): ?>
            <!-- Section/seat-wise progress for department -->
        <?php elseif ($user['role'] == 'sectionofficer'): ?>
            <!-- Show only assigned section/seat files -->
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</body>
</html>