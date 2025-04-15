<?php global $error1, $error2; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <h4 class="h1">Forgot Password</h4>
        <div class="sub_msg">
            <!-- Here we will show success or error messages -->
        </div>
    </div>

    <form method="post" id="forget_form">
        <div class="mb-3 input_group">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" id="email_forget" name="email_forget" placeholder="Enter your email">
            <span id="errorEmail" class="text-danger"></span>
        </div>
        
        <button type="submit" class="btn btn-primary" id="forget">Submit</button>
    </form>

    <script>
        $(document).ready(function(){
            $("#forget_form").submit(function(e){
                e.preventDefault();
                
                var email = $('#email_forget').val();
                var valid = true;

                // Email validation
                if (email === '') {
                    valid = false;
                    $('#errorEmail').html("Email cannot be empty.");
                } else if (!validateEmail(email)) {
                    valid = false;
                    $('#errorEmail').html("Please enter a valid email.");
                } else {
                    $('#errorEmail').html("");
                }

                // If form is valid, send data via AJAX
                if (valid) {
                    var formData = { email_forget: email };

                    $.ajax({
                        url: '../auth/forget_password.php',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                // Display success message and redirect to login page after 3 seconds
                                $('.sub_msg').html('<div class="alert alert-success">' + response.message + '</div>');
                                setTimeout(function() {
                                    window.location.href = '../user/login_form.php'; // Redirect to login page
                                }, 3000);
                            } else {
                                // Display error message
                                $('.sub_msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                            }
                        },
                        error: function() {
                            $('.sub_msg').html('<div class="alert alert-danger">Something went wrong. Please try again later.</div>');
                        }
                    });
                }
            });

            // Simple email validation function
            function validateEmail(email) {
                var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return re.test(email);
            }
        });
    </script>
</body>
</html>
