<?php
header('Content-Type: application/json');
$url = $_GET['url'] ?? '';
if (!$url || !preg_match('/^https:\/\/fileadalath\.kerala\.gov\.in\/api\//', $url)) {
    echo json_encode(['error' => 'Invalid URL']);
    exit;
}
echo file_get_contents($url);
?>