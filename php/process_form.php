<?php
// Use the confirmed autoloader path
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Custom function to log errors without exposing them
function logError($message) {
    error_log("[" . date('Y-m-d H:i:s') . "] " . $message, 3, __DIR__ . '/error_log.txt');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data with fallback to empty string
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING) ?? '';
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING) ?? '';

    // Validate that required fields are not empty and email is valid
    if (!empty($name) && !empty($message) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            // Server settings - PRODUCTION READY
            $mail->SMTPDebug = 0;                              // Disable debug output for production
            $mail->isSMTP();                                   // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';              // Set Gmail SMTP server
            $mail->SMTPAuth   = true;                          // Enable SMTP authentication
            $mail->Username   = 'docmatchspprt@gmail.com';     // SMTP username
            $mail->Password   = 'sirn pnsk sszl ibhk';    // REPLACE WITH ACTUAL APP PASSWORD
            $mail->SMTPSecure = 'tls';                         // Enable TLS encryption
            $mail->Port       = 587;                           // TCP port to connect to

            // Recipients
            $mail->setFrom('docmatchspprt@gmail.com', 'DocMatch Contact Form');
            $mail->addAddress('docmatchspprt@gmail.com', 'DocMatch Support');
            $mail->addReplyTo($email, $name);

            // Content
            $mail->isHTML(false);
            $mail->Subject = 'Contact Form Submission from DocMatch';
            
            // Email content
            $email_content = "Name: $name\n";
            $email_content .= "Email: $email\n\n";
            $email_content .= "Message:\n$message\n";
            $mail->Body = $email_content;

            // Send email
            $mail->send();
            logError("Mail sent successfully to docmatchspprt@gmail.com from $email");
            
            // Redirect with success status
            header("Location: ../src/landingpage.html?status=success#contact");
            
        } catch (Exception $e) {
            logError("Mail failed to send. Error: {$mail->ErrorInfo}");
            // No direct error output in production
            header("Location: ../src/landingpage.html?status=error#contact");
        }
    } else {
        // Log validation errors
        if (empty($name) || empty($message)) {
            logError("Form submission failed: Empty required fields");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            logError("Form submission failed: Invalid email format - $email");
        }
        
        // Redirect with error status if validation fails
        header("Location: ../src/landingpage.html?status=error#contact");
    }
    exit;
}
?>