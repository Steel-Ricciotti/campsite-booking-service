<?php
include 'includes/config.php';
session_start();


$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['username']);
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Query user by username
    $stmt = $conn->prepare("SELECT user_id, username, password_hash, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Verify user and password
    $password_Correct = password_verify($password, $user['password_hash']);
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
}
$stmt->close();
$conn->close();
?>