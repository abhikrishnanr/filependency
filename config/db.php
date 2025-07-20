<?php
$host = 'host.webtestingonline.com:3306';
$db   = 'webtestin_filependency';
$user = 'webtestin_filependencyu';
$pass = 'Jz5PD!rfi7SY';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
