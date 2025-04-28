<?php
include 'includes/db.php';
include 'includes/query.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (strlen($username) < 3 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        $title = 'Sign Up';
        $output = '<p class="text-red-500">Username must be 3+ characters, email must be valid, and password must be 6+ characters</p>';
        ob_start();
        include 'templates/signup.html.php';
        $output .= ob_get_clean();
    }
    else {
        try {
            if (checkEmailAlreadyExists($pdo, $email)) {
                $title = 'Sign Up';
                $output = '<p class="text-red-500">Email is already registered. Please use a different email.</p>';
                ob_start();
                include 'templates/signup.html.php';
                $output .= ob_get_clean();
            } else {
                $avatar = "https://sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png";
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                insertUser($pdo, $username, $email, $avatar, $password_hash);
                header("Location: login.php");
                exit;
            }
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
        }
    }
} else {
    $title = 'Sign Up';
    ob_start();
    include 'templates/signup.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>