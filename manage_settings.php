<?php
// This file is used to manage settings for the campsite booking service
session_start();
include 'includes/config.php';
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : '';

// Clear messages after displaying
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
}

?>
<!-- This program allows the user to change the theme for the campsite booking service -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Campbook - Manage Settings">
    <meta name="description" content="Manage settings for the Campsite Booking Service.">
    <meta name="keywords" content="settings, theme, campsite booking, campground booking">
    <title>Campbook - Manage Settings</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <?php include 'includes/header.php'; ?>

    <section class="container my-5">
        <h2 class="text-center">Manage Settings</h2>

        <!-- Display error message if any -->
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <!-- Display success message if any -->
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <form id="settingsForm" action="process_settings.php" method="POST" class="p-4 border rounded">
            <div class="mb-3">
                <label for="theme" class="form-label">Select Theme</label>
                <select class="form-select" id="theme" name="theme">
                    <option value="summer" <?php echo $theme === 'summer' ? 'selected' : ''; ?>>Summer</option>
                    <option value="winter" <?php echo $theme === 'winter' ? 'selected' : ''; ?>>Winter</option>
                    <option value="autumn" <?php echo $theme === 'autumn' ? 'selected' : ''; ?>>Autumn</option>
                    <option value="spring" <?php echo $theme === 'spring' ? 'selected' : ''; ?>>Spring</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
