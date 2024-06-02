<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'conn.php'; // Adjust the path if necessary

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Fetch user data from the database
$sql = "SELECT id, event_name, image_upload, date, time FROM event_barangay_post";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><img src='" . htmlspecialchars($row['image_upload']) . "' alt='Event Image' class='img-fluid rounded' style='max-width: 100px;'></td>
                <td>" . htmlspecialchars($row['event_name']) . "</td>
                <td>" . htmlspecialchars($row['date']) . "</td>
                <td>" . htmlspecialchars($row['time']) . "</td>
                <td>
                    <div class='d-flex align-items-center'>
                        <a href='../../db_con/delete_event_barangay_post_con.php?id=" . urlencode($row['id']) . "' onclick='return confirm(\"Are you sure you want to delete this post?\");' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i></a>
                    </div>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No post found</td></tr>";
}

$conn->close();
?>
