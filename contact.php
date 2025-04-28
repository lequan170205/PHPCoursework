<?php
session_start();
include 'includes/db.php';

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust path if not using Composer

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
    $message = $_POST['message'];

    // Validate inputs
    if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($message) < 10) {
        $title = 'Contact Admin';
        $output = '<p class="text-red-500">Name must be 2+ characters, email must be valid, and message 10+ characters</p>';
        ob_start();
        include 'templates/contact.html.php';
        $output .= ob_get_clean();
    } else {
        try {
            // Set up PHPMailer
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'leanhquan1702@gmail.com'; // Your Gmail address
                $mail->Password = 'zcyzlwjgbynxlmtu'; // The 16-character App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL
                $mail->Port = 465;

                // Recipients
                $mail->setFrom($email, $name); // Sender's email and name
                $mail->addAddress('duykhanhb60@gmail.com'); // Admin's email

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'New Contact Message from ' . $name;
                $mail->Body = '<h3>New Contact Message</h3>' .
                              '<p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>' .
                              '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>' .
                              '<p><strong>Message:</strong> ' . nl2br(htmlspecialchars($message)) . '</p>';
                $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message";

                // Send email
                $mail->send();

                // Success message
                $title = 'Contact Admin';
                $output = '<p class="text-green-600">Message sent!</p>';
                ob_start();
                include 'templates/contact.html.php';
                $output .= ob_get_clean();
            } catch (Exception $e) {
                $title = 'An error has occurred';
                $output = 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
        }
    }
} else {
    $title = 'Contact Admin';
    ob_start();
    include 'templates/contact.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';
?>