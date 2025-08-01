<?php
require 'connection.php'; // Include your database connection file

if(isset($_POST["reset"])){
    $email = $_POST["email"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Check if the email exists in your database
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");

    if(mysqli_num_rows($result) > 0){
        // Check if passwords match
        if ($newPassword === $confirmPassword) {
            // Update the user's password
            $query = "UPDATE tb_user SET password='$newPassword' WHERE email='$email'";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Password updated successfully.');</script>";
            } else {
                echo "<script>alert('Error updating password: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match. Please try again.');</script>";
        }
    }
    else{
        echo "<script>alert('Email not found. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Forgot Password</title>
    <style>
         @import url(https://fonts.googleapis.com/css?family=Roboto:300);
         html, body {
    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #76b852; /* Green background color */
    font-family: "Roboto", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.login-page {
    width: 360px;
    padding: 8% 0 0;
}

.form {
    position: relative;
    z-index: 1;
    background: #FFFFFF;
    max-width: 360px;
    margin: auto;
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

    </style>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <h2>Forgot Password</h2>
            <form action="" method="post">
                <input type="email" name="email" placeholder="Enter your email" required><br>

                <!-- New password and confirm password fields -->
                <input type="password" name="new_password" placeholder="New Password" required><br>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>

                <button type="submit" name="reset">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
