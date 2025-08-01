<?php
include("connection.php");
$query = "SELECT * FROM tb_user";
$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);

echo '<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f0f0f0; /* Set your desired background color */
    }
    table {
        border-collapse: collapse;
        width: 80%;
        margin: 20px;
        background-color: white; /* Set your desired table background color */
    }
    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2; /* Set your desired table header background color */
    }
</style>';

if ($total != 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Opreations</th>
            </tr>";

    while ($result = mysqli_fetch_assoc($data)) {
        echo "<tr>
                <td>" . $result['id'] ."</td>
                <td>" . $result['name'] . "</td>
                <td>" . $result['username'] . "</td>
                <td>" . $result['email'] . "</td>
                <td>" . $result['gender'] . "</td>
                <td>" . $result['contact'] . "</td>
                <td><a href='update_design.php?id=" . $result['id'] . "&name=" . $result['name'] . "&username=" . $result['username'] . "&email=" . $result['email'] . "&gender=" . $result['gender'] . "&contact=" . $result['contact'] . "'>Update</a></td>

            </tr>";
    }

    echo "</table>";
} else {
    echo "No records found";
}
?>
