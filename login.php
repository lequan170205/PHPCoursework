<?php
include 'includes/query.php';
session_start();
include 'includes/db.php';

if (!isset($_COOKIE['user_id']) && isset($_SESSION['user_id'])) {
    header("Location: logout.php");
    exit;
}

if (isset($_SESSION['user_id'])) { 
    header("Location: index.php"); 
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $title = 'Login';
        $output = '<p class="text-red-500">Invalid email format</p>';
        ob_start();
        include 'templates/login.html.php';
        $output .= ob_get_clean();
    } else {
        try {
            $user = getUserByEmail($pdo, $email);
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $_SESSION['avatar'] = $user['avatar'];
                $_SESSION['username'] = $user['username'];
                
                $cookie_expiry = time() + 3600;
                setcookie('user_id', $user['user_id'], [
                    'expires' => $cookie_expiry,
                    'path' => '/',
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'Strict'
                ]);
                header("Location: index.php");
                exit;
            } else {
                $title = 'Login';
                $output = '<p class="text-red-500">Invalid email or password</p>';
                ob_start();
                include 'templates/login.html.php';
                $output .= ob_get_clean();
            }
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
        }
    }
} else {
    $title = 'Login';
    ob_start();
    include 'templates/login.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>