<?php
require 'connection.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $gender = $_POST["gender"];
    $contact = $_POST["contact"];

    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");

    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Username or email has already taken');</script>";
    } else {
        if ($password == $confirmpassword) {
            // Adjust the query to include gender and contact
            $query = "INSERT INTO tb_user VALUES('', '$name', '$username', '$email', '$password', '$gender', '$contact')";
            mysqli_query($conn, $query);
            echo "<script>alert('Register Successful');</script>";
        } else {
            echo "<script>alert('Password does not match');</script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        /* Add the CSS code here */
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        body {
            background: #76b852;
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            margin: 0;
            padding: 0;
        }

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }

        .form button:hover, .form button:active, .form button:focus {
            background: #43A047;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form .register-form {
            display: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }

        .container:before, .container:after {
            content: "";
            display: block;
            clear: both;
        }

        .container .info {
            margin: 50px auto;
            text-align: center;
        }

        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }

        .container .info span a {
            color: #000000;
            text-decoration: none;
        }

        .container .info span .fa {
            color: #EF3B3A;
        }
            .message {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

.message {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #000; /* Adjust the color as needed */
        }

        .message a {
            color: #4CAF50;
            text-decoration: none;
        }
        /* Add this CSS to style the select options */
select {
    font-family: "Roboto", sans-serif;
    outline: 0;
    background: #f2f2f2;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 14px;
    color: #555;
}

/* Style the arrow for the select */
select:after {
    content: '\f107'; /* Unicode for down arrow */
    font-family: FontAwesome;
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
}

       
    </style>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form class="" action="" method="post" autocomplete="off">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required value=""><br>
                <label for="username">Username:</label>
                <input type="text" name="username" required value=""><br>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required value=""><br>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required value=""><br>
                <label for="confirmpassword">Confirm Password:</label>
                <input type="password" name="confirmpassword" id="confirmpassword" required value=""><br>
                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="" disabled selected>Select your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br>
                <label for="contact">Contact Number:</label>
                <input type="tel" name="contact" required><br>
                <button type="submit" name="submit">Signup</button>
                <p class="message">Already have an account? <a href="loginPage.php">Login</a></p>
            </form>
        </div>
    </div>
    
</body>
</html>
