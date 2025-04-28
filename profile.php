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

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

try {
    // Fetch initial user data
    $user = getUserById($pdo, $user_id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $current_password = trim($_POST['current_password'] ?? '');
        $new_password = trim($_POST['new_password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');
        $avatar = $user['avatar'];
        $changes_made = false;

        try {
            // Handle avatar upload
            if (!empty($_FILES['avatar']['name'])) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['avatar']['type'], $allowedTypes)) {
                    $error = '<p class="text-red-500">Only JPG, PNG, and GIF files are allowed.</p>';
                } elseif ($_FILES['avatar']['size'] > 5000000) { // 5MB limit
                    $error = '<p class="text-red-500">File size must be less than 5MB.</p>';
                } else {
                    $upload = (new UploadApi())->upload($_FILES['avatar']['tmp_name'], [
                        'folder' => 'user_avatars',
                        'public_id' => 'avatar_' . $user_id,
                        'overwrite' => true,
                        'width' => 200,
                        'height' => 200,
                        'crop' => 'fill'
                    ]);
                    $avatar = $upload['secure_url'];
                    if ($avatar !== $user['avatar']) {
                        $changes_made = true;
                    }
                }
            }

            // If no avatar error, proceed with validation
            if (empty($error)) {
                // Validate username
                if (!$username) {
                    $error = '<p class="text-red-500">Username cannot be empty.</p>';
                } elseif (checkUsernameExists($pdo, $username, $user_id) > 0) {
                    $error = '<p class="text-red-500">Username already taken!</p>';
                } elseif ($username !== $user['username']) {
                    $changes_made = true;
                }

                // Validate email
                if (!$email) {
                    $error = '<p class="text-red-500">Email cannot be empty.</p>';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = '<p class="text-red-500">Invalid email format.</p>';
                } elseif (checkEmailExists($pdo, $email, $user_id) > 0) {
                    $error = '<p class="text-red-500">Email already in use!</p>';
                } elseif ($email !== $user['email']) {
                    $changes_made = true;
                }

                // Validate password (only if any password field is filled)
                if ($current_password || $new_password || $confirm_password) {
                    if (!$current_password) {
                        $error = '<p class="text-red-500">Current password is required to change password.</p>';
                    } elseif (!password_verify($current_password, $user['password'])) {
                        $error = '<p class="text-red-500">Current password is incorrect.</p>';
                    } elseif (!$new_password) {
                        $error = '<p class="text-red-500">New password cannot be empty.</p>';
                    } elseif (strlen($new_password) < 8) {
                        $error = '<p class="text-red-500">New password must be at least 8 characters long.</p>';
                    } elseif ($new_password !== $confirm_password) {
                        $error = '<p class="text-red-500">New password and confirmation do not match.</p>';
                    } else {
                        $changes_made = true;
                    }
                }

                // If no errors, update database
                if (empty($error)) {
                    if (!$changes_made) {
                        $error = '<p class="text-red-500">No changes were made.</p>';
                    } else {
                        $password_hash = $new_password ? password_hash($new_password, PASSWORD_DEFAULT) : null;
                        updateUser($pdo, $username, $email, $avatar, $user_id, $password_hash);

                        // Refresh user data
                        $user = getUserById($pdo, $user_id);

                        $_SESSION['username'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['avatar'] = $user['avatar'];

                        $success = '<p class="text-green-500">Profile updated successfully!</p>';
                    }
                }
            }
        } catch (Exception $e) {
            $error = '<p class="text-red-500">Error updating profile: ' . $e->getMessage() . '</p>';
        }
    }

    $title = 'Edit Profile';
    ob_start();
    include 'templates/profile.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>