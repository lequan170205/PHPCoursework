<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_COOKIE['user_id'])) {
    header("Location: logout.php");
    exit;
}

if ($_COOKIE['user_id'] != $_SESSION['user_id']) {
    header("Location: logout.php");
    exit;
}
?>