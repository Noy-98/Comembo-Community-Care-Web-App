<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
require_once __DIR__ . '../../db_con/conn.php'; // Adjust the path if necessary

// Handle form submission to update profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $fullname = $_POST['full_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile_number = $_POST['phone'];

    // Update user data in the database
    $sql_update = "UPDATE user SET full_name = ?, email = ?, mobile_number = ?, address = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssi", $fullname, $email, $mobile_number, $address, $user_id);
    if ($stmt_update->execute()) {
        $_SESSION['success'] = "Profile updated successfully.";
        header('Location: ../dashboard/admin/users-profile.php');
    } else {
        $_SESSION['error'] = "Error updating profile.";
        header('Location: ../dashboard/admin/users-profile.php');
    }
    $stmt_update->close();
}

$conn->close();

header('Location: ../dashboard/admin/users-profile.php');
exit();
?>
