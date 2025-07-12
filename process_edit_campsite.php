<!-- This program processes the data passed in from edit_campsite.php
 and updates the campsite record in the db then returns to the edit_campsite.php page.-->
<?php
session_start();    
include 'includes/config.php';
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
// Check if user is logged in and has the correct role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin')
{
    $_SESSION['error'] = "You must be an admin to edit a campsite.";
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campsite_id = isset($_POST['campsite_id']) ? intval($_POST['campsite_id']) : 0;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $price_per_night = mysqli_real_escape_string($conn, $_POST['price_per_night']);
    $options = isset($_POST['options']) ? json_encode($_POST['options']) : '{}';
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);
    $featured = isset($_POST['featured']) ? 1 : 0;
    // File upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error']==UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_name = basename($_FILES['photo']['name']);
    $upload_dir = 'assets/images/';
    $file_path = $upload_dir . $file_name;
       if (move_uploaded_file($file_tmp, $file_path)) {
        // Update campsite in the database
        $stmt = $conn->prepare("UPDATE campsites SET name=?, type=?, options=?, price=?, availability=?, image_url=?, featured=? WHERE campsite_id=?");
        $stmt->bind_param("ssssssii", $name, $type, $options, $price_per_night, $availability, $file_name, $featured, $campsite_id);
        } else {
        $_SESSION['error'] = "Failed to upload photo.";
        header("Location: edit_campsite.php?campsite_id=".urlencode($campsite_id));
        exit();
        }
    } else {
        // Update campsite without changing the photo
        $stmt = $conn->prepare("UPDATE campsites SET name=?,type=?,options=?,price=?,availability=?,featured=? WHERE campsite_id=?");
        $stmt->bind_param("ssssiii", $name, $type, $options,$price_per_night,$availability,$featured, $campsite_id);
    }
    if ($stmt->execute()) {
        $_SESSION['success'] = "Campsite updated successfully!";
            header("Location: manage_campsites.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update campsite: " . $conn->error;
        header("Location: edit_campsite.php?campsite_id=" . urlencode($campsite_id));
        exit();
    }
$stmt->close();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: manage_campsites.php");
    exit();
}
$conn->close();
?>