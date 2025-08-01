<?php
$servername = "localhost"; // Change this to your MySQL server hostname
$dbname = "reglog"; // Change this to your database name
include 'connection.php'; // Include the database connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ''; // Initialize a message variable
$submission_successful = false; // Flag to indicate successful submission

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect review data from the form
    $email = $_POST['email'];  // Match your form field name with the database column
    $review = $_POST['review'];  // Match your form field name with the database column
    $rating = $_POST['rating'];  // Match your form field name with the database column

    // Check if the email exists in tb_user
    $emailCheckQuery = "SELECT * FROM tb_user WHERE email = '$email'";
    $emailResult = $conn->query($emailCheckQuery);

    if ($emailResult->num_rows > 0) {
        // Email exists, allow review submission
        // SQL query to insert review into the 'review' table
        $sql = "INSERT INTO review (email, review, rating) VALUES ('$email','$review', '$rating')";  // Adjust column names

        if ($conn->query($sql) === TRUE) {
            $message = "Thank you for submitting your review!";
            // Set a flag for successful submission
            $submission_successful = true;
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Email doesn't exist, display a message
        $message = "Email does not exist. Review submission denied.";
    }
}

// Fetch reviews with corresponding usernames from the database
$sql = "SELECT review.review, review.rating, review.submit_date, tb_user.username FROM review
        JOIN tb_user ON review.email = tb_user.email";
$result = $conn->query($sql);

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .review {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .review p {
            margin: 0;
            padding-bottom: 10px;
        }

        .review .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .review .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .review .user-info .username {
            font-weight: bold;
        }

        .review .user-info .rating {
            margin-left: auto;
        }

        .review .user-info .date {
            font-size: 14px;
            color: #888;
        }

        .no-reviews {
            text-align: center;
            font-style: italic;
            color: #888;
        }

        .review-form {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .review-form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .review-form input,
        .review-form textarea,
        .review-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .review-form select {
            background-color: #f8f8f8;
        }

        .review-form button {
            padding: 10px 20px;
            background-color: #ff9900;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }

        .review-form button:hover {
            background-color: #e68a00;
        }

        .rating {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .star {
            color: #ff9900;
            font-size: 24px;
            margin: 0 5px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star.checked {
            color: #fdba13;
        }

        .helpful {
            text-align: right;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Reviews</h1>

        <!-- Review Form -->
        <div class="review-form">
            <h2>Add a Review</h2>
            <form action="display_reviews.php" method="post">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>

                <label for="rating">Rating:</label>
                <div class="rating" id="rating">
                    <span class="star" data-rating="1">&#9733;</span>
                    <span class="star" data-rating="2">&#9733;</span>
                    <span class="star" data-rating="3">&#9733;</span>
                    <span class="star" data-rating="4">&#9733;</span>
                    <span class="star" data-rating="5">&#9733;</span>
                </div>
                <input type="hidden" name="rating" id="selected-rating" required>

                <label for="review">Your Review:</label>
                <textarea id="review" name="review" required></textarea>

                <button type="submit">Submit Review</button>
            </form>
            <p><?php echo $message; ?></p>
        </div>

        <?php
        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='review'>";
                echo "<div class='user-info'>";
                echo "<img src='user-avatar.jpg' alt='User Avatar'>";
                echo "<div class='username'>" . $row["username"] . "</div>";
                echo "<div class='rating'>";
                for ($i = 1; $i <= $row["rating"]; $i++) {
                    echo "<span class='star'>&#9733;</span>";
                }
                echo "</div>";
                echo "<div class='date'>" . $row["submit_date"] . "</div>";
                echo "</div>";
                echo "<p><strong>Review:</strong> " . $row["review"] . "</p>";
                echo "<div class='helpful'>Was this review helpful? Yes (0) No (0)</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-reviews'>No reviews found.</p>";
        }
        ?>
    </div>
    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('selected-rating');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-rating');
                ratingInput.value = rating;
                stars.forEach(s => s.classList.remove('checked'));
                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add('checked');
                }
            });
        });
    </script>
</body>
</html>
