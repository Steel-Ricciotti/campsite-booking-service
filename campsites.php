
<?php
include 'includes/config.php';
session_start();
$query = "SELECT campsite_id, name, type, price, image_url FROM campsites";
$result = mysqli_query($conn, $query);
$campsites = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <h2 class="text-center">Featured Campsites</h2>
        <div class="row">
            <?php foreach ($campsites as $campsite): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo 'assets/images/' . htmlspecialchars($campsite['image_url']); ?>" class="card-img-top fixed-height" alt="<?php echo htmlspecialchars($campsite['name']); ?>">
                        <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($campsite['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($campsite['type']); ?> - $<?php echo number_format($campsite['price'], 2); ?></p>
                            <a href="campsite_detail.php?id=<?php echo $campsite['campsite_id']; ?>" class="btn btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>    

<?php include 'includes/footer.php'; ?>
</body>
</html>