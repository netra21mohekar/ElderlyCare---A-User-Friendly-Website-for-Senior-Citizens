<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "reglog");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
