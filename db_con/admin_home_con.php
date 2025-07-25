<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'conn.php'; // Adjust the path if necessary

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../../php/login.php');
    exit();
}

// Fetch user data from the database
$sql = "SELECT id, first_name, last_name, email FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='alert' role='alert'>
                <td scope='row'>{$row['id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>
                    <a href='../../../db_con/delete_user_con.php?id={$row['id']}' class='close' data-dismiss='alert' aria-label='Close' onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                        <span aria-hidden='true'><i class='fa fa-close'></i></span>
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No users found</td></tr>";
}

$conn->close();
?>
