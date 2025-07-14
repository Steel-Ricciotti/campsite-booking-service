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
    <title>Booking a Campsite</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <?php include '../includes/header.php'; ?>
   <section class="container my-5">
       <h2 class="text-center">Registering for Campbook</h2>
         <h3>To register, follow these steps:</h3>
        <ol>
            <li>Click "Register" in the navigation bar.</li>
            <li>Enter a unique username, valid email, and secure password.</li>
            <li>Click "Submit Registration" to create your account.</li>
            <li>Upon success, you’ll be redirected to the homepage and logged in.</li>
        </ol>
        <a href="index.php" class="btn btn-primary">Back to Wiki Home</a>
    </section>
    <?php include '../includes/footer.php'; ?>
</body>
</html>