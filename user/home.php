<?php 
session_start();
include("../config/database.php");

// 🔐 Redirect to login if user is not logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../user/login_form.php");
    exit;
}

// Fetch session data
$userId = $_SESSION["id"];
$name = $_SESSION["name"];
$email = $_SESSION["email"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Welcome to Your Dashboard</h2>

            <div class="mb-3">
                <strong>User ID:</strong> <?php echo htmlspecialchars($userId); ?>
            </div>
            <div class="mb-3">
                <strong>Name:</strong> <?php echo htmlspecialchars($name); ?>
            </div>
            <div class="mb-3">
                <strong>Email:</strong> <?php echo htmlspecialchars($email); ?>
            </div>

            <div class="text-center">
                <a href="../auth/logout.php" class="btn btn-danger mt-3">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
