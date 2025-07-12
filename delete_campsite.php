<!-- This program parses the campsite_id and deletes that record from the campsite table 
 and returns to the manage_campsite.php page -->
<?php
session_start();
include 'includes/config.php';
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
// Check if user is logged in and has the correct role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "You must be an admin to delete a campsite.";
    header("Location: index.php");
    exit();
}
if (isset($_GET['campsite_id'])) {
    $campsite_id = intval($_GET['campsite_id']);

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM campsites WHERE campsite_id = ?");
    $stmt->bind_param("i", $campsite_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Campsite deleted successfully!";
    } else {
        $_SESSION['error'] = "Failed to delete campsite: " . $conn->error;
    }
    
    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid request.";
}
$conn->close();
header("Location: manage_campsites.php");
exit();
?>