<?php
$servername = "localhost"; // Change this to your MySQL server hostname
$dbname = "reglog"; // Change this to your database name
include 'connection.php'; // Include the database connection

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a task to the database
function addTask($conn, $task, $dueDate, $dueTime) {
    $task = mysqli_real_escape_string($conn, $task);
    $dueDate = mysqli_real_escape_string($conn, $dueDate);
    $dueTime = mysqli_real_escape_string($conn, $dueTime);
    $sql = "INSERT INTO task (task_name, due_date, due_time) VALUES ('$task', '$dueDate', '$dueTime')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to mark a task as complete
function markTaskComplete($conn, $task_id) {
    $task_id = intval($task_id);
    $sql = "UPDATE task SET completed = 1 WHERE id = $task_id";
    $conn->query($sql);
}

// Function to delete a task
function deleteTask($conn, $task_id) {
    $task_id = intval($task_id);
    $sql = "DELETE FROM task WHERE id = $task_id";
    $conn->query($sql);
}

// Handle adding a new task
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task']) && !empty($_POST['task']) && isset($_POST['due_date']) && isset($_POST['due_time'])) {
        $task = $_POST['task'];
        $dueDate = $_POST['due_date'];
        $dueTime = $_POST['due_time'];
        if (addTask($conn, $task, $dueDate, $dueTime)) {
            header("Location: $_SERVER[PHP_SELF]");
        }
    }
}

// Handle marking a task as complete
if (isset($_GET['complete'])) {
    $task_id = $_GET['complete'];
    markTaskComplete($conn, $task_id);
    header("Location: $_SERVER[PHP_SELF]");
}

// Handle deleting a task
if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    deleteTask($conn, $task_id);
    header("Location: $_SERVER[PHP_SELF]");
}

// Retrieve tasks from the database
$sql = "SELECT * FROM task ORDER BY created_at DESC";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.25.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <title>To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .task-list {
            list-style: none;
            padding: 0;
        }

        .task-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0;
            padding: 10px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .task-list li.complete {
            background-color: #dff0d8;
            text-decoration: line-through;
        }

        .task-list .actions {
            display: flex;
        }

        .actions a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .task-form {
            display: flex;
            margin-top: 20px;
        }

        .task-form input[type="text"] {
            flex: 1;
            padding: 10px;
        }

        .task-form input[type="date"], .task-form input[type="time"] {
            padding: 10px;
        }

        .task-form button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
        }

        .task-icons {
            display: flex;
            align-items: center;

        }

        .complete-icon, .delete-icon {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }
        .input-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.input-label {
    font-size: 16px;
    margin-bottom: 5px;
    font-weight: bold;
}
.task-form button {
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: white;
    cursor: pointer;
    width: auto;
}


    </style>
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>

        <ul class="task-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $task_id = $row['id'];
                    $task_name = $row['task_name'];
                    $completed = $row['completed'];
                    $created_at = $row['created_at'];

                    echo "<li class='" . ($completed ? "complete" : "") . "'>";
                    echo "<span>$task_name</span>";
                    echo "<span class='actions'>";

                    if (!$completed) {
                        echo "<a href='$_SERVER[PHP_SELF]?complete=$task_id'><i class='bi bi-check-square'></i> Complete</a>";
                    }
                    
                    echo "<a href='$_SERVER[PHP_SELF]?delete=$task_id'><i class='bi bi-trash'></i> Delete</a>";
                    echo "</span>";
                    echo "</li>";
                }
            } else {
                echo "<p>No tasks found.</p>";
            }
            ?>
        </ul>

        <form class="task-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="input-group">
        <label class="input-label" for="task">Task:</label>
        <input type="text" name="task" id="task" placeholder="Enter a new task" required>
    </div>

    <div class="input-group">
        <label class="input-label" for="due_date">Due Date:</label>
        <input type="date" name="due_date" id="due_date" required>
    </div>

    <div class="input-group">
        <label class="input-label" for="due_time">Due Time:</label>
        <input type="time" name="due_time" id="due_time" required>
    </div>

    <button type="submit">Add Task</button>
</form>

    </div>
</body>
</html>
