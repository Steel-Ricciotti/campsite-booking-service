<!-- This program will take in the campsite_id and allow the user to edit that campsite. 
 There will be a process_edit_campsite program that will actually update the data. -->
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
// Initialize variables
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : '';
unset($_SESSION['error'], $_SESSION['success']);

// Fetch campsite data
$campsite_id = isset($_GET['campsite_id']) ? intval($_GET['campsite_id']) : 0;
$campsite = null;   
if ($campsite_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM campsites WHERE campsite_id = ?");
    $stmt->bind_param("i", $campsite_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $campsite = $result->fetch_assoc();
    } else {
        $_SESSION['error'] = "Campsite not found.";
        header("Location: manage_campsites.php");
        exit();
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid campsite ID.";
    header("Location: manage_campsites.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Campbook - Edit Campsite">
    <meta name="description" content="Edit campsite details at Campsite-Booking-Service.">
    <meta name="keywords" content="camping, campground booking, campsite management, campsite booking">
    <title>Campbook - Edit Campsite</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <?php include 'includes/header.php'; ?>

    <section class="container my-5">
        <h2 class="text-center">Edit Campsite</h2>

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

        <form action="process_edit_campsite.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded">
            <input type="hidden" name="campsite_id" value="<?php echo htmlspecialchars($campsite['campsite_id']); ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Campsite Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($campsite['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="tent" <?php echo $campsite['type'] === 'tent' ? 'selected' : ''; ?>>Tent</option>
                    <option value="cabin" <?php echo $campsite['type'] === 'cabin' ? 'selected' : ''; ?>>Cabin</option>
                    <option value="rv" <?php echo $campsite['type'] === 'rv' ? 'selected' : ''; ?>>RV</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Price per night</label>
                <input type="text" class="form-control" id="price_per_night" name="price_per_night" value="<?php echo htmlspecialchars($campsite['price']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="features" class="form-label">Options</label>
                <select multiple class="form-select" id="features" name="features[]">
                    <option value="firepit" <?php echo in_array('firepit', json_decode($campsite['options'], true)) ? 'selected' : ''; ?>>Firepit</option>
                    <option value="shaded" <?php echo in_array('shaded', json_decode($campsite['options'], true)) ? 'selected' : ''; ?>>Shaded</option>
                    <option value="pets_allowed" <?php echo in_array('pets_allowed', json_decode($campsite['options'], true)) ? 'selected' : ''; ?>>Pets Allowed</option>
                    <option value="AC" <?php echo in_array('AC', json_decode($campsite['options'], true)) ? 'options' : ''; ?>>AC</option>
                    <option value="kitchenette" <?php echo in_array('kitchenette', json_decode($campsite['options'], true)) ? 'selected' : ''; ?>>Kitchenette</option>
                    <option value="bathroom" <?php echo in_array('bathroom', json_decode($campsite['options'], true)) ? 'selected' : ''; ?>>Bathroom</option>
                    <option value="serviced" <?php echo in_array('serviced', json_decode($campsite['options'], true)) ? 'selected' : ''; ?>>Serviced</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Campsite Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                <small class="form-text text-muted">Leave blank to keep the current photo.</small>
            </div>
            <div class="mb-3 form-check">
                <label class="form-check-label" for="featured">Availability</label>
                <input type="text" class="form-label" id="availability" name="availability" value="<?php echo $campsite['availability']?>">

            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1" <?php echo $campsite['featured'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="featured">Featured Campsite</label>
            </div>
            <button type="submit" class="btn btn-primary">Update Campsite</button>
        </form>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>