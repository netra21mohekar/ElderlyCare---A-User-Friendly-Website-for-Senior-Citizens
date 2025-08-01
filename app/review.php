<?php
$servername = "localhost"; // Change this to your MySQL server hostname
$dbname = "reglog"; // Change this to your database name
include 'connection.php'; // Include the database connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ''; // Initialize a message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect review data from the form
    $email = $_POST['email'];  // Change to match your form field name
    $review = $_POST['review'];  // Change to match your form field name

    // Check if the email exists in tb_user
    $emailCheckQuery = "SELECT * FROM tb_user WHERE email = '$email'";
    $emailResult = $conn->query($emailCheckQuery);

    if ($emailResult->num_rows > 0) {
        // Email exists, allow review submission
        // SQL query to insert review into the 'review' table
        $sql = "INSERT INTO review (email, review) VALUES ('$email','$review')";  // Adjust column names

        if ($conn->query($sql) === TRUE) {
            $message = "Thank you for submitting your review!";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Email doesn't exist, display a message
        $message = "Email does not exist. Review submission denied.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="footer.css" />
    <style>
 body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

.container {
    max-width: 600px;
    margin: 0 auto;
}

.review-form {
    border: 1px solid #ccc;
    padding: 20px;
    margin-bottom: 20px;
    background-color: #f9f9f9;
}

.review-form label {
    display: block;
    margin-bottom: 5px;
}

.review-form input,
.review-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
}

.review-form button {
    padding: 10px 20px;
    background-color: #007BFF;
    border: none;
    color: white;
    cursor: pointer;
}

.review-form button:hover {
    background-color: #0056b3;
}

.reviews {
    border: 1px solid #ccc;
    padding: 20px;
    background-color: #f9f9f9;
}

.reviews h2 {
    margin-bottom: 10px;
}

.review {
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
    margin-bottom: 10px;
}
</style>

<body>
    <div class="header1">
      <nav class="sticky">
        <a href="" id="logo"><h2>JoyfulAging</h2></a>
        <div class="nav-links" id="navLinks">
          <i class="fas fa-window-close" onclick="hideMenu()"></i>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="">Population Status Of Older Adults</a></li>
            <li class="dropdown">
              <a href="#" class="dropbtn">Health ▼</a>
              <div class="dropdown-content">
                <a href="diet.html">Diet</a>
                <a href="exercise.html">Exercise</a>
                <a href="mentalhealth.html">Mental Health</a>
              </div>
            </li>

            <li><a href="">Law And Senior Citizen</a></li>
            <li class="dropdown">
              <a href="#" class="dropbtn">Schemes ▼</a>
              <div class="dropdown-content">
                <a href="nationlpolicy.html">National Policy of Elder Person</a>
                <a href="nationalassistance.html">National Social Assistant Programme</a>
                <a href="">Rebates</a>
                <a href="">NGO's and Voluntury Organizations</a>
              </div>
            <li><a href="">Healthy Ageing</a></li>
            <li><a href="oldAgeVideos.html">Old Age Videos</a></li>
            <div id="button">
              <li><a href="loginPage.php">Login</a></li>
            </div>
          </ul>
        </div>
        <i class="fas fa-bars" onclick="showMenu()"></i>
      </nav>
    </div>
   
    <div class="container">
        <h1>Website Review</h1>
        <!-- Review Form -->
        <div class="review-form">
            <h2 class="review-heading">Add a Review</h2>
            <form action="review.php" method="post">
                <label for="email" class="review-label">Email</label>
                <input type="text" id="email" name="email" class="review-input" required>
                <label for="review" class="review-label">Your Review:</label>
                <textarea id="review" name="review" class="review-input" required></textarea>
                <button type="submit" class="review-submit-button">Submit Review</button>
            </form>
            <p><?php echo $message; ?></p>
        </div>
    </div>

</body>
</html>
