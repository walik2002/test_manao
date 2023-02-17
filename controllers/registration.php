<?php
require_once '..'. DIRECTORY_SEPARATOR .'repositories'. DIRECTORY_SEPARATOR .'JsonUserRepository.php';
require_once '..'. DIRECTORY_SEPARATOR .'models'. DIRECTORY_SEPARATOR .'User.php';
require_once 'check_ajax_request.php';

if (!validate_request()) {
    http_response_code(403);
    exit;
}

$login = $_POST["login"];
$password = $_POST["password"];
$confirm_password = $_POST['confirm_password'];
$email = $_POST["email"];
$name = $_POST["name"];

try {
    $errors = validate_user_data($login, $password, $confirm_password, $email, $name);

    if (!empty($errors)) {
        // Return error messages as a JSON object
        http_response_code(406);
        echo json_encode($errors);
        exit;
    } else {
        $salt = bin2hex(random_bytes(16));
        $encryptedPassword = $salt . sha1($password . $salt);
        $userRepository = new JsonUserRepository("..". DIRECTORY_SEPARATOR ."users.json");
        $user = new User($login, $encryptedPassword, $email, $name);
        $created = $userRepository->create($user);

        if (!$created) {
            // User with the same email or login already exists
            // You can return an error message or redirect to a page
            // with an error message
            http_response_code(400);
            die("User with the same email or login already exists.");
        } else {
            // Return success message as a JSON object
            echo '<h3 id = "success-message"> Registration successful! Please authorize!</h3>';
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array('error' => $e->getMessage()));
}
  

function validate_user_data($login, $password, $confirm_password, $email, $name) {
    $errors = array();

    // Validate the login field
    if (strlen($login) < 6) {
        $errors['login'] = 'Minimum 6 characters';
    } elseif (preg_match('/\s/', $login)) {
        $errors['login'] = 'Spaces are not allowed';
    }

    // Validate the password field
    if (strlen($password) < 6) {
        $errors['password'] = 'Minimum 6 characters';
    } elseif (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/', $password)) {
        $errors['password'] = 'Password must contain at least one letter and one number';
    } elseif (preg_match('/\s/', $password)) {
        $errors['password'] = 'Spaces are not allowed';
    }

    // Validate the confirm password field
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    // Validate the email field
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email address';
    }

    // Validate the name field
    if (strlen($name) < 2 || !ctype_alpha($name)) {
        $errors['name'] = 'Minimum 2 characters, english letters only';
    } elseif (preg_match('/\s/', $name)) {
        $errors['name'] = 'Spaces are not allowed';
    }

    return $errors;
}
?>