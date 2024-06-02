<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'user') {
    header('Location: ../login.php');
    exit();
}

require_once __DIR__ . '../../db_con/conn.php'; // Adjust the path if necessary

// Initialize error array
$errors = [];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $event_name = trim($_POST['event_name']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $address = trim($_POST['address']);
    $age = trim($_POST['age']);
    $category = trim($_POST['category']);


    // Check if there are no errors
    if (empty($errors)) {
        // Prepare an insert statement
        $stmt = $conn->prepare("INSERT INTO event_reg (event_name, event_f_name, event_l_name, event_email, event_m_number, event_address, event_age, event_category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $event_name, $first_name, $last_name, $email, $phone_number, $address, $age, $category);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful!";
            header('Location: ../dashboard/user/event_registration.php');
            exit();
        } else {
            $errors[] = "Database error: Could not register.";
        }

        // Close statement
        $stmt->close();
    } else {
        $_SESSION['error'] = implode('<br>', $errors);
        header('Location: ../dashboard/user/event_registration.php');
        exit();
    }
}

// Close connection
$conn->close();
?>
