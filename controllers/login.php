<?php
require_once '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'User.php';
require_once '..' . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'JsonUserRepository.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    
    // initialize JsonUserRepository
    $repository = new JsonUserRepository('..'. DIRECTORY_SEPARATOR .'users.json');
    
    // get user with matching login
    $user = $repository->read($login);
    
    if ($user !== null && $user->verifyPassword($password)) {
        // authentication successful, redirect to the home page
        session_start();
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $login;
        $response = array('redirect' => 'home.php');
        echo json_encode($response);
        exit;
    } else {
        // authentication failed, display an error message
        http_response_code(401); // unauthorized
        echo 'Invalid username or password';
        exit;
    }
} else {
    http_response_code(403);
}
?>