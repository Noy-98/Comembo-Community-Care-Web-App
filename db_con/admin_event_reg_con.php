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
$sql = "SELECT id, event_name, event_f_name, event_l_name, event_email, event_m_number, event_address, event_age, event_category FROM event_reg";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='alert' role='alert'>
                <td scope='row'>{$row['id']}</td>
                <td>{$row['event_name']}</td>
                <td>{$row['event_f_name']}</td>
                <td>{$row['event_l_name']}</td>
                <td>{$row['event_email']}</td>
                <td>{$row['event_m_number']}</td>
                <td>{$row['event_address']}</td>
                <td>{$row['event_age']}</td>
                <td>{$row['event_category']}</td>
                <td>
                    <a href='../../../db_con/delete_event_reg_con.php?id={$row['id']}' class='close' data-dismiss='alert' aria-label='Close' onclick='return confirm(\"Are you sure you want to delete this event registration?\");'>
                        <span aria-hidden='true'><i class='fa fa-close'></i></span>
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No Event Registration found!</td></tr>";
}

$conn->close();
?>
