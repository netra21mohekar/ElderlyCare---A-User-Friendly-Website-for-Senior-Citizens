<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Photo Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .upload-box {
            text-align: center;
            padding: 20px;
            border: 2px dashed #ccc;
            max-width: 400px;
            margin: 0 auto;
        }
        .upload-box .profile-photo {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 15px;
            overflow: hidden;
            border-radius: 50%;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .upload-box .profile-photo img {
            max-width: 100%;
            max-height: 100%;
        }
        .upload-box .profile-photo .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .upload-box .profile-photo:hover .overlay {
            opacity: 1;
        }
        .upload-box .profile-photo .icon {
            color: white;
        }
        .upload-box input[type="file"] {
            display: none;
        }
        .upload-box label {
            display: block;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .upload-box button {
            padding: 15px 30px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .upload-box button:hover {
            background-color: #43A047;
        }
    </style>
</head>
<body>
    <div class="upload-box">
        <label for="profile-photo-input">Upload Profile Photo</label>
        <div class="profile-photo">
            <!-- ... (your existing profile photo HTML) ... -->
        </div>
        <form action="upload.php" method="post" enctype="multipart/form-data" id="upload-form">
            <input type="file" accept="image/*" id="profile-photo-input" name="photo" style="display: none;">
            <button type="button" onclick="selectPhoto()">Upload Photo</button>
        </form>
    </div>

    <script>
        function selectPhoto() {
            document.getElementById('profile-photo-input').click();
        }
    </script>
</body>
</html>
</html>

<?php
require 'connection.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $photo = $_FILES["photo"];

    // Check if a file was uploaded
    if ($photo["error"] === UPLOAD_ERR_OK) {
        $fileName = basename($photo["name"]);
        $tempFilePath = $photo["tmp_name"];

        // Move the uploaded file to a desired directory (e.g., uploads/)
        $targetFilePath = "uploads/" . $fileName;
        move_uploaded_file($tempFilePath, $targetFilePath);

        // TODO: Store $targetFilePath in the database for the user's profile photo
        // You would typically insert $targetFilePath into the user's record in your database
        // For this example, we'll just echo the file path
        echo "Profile photo uploaded successfully: " . $targetFilePath;
    } else {
        echo "Error uploading photo.";
    }
}
?>