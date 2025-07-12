<!-- This page will contain the form used to collect all the user input to create a new campsite as well us upload a photo
 the processing of the data will be handled in process_create_campsite.php -->
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
// Initialize variables
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : '';
unset($_SESSION['error'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Campsite</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <?php include 'includes/header.php'; ?>

    <section class="container my-5">
        <h2 class="text-center">Create Campsite</h2>

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

        <form action="process_create_campsite.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded">
            <div class="mb-3">
                <label for="name" class="form-label">Campsite Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <!-- Single select options either tent, rv, or cabin -->
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="tent">Tent</option>
                    <option value="cabin">Cabin</option>
                    <option value="rv">RV</option>
                </select>
            </div>
     
            <div class="mb-3">
                <label for="features" class="form-label">Options</label>
                <select multiple class="form-select" id="features" name="features[]" required>
                    <option value="firepit">Firepit</option>
                    <option value="shaded">Shaded</option>
                    <option value="pets_allowed">Pets Allowed</option>
                    <option value="AC">AC</option>
                    <option value="kitchenette">Kitchenette</option>
                    <option value="bathroom">Bathroom</option>
                    <option value="serviced">Serviced</option>
                </select>
            </div>
            <!--  -->
            <div class="mb-3">
                <label for="type" class="form-label">Price per night</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Campsite Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1">
                <label class="form-check-label" for="featured">Featured Campsite</label>
            </div>

            <button type="submit" class="btn btn-primary">Create Campsite</button>
        </form>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>