<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$user = $_SESSION['user'];
// Legacy sessions may store the username as a string. Normalize to an array.
if (!is_array($user)) {
    $user = ['name' => (string)$user];
    $_SESSION['user'] = $user;
}
?>