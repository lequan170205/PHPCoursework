<?php
include 'includes/query.php';
try {
    $pdo = new PDO("mysql:host=localhost", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS forum_db");
    $pdo->exec("USE forum_db");
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            avatar VARCHAR(255),
            password VARCHAR(255) NOT NULL,
            is_admin TINYINT(1) DEFAULT 0
        );
        CREATE TABLE IF NOT EXISTS modules (
            module_id INT AUTO_INCREMENT PRIMARY KEY,
            module_name VARCHAR(100) NOT NULL UNIQUE
        );
        CREATE TABLE IF NOT EXISTS posts (
            post_id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            image_path VARCHAR(255),
            user_id INT NOT NULL,
            module_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
            FOREIGN KEY (module_id) REFERENCES modules(module_id) ON DELETE CASCADE
        );
    ");
    if (checkAdminExists($pdo, 'admin@example.com') == 0) {
        $admin_password = 'admin123';
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
        insertAdmin($pdo, 'admin', 'admin@example.com', 'https://sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png', $hashed_password);
        echo "Admin user created with password: $admin_password<br>";
        echo "Hashed password stored: $hashed_password<br>";
    } else {
        echo "Admin user already exists.<br>";
    }
    if (checkModulesExist($pdo) == 0) {
        $modules = [
            'Introduction to Programming', 'Database Systems', 'Web Development',
            'Data Structures and Algorithms', 'Operating Systems', 'Software Engineering',
            'Computer Networks', 'Artificial Intelligence', 'Cybersecurity Basics',
            'Mobile App Development'
        ];
        foreach ($modules as $module) {
            insertModule($pdo, $module);
        }
        echo "10 random modules inserted.<br>";
    } else {
        echo "Modules already exist.<br>";
    }
    echo "Database setup completed successfully!";
} catch (PDOException $e) {
    echo "Setup failed: " . $e->getMessage();
}
?>