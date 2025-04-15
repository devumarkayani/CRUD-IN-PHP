<?php
global $error1, $error2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration Of User</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">

  <!-- jQuery (Only load once) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

  <!-- Your Custom JS -->
  <script src="js/reg.js" defer></script>
</head>
<body>
  <div class="container mt-5">
    <?php echo $error1 ?>
    <?php echo $error2 ?>

    <h2 class="text-center mb-4">Signup</h2>

    <!-- ✅ Response Message -->
    <div class="alert d-none" id="responseMessage"></div>

    <!-- ✅ Signup Form -->
    <form id="signupForm">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
        <small class="text-danger" id="errorName"></small>
      </div>

      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email">
        <small class="text-danger" id="errorEmail"></small>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
        <small class="text-danger" id="errorPassword"></small>
      </div>

      <button type="submit" class="btn btn-primary w-100" id="submit">Register</button>
    </form>
  </div>
</body>
</html>
