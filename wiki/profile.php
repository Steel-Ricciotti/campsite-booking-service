<?php
session_start();
include '../includes/config.php';
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <?php include '../includes/header.php'; ?>
   <section class="container my-5">
       <h2 class="text-center">This page describes how to access and manage your Campbook profile.</h2>
         <h3>Steps to Manage Profile:</h3>
        <ol>
            <li>Log in to your account.</li>
            <li>Click "Profile" in the navigation bar (visible when logged in).</li>
            <li>View or update your profile information (e.g., email, username, password).</li>
            <li>Click "Booking History" to see past and upcoming bookings.</li>
        </ol>
        <a href="index.php" class="btn btn-primary">Back to Wiki Home</a>
    </section>
    <?php include '../includes/footer.php'; ?>
</body>
</html>