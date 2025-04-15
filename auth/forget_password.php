<?php 
// Load PHPMailer classes
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include database connection
include("../config/database.php");

if (isset($_POST['email_forget'])) {
    $email = $_POST['email_forget'];

    // Basic validation
    if (empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Email is required.']);
        exit;
    }

    // Escape email to prevent SQL injection
    $emailSafe = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT * FROM signup WHERE email = '{$emailSafe}'";
    $result = mysqli_query($conn, $sql);
    $user_row = mysqli_num_rows($result);

    if ($user_row > 0) {
        $row = mysqli_fetch_assoc($result);
        $activation_key = $row['activation_key'];
        $emailToSend = $row['email'];

        // Setup PHPMailer
        $phpmailer = new PHPMailer(true);

        try {
            // SMTP configuration
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io'; // Use real SMTP in production
            $phpmailer->SMTPAuth = true;
            $phpmailer->Username = 'username';
            $phpmailer->Password = 'yourpassword';

            $phpmailer->Port = 2525;

            // Email settings
            $phpmailer->setFrom('nooreply@example.com', 'Dev');
            $phpmailer->addAddress($emailToSend);

            $activationLink = "http://localhost/user-authentication/user/reset_password.php?key={$activation_key}";

            $phpmailer->isHTML(true);
            $phpmailer->Subject = 'Reset Your Password';
            $phpmailer->Body = "
                <p>Hello,</p>
                <p>You requested a password reset. Please click the link below to reset your password:</p>
                <p><a href='{$activationLink}'>Reset Password</a></p>
                <p>If you did not request this, please ignore this email.</p>
            ";

            $phpmailer->send();

            echo json_encode(['success' => true, 'message' => 'Please check your email for the password reset link.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => "Email could not be sent. Error: {$phpmailer->ErrorInfo}"]);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found or not registered.']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
