<?php
include 'includes/auth.php';
include 'includes/query.php';
session_start();
include 'includes/db.php';
include 'includes/cloudinary.php';
use Cloudinary\Api\Upload\UploadApi;

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
}

// Verify user exists in database
if (checkUserExists($pdo, $_SESSION['user_id']) == 0) {
    session_destroy();
    header("Location: login.php?error=invalid_user");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

// Fetch post
$post = getPostById($pdo, $id);

if (!$post) {
    header("Location: index.php");
    exit;
}

if ($post['user_id'] != $_SESSION['user_id'] && !$_SESSION['is_admin']) {
    header("Location: index.php");
    exit;
}

$modules = getAllModules($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $module_id = $_POST['module_id'];
    
    if (strlen($title) < 5 || strlen($content) < 10 || empty($module_id)) {
        $title = 'Edit Post';
        $output = '<p class="text-red-500">Title must be 5+ characters, content 10+ characters, and module is required</p>';
    } else {
        try {
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload = new UploadApi();
                $result = $upload->upload($_FILES['image']['tmp_name'], ['folder' => 'forum_db/posts', 'public_id' => time() . '_' . basename($_FILES['image']['name'])]);
                $image_path = $result['secure_url'];
            } else {
                $image_path = $post['image_path'];
            }
            updatePost($pdo, $title, $content, $image_path, $module_id, $id);
            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            $title = 'An error has occurred';
            $output = '<p class="text-red-500">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
            if ($e instanceof PDOException && $e->getCode() == 23000) {
                $output .= '<br>Possible cause: Invalid user or module ID.';
            }
        }
    }
} else {
    $title = 'Edit Post';
}

ob_start();
include 'templates/post_edit.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';
?>