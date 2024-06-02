<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}
require_once __DIR__ . '/conn.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_name = $_POST['event_name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $subject = $_POST['subject'];
    
    // Handle file upload
    if (isset($_FILES['image_upload']) && $_FILES['image_upload']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image_upload']['tmp_name'];
        $fileName = $_FILES['image_upload']['name'];
        $fileSize = $_FILES['image_upload']['size'];
        $fileType = $_FILES['image_upload']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Sanitize file name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Check if the file extension is allowed
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Directory where the file will be moved
            $uploadFileDir = '../uploads/admin/post/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $image_upload = $dest_path;
                
                // Prepare an SQL statement
                $sql = "INSERT INTO event_barangay_post (event_name, image_upload, date, time, subject) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $file_path_db = str_replace('../', '../../', $image_upload);
                    $stmt->bind_param("sssss", $event_name, $file_path_db, $date, $time, $subject);
                    
                    if ($stmt->execute()) {
                        $_SESSION['success'] = 'Post Added successfully!';
                        header('Location: ../dashboard/admin/event_barangay_post.php');
                    } else {
                        $_SESSION['error'] = 'Error: ' . $stmt->error;
                        header('Location: ../dashboard/admin/event_barangay_post.php');
                    }
                    
                    $stmt->close();
                } else {
                    $_SESSION['error'] = 'Error: ' . $conn->error;
                    header('Location: ../dashboard/admin/event_barangay_post.php');
                }

                $conn->close();
            } else {
                $_SESSION['error'] = 'Error moving the uploaded file';
                header('Location: ../dashboard/admin/event_barangay_post.php');
            }
        } else {
            $_SESSION['error'] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            header('Location: ../dashboard/admin/event_barangay_post.php');
        }
    } else {
        $_SESSION['error'] = 'There was some error with the file upload';
        header('Location: ../dashboard/admin/event_barangay_post.php');
    }
} else {
    $_SESSION['error'] = 'Invalid request method.';
    header('Location: ../dashboard/admin/event_barangay_post.php');
}
?>
