<?php
session_start();
require_once 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Form validation
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../signup.php');
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = 'Password must be at least 6 characters long.';
        header('Location: ../signup.php');
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: ../signup.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare an SQL statement
    $sql = "INSERT INTO user (full_name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("sss", $full_name, $email, $hashed_password);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Signup successful!';
            header('Location: ../login.php');
            exit();
        } else {
            $_SESSION['error'] = 'Error: ' . $stmt->error;
            header('Location: ../signup.php');
            exit();
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = 'Error: ' . $conn->error;
        header('Location: ../signup.php');
        exit();
    }

    $conn->close();
} else {
    $_SESSION['error'] = 'Invalid request method.';
    header('Location: ../signup.php');
    exit();
}
?>
