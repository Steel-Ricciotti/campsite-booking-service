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
    <title>Create Campsite</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <?php include '../includes/header.php'; ?>
   <section class="container my-5">
       <h2 class="text-center">Campbook Wiki</h2>
       <p>Welcome to the Campbook Wiki. Select a topic below to learn more about using the platform.</p>
       <ul class="list-group">
           <li class="list-group-item"><a href="registration.php">How to Register</a></li>
           <li class="list-group-item"><a href="booking.php">How to Book a Campsite</a></li>
           <li class="list-group-item"><a href="campsite_details.php">Viewing Campsite Details</a></li>
            <li class="list-group-item"><a href="profile.php">Managing Your Profile</a></li>
            <li class="list-group-item"><a href="admin.php">Admin</a></li>
        </ul>
    </section>
    <?php include '../includes/footer.php'; ?>
</body>
</html>