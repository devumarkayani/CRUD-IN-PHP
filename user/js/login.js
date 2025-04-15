$(document).ready(function(){
    $("#login").click(function(e){
        e.preventDefault();
        var xmlhttp = new XMLHttpRequest();
        var email = $('#email_login').val();
        var password = $('#password_login').val();
        var valid = true;
        
        // Basic form validation
        if(email === ''){
            valid = false;
            $('#errorEmail').html("Email Cannot be Empty");
        } else {
            $('#errorEmail').html("");
        }
        
        if(password === ''){
            valid = false;
            $('#errorPassword').html("Password Cannot be Empty");
        } else {
            $('#errorPassword').html("");
        }

        // If the form is valid, send the AJAX request
        if(valid == true) {
            var formdata = {
                email: email,
                password: password
            };

            xmlhttp.open("POST", "../auth/login.php", true);
            xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

            // Define the onload function to handle the response
            xmlhttp.onload = function() {
                if (xmlhttp.status >= 200 && xmlhttp.status < 300) {
                    var data = JSON.parse(xmlhttp.responseText);  // Parse the JSON response

                    if (data.success) {
                        // Redirect to the URL provided in the response
                        window.location.href = data.redirect;
                    } else {
                        // Handle the error message
                        alert(data.message);
                    }
                } else {
                    alert("Something went wrong. Please try again later.");
                }
            };

            // Send the data to the server
            var jsonData = JSON.stringify(formdata);
            xmlhttp.send(jsonData);
        }

        // Prevent form submission if the form is invalid
        return false;
    });
});
