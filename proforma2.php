<?php require 'includes/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PROFORMA 2 - Summary Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php /* include 'includes/header.php'; */ ?>
<div class="container mt-4">
    <h3>Report Summary (PROFORMA 2)</h3>
    <div id="summaryCards" class="row"></div>
    <div id="summaryTable"></div>
    <button class="btn btn-success" onclick="window.location='export.php?type=excel'">Export to Excel</button>
    <button class="btn btn-danger" onclick="window.location='export.php?type=pdf'">Export to PDF</button>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="assets/js/proforma2.js"></script>
</body>
</html>