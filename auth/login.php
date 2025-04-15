<?php
session_start();
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("../config/database.php");

header('Content-Type: application/json');

$inputData = json_decode(file_get_contents("php://input"), true);

if (!$inputData) {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

$email = trim($inputData['email'] ?? '');
$password = trim($inputData['password'] ?? '');

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid Email Address.']);
    exit;
}

// Escape email to avoid SQL injection
$emailSafe = mysqli_real_escape_string($conn, $email);
$sql = "SELECT * FROM signup WHERE email = '{$emailSafe}'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
    exit;
}

$user = mysqli_fetch_assoc($result);

// Check if account is activated
if ($user['is_active'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Please activate your account via email.']);
    exit;
}

// Verify password using password_verify()
if (!password_verify($password, $user['password'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
    exit;
}

// ✅ Set session
$_SESSION['id'] = $user['id'];
$_SESSION['name'] = $user['name'];
$_SESSION['email'] = $user['email'];
$_SESSION['activation_key'] = $user['activation_key'];

// ✅ Respond with success
echo json_encode(['success' => true, 'message' => 'Login successful. Redirecting...', 'redirect' => '../user/home.php']);
?>
