<!-- This program will receive all the data captured in create_campsite.php and will upload the file and save the new campsite data to the DB.
 It will return a success message and return to the manage_campsites page once completed -->
<?php
session_start();
include 'includes/config.php';
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
// Check if user is logged in and has the correct role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin')
{
    $_SESSION['error'] = "You must be an admin to create a campsite.";
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $price_per_night = mysqli_real_escape_string($conn, $_POST['price_per_night']);
    // Parse the features attribute from the form. Can be multiple values. Needs to look like this {"firepit": true, "shaded": true}
    $features = isset($_POST['features']) ? json_encode($_POST['features']) : '{}';
    $featured   = isset($_POST['featured']) ? 1 : 0;

    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_name = basename($_FILES['photo']['name']);
        $upload_dir = 'assets/images/';
        $file_path = $upload_dir . $file_name;

        // Ensure the upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insert new campsite into the database
            $stmt = $conn->prepare("INSERT INTO campsites (name,  type, options, price,availability, image_url, featured) VALUES (?, ?, ?, ?,'available',?,?)"); //Default new campsites to available.
            $stmt->bind_param("ssssss", $name, $type,$features, $price_per_night, $file_name, $features);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Campsite created successfully!";
                header("Location: manage_campsites.php");
                exit();
            } else {
                $_SESSION['error'] = "Failed to create campsite: " . $conn->error;
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Failed to upload photo.";
        }
    } else {
        $_SESSION['error'] = "No photo uploaded or upload error.";
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
}
$conn->close();
header("Location: create_campsite.php?error=" . urlencode($_SESSION['error']
));
// Redirect back to create campsite form with error message
exit();
?>