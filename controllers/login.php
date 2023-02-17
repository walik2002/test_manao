<?php
require_once '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'User.php';
require_once '..' . DIRECTORY_SEPARATOR . 'repositories' . DIRECTORY_SEPARATOR . 'JsonUserRepository.php';
require_once 'check_ajax_request.php';

if (!validate_request()) {
    http_response_code(403);
    exit;
}

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
    setcookie('PHPSESSID', session_id(), time() + 3600, '/');
    $response = array('redirect' => 'home.php');
    echo json_encode($response);
    exit;
}else {
    // authentication failed, display an error message
    http_response_code(400); // unauthorized
    echo 'Invalid login or password!';
    exit;
}
?>