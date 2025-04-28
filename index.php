<?php
include 'includes/auth.php';
include 'includes/query.php';
session_start();
include 'includes/db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
try {
    $posts = getAllPosts($pdo);
    ob_start();
    include 'templates/index.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>