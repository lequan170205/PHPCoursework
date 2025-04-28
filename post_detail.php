<?php
include 'includes/auth.php';
include 'includes/query.php';
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    $post = getPostDetails($pdo, $post_id);
    
    if ($post) {
        ob_start();
        include 'templates/post_detail.html.php';
        $output = ob_get_clean();
    } else {
        $title = 'Post Not Found';
        $output = '<div class="text-white text-center py-12">The requested post does not exist.</div>';
    }
} catch (PDOException $e) {
    $title = 'An Error Has Occurred';
    $output = '<div class="text-white text-center py-12">Database error: ' . htmlspecialchars($e->getMessage()) . '</div>';
}

include 'templates/layout.html.php';
?>