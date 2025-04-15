<?php
include("../config/database.php");

// Initialize variables
$key = $_GET['key'] ?? '';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $key = $_POST['key'];
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if (empty($password) || empty($confirmPassword)) {
        $error = "Both fields are required.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        $sql = mysqli_query($conn, "SELECT * FROM signup WHERE activation_key='$key'");
        if (mysqli_num_rows($sql) > 0) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $update = mysqli_query($conn, "UPDATE signup SET password='$hashedPassword' WHERE activation_key='$key'");

            if ($update) {
                $success = "Password updated successfully! Redirecting to login...";
                echo "<script>
                        setTimeout(() => {
                            window.location.href = '../user/login_form.php';
                        }, 3000);
                      </script>";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        } else {
            $error = "Invalid activation key.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
        <h3 class="mb-3 text-center">Reset Your Password</h3>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <?php if (empty($success)): ?>
        <form method="post" novalidate>
            <input type="hidden" name="key" value="<?= htmlspecialchars($key) ?>">

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="6">
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required minlength="6">
            </div>

            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
        </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
