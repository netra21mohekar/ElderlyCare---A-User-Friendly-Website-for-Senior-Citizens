<?php
require 'connection.php';
if(isset($_POST["login"])){
    $usernameemail = $_POST["usern"];
    $password = $_POST["userp"];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if($password == $row["password"]){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.html");
            exit();  
        }
        else{
            echo "<script>alert('Wrong password');</script>";
        }
    }
    else{
        echo "<script>alert('User Not Registered');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modern Flat Design Login Form Example</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="loginPage.css">
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form class="login-form" action="#" method="POST">
                <input type="text" placeholder="username or email" name="usern"> <!-- Changed input name -->
                <input type="password" placeholder="password" name="userp"> <!-- Changed input name -->
                <button type="submit" name="login">Login</button>
                <p class="message">Not registered? <a href="registration.php">Create an account</a> <br>
                 <a href="forgot_password.php">Forgot Password?</a></p>
            </form>
        </div>
    </div>
</body>
</html>
