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
                <td>{$row['event_name']}</td>
                <td>{$row['event_f_name']}</td>
                <td>{$row['event_l_name']}</td>
                <td>{$row['event_email']}</td>
                <td>{$row['event_m_number']}</td>
                <td>{$row['event_address']}</td>
                <td>{$row['event_age']}</td>
                <td>{$row['event_category']}</td>
                <td>
                    <div class='d-flex align-items-center'>
                        <a href='../../db_con/delete_event_reg_con.php?id=" . urlencode($row['id']) . "' onclick='return confirm(\"Are you sure you want to delete this post?\");' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i></a>
                    </div>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No Event Registration found!</td></tr>";
}

$conn->close();
?>
