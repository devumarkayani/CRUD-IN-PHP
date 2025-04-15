<?php
// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- jQuery (Only load once) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./user/css/custom.css">
    
    <!-- Custom JS (for registration handling) -->
    <script src="user/js/reg.js"></script>

    <!-- Popper.js (needed for Bootstrap tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    
    <!-- Bootstrap JS (needed for Bootstrap's interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</head>
<body>

<div class="container py-4">
    <!-- Display Alert Messages (success/error) -->
    <?php if (isset($_GET['activated'])): ?>
        <div class="alert alert-success text-center">Your account has been activated!</div>
    <?php elseif (isset($_GET['invalid_key'])): ?>
        <div class="alert alert-danger text-center">Invalid activation key.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center">Something went wrong. Try again.</div>
    <?php endif; ?>

    <!-- Navigation Tabs (links to different pages) -->
    <ul class="nav nav-tabs" id="authTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="index-tab" href="home.php" role="tab">Home</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="login-tab" href="user/login_form.php" role="tab">Login</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="signup-tab" href="user/signup.php" role="tab">Sign Up</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="admin-tab" href="user/home.php" role="tab">Admin</a>
        </li>
    </ul>

    <!-- Tab Content (for display purposes in case you decide to keep it later) -->
    <div class="tab-content mt-3" id="authTabsContent">
        <!-- Home Tab (does not need content for now since it's just for navigation) -->
        <div class="tab-pane fade show active" id="index" role="tabpanel">
            <h4>Welcome to the Authentication System</h4>
            <p>Select a tab above to continue.</p>
        </div>

        <!-- Login Tab -->
        <div class="tab-pane fade" id="login" role="tabpanel">
            <?php include("./user/login_form.php"); ?>
        </div>

        <!-- Sign Up Tab -->
        <div class="tab-pane fade" id="signup" role="tabpanel">
            <?php include("./user/signup.php"); ?>
        </div>

        <!-- Admin Tab -->
        <div class="tab-pane fade" id="admin" role="tabpanel">
            <h4>Admin Panel</h4>
            <p>Admin tools will go here.</p>
        </div>
    </div>
</div>

</body>
</html>
