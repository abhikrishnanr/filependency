<?php
require 'includes/auth.php';
require 'config/db.php';
$type = $_GET['type'] ?? 'excel';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="summary.csv"');
$stmt = $pdo->query("SELECT department_id, COUNT(*) as total, SUM(status='Closed') as closed FROM file_status_updates GROUP BY department_id");
$fp = fopen('php://output', 'w');
fputcsv($fp, ['Department ID','Total','Closed']);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($fp, $row);
}
exit;
?>
