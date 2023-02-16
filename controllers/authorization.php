<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        echo 'hello';
    }
?>