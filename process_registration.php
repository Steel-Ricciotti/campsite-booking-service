<?php

include 'includes/config.php';
session_start();

$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

 
    //Check if username or email already exists
    $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['error'] = "Username or email already exists.";
        header("Location: register.php");
        exit();
    }   
    // Insert new user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password_hash, email, role) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $username, $password_hash, $email);
    
    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';
        $_SESSION['success'] = "Registration successful!";
        // Redirect to the homepage and flash success message
        header("Location: index.php?success=Registration successful");
    } else {
        die('Registration failed: ' . $conn->error);
        $_SESSION['error'] = 'Registration failed: ' . $conn->error;
        // Redirect back to registration form with error message
        header("Location: register.php");
    }
    $stmt->close();
    $conn->close();
} else {
    die('Invalid request method.');
}

?>