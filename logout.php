<?php
session_start();
setcookie('user_id', '', time() - 3600, '/');
session_destroy();
header("Location: login.php");
exit;
?>