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
       <h2 class="text-center">Booking a Campsite</h2>
         <h3>To book a campsite, follow these steps:</h3>
        <ol>
            <li>Navigate to the <a href="<?php echo BASE_URL; ?>booking_form.php">Booking Form</a>.</li>
            <li>Select a campsite from the dropdown.</li>
            <li>Choose check-in and check-out dates.</li>
            <li>Optionally select tent rental or camping gear.</li>
            <li>Review the total price and click "Submit Booking".</li>
        </ol>
        <a href="index.php" class="btn btn-primary">Back to Wiki Home</a>
    </section>
    <?php include '../includes/footer.php'; ?>
</body>
</html>