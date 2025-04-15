

<?php global $error1,$error2;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In </title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/custom.css"> -->
</head>
<body>
    <?php  echo $error1 ?>
    <?php  echo $error2 ?>
        <div class="container mt-5 text-center">
            <h4 class="h1">
                Login 
                
            </h4>
            <div class="sub_msg">

            </div>
        </div>
        <form method="post">
            
            <div class="mb-3  input_group">
                <label  class="form-label">Email address</label>
                <input type="email" class="form-control" id="email_login" aria-describedby="emailHelp" name="email_login">
                <span id="errorEmail"></span>
            </div>
            <div class="mb-3  input_group">
                <label  class="form-label">Password</label>
                <input type="password" class="form-control" id="password_login" aria-describedby="passwordHelp" name="password_login">
                <span id="errorPassword"></span>
            </div>
            <button type="submit" class="btn btn-primary" id="login">Submit</button>
        </form>
        <div class="row">
        <div class="col-sm-12 text-center">
        <a href="../user/forget.php">Forget Password </a>
        
        </div>
    
        </div>
</body>
</html>