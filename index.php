<?php
session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    header('Location: home.php');
    exit;
}
include('modules'. DIRECTORY_SEPARATOR .'index_content.php');

?>