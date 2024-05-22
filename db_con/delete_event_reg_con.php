<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/conn.php'; // Adjust the path if necessary

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../../php/login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM event_reg WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User deleted successfully.";
    } else {
        $_SESSION['error'] = "Error deleting user.";
    }

    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid request.";
}

$conn->close();

header('Location: /Comembo-Community-Care-Web-App/php/dashboard/admin/event_reg.php');
exit();
?>
