<?php include 'includes/config.php';
session_start();


$query = "SELECT campsite_id, name, type, price, image_url FROM campsites WHERE featured = 1 LIMIT 3";
$result = mysqli_query($conn, $query);
$featured_campsites = mysqli_fetch_all($result, MYSQLI_ASSOC);
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
$success_message = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
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
<body>
    <body class="<?php echo htmlspecialchars($theme); ?>-theme">
         <?php include 'includes/header.php'; ?>

    <!-- Display success message if user successfully registers -->
         <?php if ($success_message): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

<section class="hero text-center text-white">
    <div class="container py-5">
        <h1>Plan Your Perfect Camping Adventure</h1>
        <p>Discover campsites, cabins, and activities at CampBook</p>
        <a href="booking_form.php" class="btn btn-primary btn-lg">Book Now</a>
    </div>
</section>


    <section class="container my-5">
        <h2 class="text-center">Featured Campsites</h2>
        <div class="row">
            <?php foreach ($featured_campsites as $campsite): ?>
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
    
    <!-- Interactive Map -->
    <section class="container my-5">
        <h2 class="text-center">Explore Our Campground</h2>
        <div id="map" style="height: 400px;"></div>
    </section>

    <!-- Videos -->
    <section class="container my-5">
        <h2 class="text-center">Take a Tour</h2>
        <div class="ratio ratio-16x9">
            <video controls>
                <source src="assets/videos/campground_tour.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>    


    <?php include 'includes/footer.php'; ?>


    <!-- <h1>Welcome to campsite-booking-service</h1>
    <p>Test page for campground booking site.</p> -->
</body>
</html>
