<?php
include 'includes/auth.php';
include 'includes/query.php';
session_start();
include 'includes/db.php';
include 'includes/cloudinary.php';
use Cloudinary\Api\Upload\UploadApi;
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
// Verify user exists in database
if (checkUserExists($pdo, $_SESSION['user_id']) == 0) {
    session_destroy();
    header("Location: login.php?error=invalid_user");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $module_id = $_POST['module_id'];
    $image_path = null;

    $image_valid = isset($_FILES['image']) && $_FILES['image']['error'] == 0;

    if (strlen($title) < 5 || strlen($content) < 10 || empty($module_id) || !$image_valid) {
        $title = 'Add Post';
        $output = '<p class="text-red-500">Title must be 5+ characters, content 10+ characters, image, and module is required</p>';
        $modules = getAllModules($pdo);
        ob_start();
        include 'templates/post_add.html.php';
        $output .= ob_get_clean();
    } else {
        try {
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $upload = new UploadApi();
                $result = $upload->upload($_FILES['image']['tmp_name'], ['folder' => 'forum_db/posts', 'public_id' => time() . '_' . basename($_FILES['image']['name'])]);
                $image_path = $result['secure_url'];
            }
            insertPost($pdo, $title, $content, $image_path, $_SESSION['user_id'], $module_id);
            header("Location: index.php");
            exit;
        } catch (Exception $e) {
            $title = 'An error has occurred';
            $output = 'Error: ' . $e->getMessage();
            if ($e instanceof PDOException && $e->getCode() == 23000) {
                $output .= '<br>Possible cause: Invalid user or module ID.';
            }
        }
    }
} else {
    $title = 'Add Post';
    $modules = getAllModules($pdo);
    ob_start();
    include 'templates/post_add.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';
?>