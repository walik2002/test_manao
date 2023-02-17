<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: index.php');
    exit;
}
$username = $_SESSION['username'];
include('modules'. DIRECTORY_SEPARATOR .'home_content.php');
?>  