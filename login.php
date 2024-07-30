<?php
include "scripts.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdnjs.cloudflare.com/ajax/libs/faviconx/1.0.1/faviconx-min.js" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/login.css"> -->
    <!-- <link rel="icon" href="https://cdn.example.com/path/to/favicon.ico" type="image/x-icon"> -->

    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* General Styles */
.container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    width: 100%; /* Full width on small screens */
    max-width: 400px; /* Maximum width */
    margin: 0 auto; /* Center the container */
    z-index: 999;
}

body {
    font-family: sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* Ensure full viewport height */
    background-color: #f4f4f4;
}

.logo {
    width: 80px;
    height: 80px;
    margin-bottom: 20px;
}

.logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

h1 {
    margin-bottom: 20px;
}

input[type="email"], input[type="text"] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.error {
    color: red;
    font-size: 14px;
    margin-bottom: 10px;
}

.errorclass {
    border: 1px solid red;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background-color: #45a049;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

#code {
    font-family: monospace;
}

/* Responsive Styles */
@media (max-width: 600px) {
    .container {
        padding: 10px;
    }

    h1 {
        font-size: 24px;
    }

    input[type="email"], input[type="text"] {
        padding: 10px 15px;
    }

    button {
        padding: 10px 15px;
    }
}

    </style>
    <script>
        $(document).ready(function() {
            function verify() {
                $("#loaderbox").show();
                const $codeError = $('#codeError');
                event.preventDefault(); // Prevent default form submission

                const codeInput = $("#code").val().trim();
                const generatecode = $("#generatecode").val().trim();

                if (codeInput === '') {
                    $("#loaderbox").hide();
                    $codeError.text('Enter a valid 6 digit');
                    $(".input-group").addClass('errorclass');
                    return;
                } else {
                    $(".input-group").removeClass('errorclass');
                }
                if (codeInput === generatecode) {
                    $.ajax({
                        type: 'POST',
                        url: 'verify.php', // Replace with your backend endpoint
                        data: { code: codeInput },
                        success: function(response) {
                            console.log(response);
                            if (response == 1) {
                                window.location.href = 'dashboard.php';
                                $("#loaderbox").hide();
                            } else {
                                $("#loaderbox").hide();
                                $codeError.text('Something Went Wrong');
                            }
                        },
                        error: function(error) {
                            $("#loaderbox").hide();
                            console.error(error);
                        }
                    });
                } else {
                    $("#loaderbox").hide();
                    $codeError.text('Enter a correct 6 digit code');
                    $(".input-group").addClass('errorclass');
                    alert("wrong");
                }
            }

            const $emailInput = $('#email');
            const $emailError = $('#emailError');
            const $loginForm = $('#login');
            $loginForm.on('click', function(event) {
                $("#loaderbox").show();
                event.preventDefault(); // Prevent default form submission

                const email = $emailInput.val().trim();
                const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                if (email === '') {
                    $("#loaderbox").hide();
                    $emailError.text('Enter a valid email address');
                    $(".input-group").addClass('errorclass');
                    return;
                } else if (!emailRegex.test(email)) {
                    $("#loaderbox").hide();
                    $emailError.text('Invalid email address');
                    $(".input-group").addClass('errorclass');
                    return;
                } else {
                    $(".input-group").removeClass('errorclass');
                }

                // Send email for verification
                $.ajax({
                    type: 'POST',
                    url: 'loginsave.php', // Replace with your backend endpoint
                    data: { email: email },
                    success: function(response) {
                        console.log(response);
                        var parts = response.split("_");
                        if (parts[0] == "1") {
                            $.post('verifyscreen.php', { email: email, code: parts[1] }, function(html) {
                                // Display the HTML response
                                $('#response-container').html(html);
                                $("#loaderbox").hide();
                            });
                        } else {
                            $("#loaderbox").hide();
                            $emailError.text('Something Went Wrong' + response);
                        }
                    },
                    error: function(error) {
                        $("#loaderbox").hide();
                        console.error(error);
                    }
                });
            });

            $(document).on('click', '#verify', function(event) {
                verify();
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="logo">
            <!-- <img src="your_logo.png" alt="Logo"> -->
        </div>
        <div id='response-container'>
            <h1>Log in</h1>
            <p>Enter your email and we'll send you a login code</p>
            <form id="loginForm">
                <div class="input-container">
                    <i class="fas fa-user icon"></i>
                    <input class="input-field" type="text" placeholder="Username or email" name="email" id="email">
                </div>
                <div class="error" id="emailError"></div>
                <button id="login">Continue</button>
            </form>
        </div>
    </div>
</body>
</html>
