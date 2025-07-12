<?php
include 'includes/config.php';
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

    if ($user_id > 0) {
        // Delete user from the database
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "User deleted successfully!";
            header("Location: manage_users.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to delete user: " . $conn->error;
            header("Location: manage_users.php");
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid user ID.";
        header("Location: manage_users.php");
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: manage_users.php");
}


?>

<!-- This program allows an admin to delete a user -->