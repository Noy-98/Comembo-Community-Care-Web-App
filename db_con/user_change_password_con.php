<?php
session_start();
require_once __DIR__ . '../../db_con/conn.php'; // Adjust the path if necessary

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form inputs
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['newpassword'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../dashboard/user/users-profile.php');
        exit();
    }

    if (strlen($new_password) < 6) {
        $_SESSION['error'] = 'Password must be at least 6 characters long.';
        header('Location: ../dashboard/user/users-profile.php');
        exit();
    }

    // Check if new password and confirm password match
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = 'New password and confirm password do not match.';
        header('Location: ../dashboard/user/users-profile.php');
        exit();
    }

    // Fetch the current password from the database
    $sql = "SELECT password FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the current password
        if (password_verify($current_password, $hashed_password)) {
            // Hash the new password
            $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the password in the database
            $update_sql = "UPDATE user SET password = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param('si', $new_hashed_password, $user_id);
            if ($update_stmt->execute()) {
                $_SESSION['success'] = 'Password changed successfully.';
            } else {
                $_SESSION['error'] = 'Failed to change password. Please try again.';
            }
            $update_stmt->close();
        } else {
            $_SESSION['error'] = 'Current password is incorrect.';
        }
    } else {
        $_SESSION['error'] = 'User not found.';
    }
    $stmt->close();
    header('Location: ../dashboard/user/users-profile.php');
    exit();
} else {
    $_SESSION['error'] = 'Invalid request method.';
    header('Location: ../dashboard/user/users-profile.php');
    exit();
}
?>
