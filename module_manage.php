<?php
include 'includes/auth.php';
include 'includes/query.php';
session_start();
include 'includes/db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_module']) && $_SESSION['is_admin']) {
    $module_name = $_POST['module_name'];
    if (strlen($module_name) < 3) {
        $title = 'Manage Modules';
        $output = '<p class="text-red-500">Module name must be 3+ characters</p>';
        $modules = getAllModules($pdo);
        ob_start();
        include 'templates/module_manage.html.php';
        $output .= ob_get_clean();
    } else {
        try {
            insertModule($pdo, $module_name);
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
            include 'templates/layout.html.php';
            exit;
        }
    }
}
if (isset($_GET['delete']) && $_SESSION['is_admin']) {
    $id = $_GET['delete'];
    try {
        deleteModule($pdo, $id);
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
        include 'templates/layout.html.php';
        exit;
    }
}
try {
    $modules = getAllModules($pdo);
    $title = 'Manage Modules';
    ob_start();
    include 'templates/module_manage.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>