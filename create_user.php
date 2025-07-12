<?php
include 'includes/config.php';
session_start();

$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- SE0 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Campbook- Plan Your Camping Adventure">
    <meta name="description" content="Book campsites, cabins, and activities at Campsite-Booking-Service. ">
    <meta name="keywords" content="camping, campground booking, outdoor activities, nature travel">
    <title>Campbook</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <?php include 'includes/header.php'; ?>

    <section class="container my-5">

        <!--Error message display if registration fails-->
                <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form id="registrationForm" action="process_registration.php" method="POST" class="p-4 border rounded">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>            
            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </section>
    
<?php include 'includes/footer.php'; ?>
</body>
</html>