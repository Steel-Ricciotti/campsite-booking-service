<?php
include 'includes/config.php';
session_start();


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
<?php include 'includes/footer.php'; ?>
</body>
</html>