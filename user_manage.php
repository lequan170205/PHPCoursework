<?php
include 'includes/auth.php';
include 'includes/query.php';
session_start();
include 'includes/db.php';
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) { header("Location: index.php"); exit; }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;
    if (strlen($username) < 3 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($_POST['password']) < 6) {
        $title = 'Manage Users';
        $output = '<p class="text-red-500">Invalid input</p>';
        $users = getAllUsers($pdo);
        ob_start();
        include 'templates/user_manage.html.php';
        $output .= ob_get_clean();
    } else {
        try {
            insertUserWithAdmin($pdo, $username, $email, $password, $is_admin);
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
            include 'templates/layout.html.php';
            exit;
        }
    }
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        deleteUser($pdo, $id, $_SESSION['user_id']);
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
        include 'templates/layout.html.php';
        exit;
    }
}
try {
    $users = getAllUsers($pdo);
    $title = 'Manage Users';
    ob_start();
    include 'templates/user_manage.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>