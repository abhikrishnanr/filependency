<?php
header('Content-Type: application/json');
$url = $_GET['url'] ?? '';
if (!$url || !preg_match('/^https:\/\/fileadalath\.kerala\.gov\.in\/api\//', $url)) {
    echo json_encode(['error' => 'Invalid URL']);
    exit;
}
// Use cURL so the request has a user agent and better error handling
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT => 'Filependency/1.0',
    CURLOPT_FOLLOWLOCATION => true,
]);
$data = curl_exec($ch);
if ($data === false) {
    echo json_encode(['error' => curl_error($ch)]);
    curl_close($ch);
    exit;
}
curl_close($ch);
echo $data;
?>