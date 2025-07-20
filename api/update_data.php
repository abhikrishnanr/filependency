<?php
require '../includes/auth.php';
header('Content-Type: application/json');
$type = $_POST['type'] ?? '';
$endpoints = [
    'departments' => 'https://fileadalath.kerala.gov.in/api/department',
    'categories'  => 'https://fileadalath.kerala.gov.in/api/department-category',
    'files'       => 'https://fileadalath.kerala.gov.in/api/department-files'
];
if(!isset($endpoints[$type])) {
    echo json_encode(['success'=>false,'error'=>'Invalid type']);
    exit;
}
$target = __DIR__.'/../data/'.$type.'.json';
$logFile = __DIR__.'/../data/update_log.json';
$data = @file_get_contents($endpoints[$type]);
if($data===false){
    echo json_encode(['success'=>false,'error'=>'Fetch failed']);
    exit;
}
file_put_contents($target,$data);
$log = file_exists($logFile) ? json_decode(file_get_contents($logFile),true) : [];
$time = date('Y-m-d H:i:s');
$log[$type]=$time;
file_put_contents($logFile,json_encode($log));
echo json_encode(['success'=>true,'time'=>$time]);

