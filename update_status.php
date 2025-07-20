<?php
require 'includes/auth.php';
require 'config/db.php';

$file_id = $_POST['file_id'] ?? '';
$status = $_POST['status'] ?? '';
$user_id = $user['id'];
// Check lock/year/category/status rules before allowing update...

if ($file_id && in_array($status, ['Pending', 'Closed'])) {
    // Check last status update timestamp for audit/lock logic
    // Insert or update file_status_updates table
    $stmt = $pdo->prepare("INSERT INTO file_status_updates (file_id, department_id, section_id, seat_id, year, category_id, status, updated_by, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE status=VALUES(status), updated_by=VALUES(updated_by), updated_at=NOW()");
    $stmt->execute([
        $file_id,
        $user['department_id'],
        $user['section_id'],
        $_POST['seat_id'] ?? null,
        $_POST['year'] ?? null,
        $_POST['category_id'] ?? null,
        $status,
        $user_id
    ]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>