// public/js/reg.js

$(document).ready(function () {
    $('#signupForm').on('submit', function (e) {
        e.preventDefault();

        const name = $('#name').val().trim();
        const email = $('#email').val().trim();
        const password = $('#password').val().trim();

        let valid = true;

        // Reset all errors
        $('#errorName, #errorEmail, #errorPassword').text('');
        $('#responseMessage').removeClass('alert-success alert-danger').addClass('d-none').text('');

        if (!name || !/[A-Za-z]+/.test(name)) {
            $('#errorName').text("Please enter a valid name.");
            valid = false;
        }

        if (!email) {
            $('#errorEmail').text("Email cannot be empty.");
            valid = false;
        }

        if (!password) {
            $('#errorPassword').text("Password cannot be empty.");
            valid = false;
        }

        if (!valid) return;

        $.ajax({
            url: "../auth/insert.php",
            type: "POST",
            data: JSON.stringify({ name, email, password }),
            contentType: "application/json",
            success: function (response) {
                const alertBox = $('#responseMessage');
              
                if (response.success) {
                    alertBox.removeClass('d-none').addClass('alert alert-success').text(response.message);
                    $('#signupForm')[0].reset();  // ✅ Clear form
                    $('#errorName, #errorEmail, #errorPassword').text('');
                } else {
                    alertBox.removeClass('d-none').addClass('alert alert-danger').text(response.message);
                }
                
            },
            error: function () {
                $('#responseMessage').removeClass('d-none').addClass('alert alert-danger').text("Something went wrong. Try again later.");
            }
        });
    });
});
