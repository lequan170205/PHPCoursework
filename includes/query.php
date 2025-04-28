<?php
function getPostUserId($pdo, $post_id) {
    $stmt = $pdo->prepare("SELECT user_id FROM posts WHERE post_id = ?");
    $stmt->execute([$post_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deletePost($pdo, $post_id) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE post_id = ?");
    $stmt->execute([$post_id]);
}

function insertUser($pdo, $username, $email, $avatar, $password_hash) {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, avatar, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $avatar, $password_hash]);
}

function checkAdminExists($pdo, $email) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn();
}

function insertAdmin($pdo, $username, $email, $avatar, $hashed_password) {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, avatar, password, is_admin) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$username, $email, $avatar, $hashed_password, 1]);
}

function checkModulesExist($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM modules");
    return $stmt->fetchColumn();
}

function insertModule($pdo, $module_name) {
    $stmt = $pdo->prepare("INSERT INTO modules (module_name) VALUES (?)");
    $stmt->execute([$module_name]);
}

function getAllModules($pdo) {
    return $pdo->query("SELECT * FROM modules")->fetchAll(PDO::FETCH_ASSOC);
}

function deleteModule($pdo, $module_id) {
    $stmt = $pdo->prepare("DELETE FROM modules WHERE module_id = ?");
    $stmt->execute([$module_id]);
}

function getPostDetails($pdo, $post_id) {
    $stmt = $pdo->prepare("
        SELECT p.*, u.username, u.avatar, m.module_name
        FROM posts p 
        JOIN users u ON p.user_id = u.user_id 
        JOIN modules m ON p.module_id = m.module_id 
        WHERE p.post_id = ?
    ");
    $stmt->execute([$post_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserByEmail($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function checkUserExists($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
}

function insertPost($pdo, $title, $content, $image_path, $user_id, $module_id) {
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, image_path, user_id, module_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $content, $image_path, $user_id, $module_id]);
}

function getUserById($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function checkUsernameExists($pdo, $username, $user_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? AND user_id != ?");
    $stmt->execute([$username, $user_id]);
    return $stmt->fetchColumn();
}

function checkEmailExists($pdo, $email, $user_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND user_id != ?");
    $stmt->execute([$email, $user_id]);
    return $stmt->fetchColumn();
}

function updateUser($pdo, $username, $email, $avatar, $user_id, $password_hash = null) {
    $updateFields = ['username = ?', 'email = ?', 'avatar = ?'];
    $updateValues = [$username, $email, $avatar];
    
    if ($password_hash) {
        $updateFields[] = 'password = ?';
        $updateValues[] = $password_hash;
    }
    
    $updateValues[] = $user_id;
    $stmt = $pdo->prepare("UPDATE users SET " . implode(', ', $updateFields) . " WHERE user_id = ?");
    $stmt->execute($updateValues);
}

function getPostById($pdo, $post_id) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_id = ?");
    $stmt->execute([$post_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updatePost($pdo, $title, $content, $image_path, $module_id, $post_id) {
    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, image_path = ?, module_id = ? WHERE post_id = ?");
    $stmt->execute([$title, $content, $image_path, $module_id, $post_id]);
}

function insertUserWithAdmin($pdo, $username, $email, $password, $is_admin) {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $password, $is_admin]);
}

function deleteUser($pdo, $user_id, $current_user_id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ? AND user_id != ?");
    $stmt->execute([$user_id, $current_user_id]);
}

function getAllUsers($pdo) {
    return $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
}

function getAllPosts($pdo) {
    $stmt = $pdo->query("
        SELECT p.*, u.username, u.avatar, m.module_name
        FROM posts p 
        JOIN users u ON p.user_id = u.user_id 
        JOIN modules m ON p.module_id = m.module_id 
        ORDER BY p.created_at DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function checkEmailAlreadyExists($pdo, $email) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
}
?>