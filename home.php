<?php
session_start();
setcookie('PHPSESSID', session_id(), time() + 3600, '/');

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit;
}
$username = $_SESSION['username'];
include('modules'. DIRECTORY_SEPARATOR .'home_content.php');
?>  