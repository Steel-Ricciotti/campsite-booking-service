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
        <!--Error message display if login fails-->
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

    <section class="container my-5">
        <h2 class="text-center">Register</h2>
        <form id="loginForm" action="process_login.php" method="POST" class="p-4 border rounded">
            <div class="mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="string" class="form-control" id="username" name="username" required>
            </div>    
            <div class="mb-3">
                <label for="Username" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>            
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </section>
    
<?php include 'includes/footer.php'; ?>
</body>
</html>