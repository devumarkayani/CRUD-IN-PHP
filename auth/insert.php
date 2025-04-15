<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("../config/database.php");

header('Content-Type: application/json');

// Get JSON input from request
$inputData = json_decode(file_get_contents("php://input"), true);

if (!$inputData) {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

// Sanitize input
$name = trim($inputData['name'] ?? '');
$email = trim($inputData['email'] ?? '');
$password = trim($inputData['password'] ?? '');

if (empty($name) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid Email Address.']);
    exit;
}

// Check for existing email
$emailSafe = mysqli_real_escape_string($conn, $email);
$checkSQL = "SELECT * FROM signup WHERE email = '{$emailSafe}'";
$result = mysqli_query($conn, $checkSQL);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(['success' => false, 'message' => 'User with this email already exists.']);
    exit;
}

// Hash password and generate activation key
$nameSafe = mysqli_real_escape_string($conn, $name);
$hashedPassword = password_hash(mysqli_real_escape_string($conn, $password), PASSWORD_DEFAULT);
$activationKey = md5(uniqid(rand(), true));

// Insert user
$insertSQL = "INSERT INTO signup (name, email, password, activation_key, is_active, date_time)
              VALUES ('$nameSafe', '$emailSafe', '$hashedPassword', '$activationKey', '0', NOW())";

if (!mysqli_query($conn, $insertSQL)) {
    echo json_encode(['success' => false, 'message' => 'Database error. Please try again.']);
    exit;
}

// Send verification email
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io'; // Your Mailtrap SMTP
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'username';
    $mail->Password = 'password';
// ✅ Replace this

    $mail->setFrom('nooreply@example.com', 'Dev');
    $mail->addAddress($emailSafe);

    $activationLink = "http://localhost/user-authentication/user/user-activation.php?key={$activationKey}";

    $mail->isHTML(true);
    $mail->Subject = 'Verify Your Email Address';
    $mail->Body = "Hi {$nameSafe},<br><br>Please activate your account by clicking the link below:<br><a href='{$activationLink}'>Activate Account</a>";

    $mail->send();

    echo json_encode(['success' => true, 'message' => 'Registration successful! Please check your email to activate your account.']);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Registration saved, but email could not be sent. Mailer Error: ' . $mail->ErrorInfo
    ]);
}
?>
