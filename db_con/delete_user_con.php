<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/conn.php'; // Adjust the path if necessary

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Prepare and execute the delete statement for the password_reset_requests table
        $stmt1 = $conn->prepare("DELETE FROM password_reset_requests WHERE user_id = ?");
        $stmt1->bind_param("i", $id);
        $stmt1->execute();
        $stmt1->close();

        // Prepare and execute the delete statement for the user table
        $stmt2 = $conn->prepare("DELETE FROM user WHERE id = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->close();

        // Commit the transaction
        $conn->commit();

        $_SESSION['success'] = "User deleted successfully.";
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        $_SESSION['error'] = "Error deleting user: " . $e->getMessage();
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}

$conn->close();

header('Location: ../dashboard/admin/home.php');
exit();
?>
