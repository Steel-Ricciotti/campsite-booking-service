<?php
session_start();
include 'includes/config.php';
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : '';

$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
// Fetch all campsites from the database
$stmt = $conn->prepare("SELECT * FROM campsites");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $error_message = "No campsites found.";
}
$stmt->close();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campsite_id = isset($_POST['campsite_id']) ? intval($_POST['campsite_id']) : 0;
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $location = isset($_POST['location']) ? mysqli_real_escape_string($conn, $_POST['location']) : '';

    if ($campsite_id > 0 && !empty($name) && !empty($location)) {
        // Update campsite details
        $stmt = $conn->prepare("UPDATE campsites SET name = ?, location = ? WHERE campsite_id = ?");
        $stmt->bind_param("ssi", $name, $location, $campsite_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Campsite updated successfully!";
            header("Location: manage_campsites.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to update campsite: " . $conn->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid campsite details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Campbook - Edit User">
    <meta name="description" content="Edit user details at Campsite-Booking-Service.">
    <meta name="keywords" content="camping, campground booking, user management, campsite booking">
    <title>Campbook - Edit User</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <!-- This page allows an admin to manage the campsites. Full CRUD on the campsite table in the DB -->
    <?php include 'includes/header.php'; ?>
    <section class="container my-5">
        <h2 class="text-center">Manage Campsites</h2>

        <!-- Display error message if any -->
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <!-- Flash a success message if any -->
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Campsite ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($campsite = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($campsite['campsite_id']); ?></td>
                        <td><?php echo htmlspecialchars($campsite['name']); ?></td>
                        <td><?php echo htmlspecialchars($campsite['type']); ?></td>
                        <td><?php echo htmlspecialchars($campsite['price']); ?></td>
                        <td><?php echo htmlspecialchars($campsite['image_url']); ?></td>
                        <td>
                            <!-- Edit and Delete actions -->
                            <a href="edit_campsite.php?campsite_id=<?php echo $campsite['campsite_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_campsite.php?campsite_id=<?php echo $campsite['campsite_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Button to add new campsite -->
        <a href="create_campsite.php" class="btn btn-primary">Add New Campsite</a>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
