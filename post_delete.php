<?php
include 'includes/auth.php';
include 'includes/query.php';
session_start();
include 'includes/db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$id = $_GET['id'];
try {
    $post = getPostUserId($pdo, $id);
    if ($post && ($_SESSION['is_admin'] || $post['user_id'] == $_SESSION['user_id'])) {
        deletePost($pdo, $id);
    } else {
        $title = 'Unauthorized';
        $output = '<p class="text-red-500">You can only delete your own posts unless you are an admin.</p>';
        include 'templates/layout.html.php';
        exit;
    }
    header("Location: index.php");
    exit;
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
    include 'templates/layout.html.php';
}
?>