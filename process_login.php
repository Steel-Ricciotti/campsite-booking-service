<?php
include 'includes/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Username and password are required.';
        header("Location: login.php");
        exit;
    }

    // Query user by username
    $stmt = $conn->prepare("SELECT user_id, username, password_hash, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Verify user and password
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php?success=Login successful");
        exit;
    } else {
        $_SESSION['error'] = 'Invalid username or password.';
        header("Location: login.php");
        exit;
    }
} else {
    $_SESSION['error'] = 'Invalid request method.';
    header("Location: login.php");
    exit;
}
$conn->close();
?>