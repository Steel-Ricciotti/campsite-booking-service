<!-- This program saves the updated user information from edit_user.php-->
<?php
include 'includes/config.php';
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    
    // Validate input
    if (empty($username) || empty($email)) {
        $_SESSION['error'] = "Username and email cannot be empty.";
        header("Location: edit_user.php");
        exit();
    }

    // Update user information in the database
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE user_id = ?");
    $stmt->bind_param("sssi", $username, $email, $role, $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User information updated successfully!";
        // Clear the error message if it exists
        unset($_SESSION['error']);
        header("Location: manage_users.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update user information: " . $conn->error;
        unset($_SESSION['success']);
        header("Location: manage_users.php");
        exit();
    }
    
    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: edit_user.php");
}
$conn->close();
?>