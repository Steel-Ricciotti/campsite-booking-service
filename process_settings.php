<?php
// This program processes the updated settings for the campsite booking service
session_start();
include 'includes/config.php';
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_theme = isset($_POST['theme']) ? mysqli_real_escape_string($conn, $_POST['theme']) : '';

    if (in_array($new_theme, ['summer', 'winter', 'autumn', 'spring'])) {
        // Update session variable
        $_SESSION['theme'] = $new_theme;
        $theme = $new_theme;

        // Optionally, you can save the theme to the database if needed
        // $stmt = $conn->prepare("UPDATE users SET theme = ? WHERE user_id = ?");
        // $stmt->bind_param("si", $new_theme, $_SESSION['user_id']);
        // $stmt->execute();
        // $stmt->close();

        $_SESSION['success'] = "Settings updated successfully!";
        header  ("Location: manage_settings.php?success=Settings updated successfully");
        exit();
    } else {
        $_SESSION['error'] = "Invalid theme selected.";
        header  ("Location: manage_settings.php?error=Failed to update settings");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
}
?>