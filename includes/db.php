<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=studentq_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
    include 'templates/layout.html.php';
    exit;
}
?>