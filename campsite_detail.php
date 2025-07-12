
<?php
include 'includes/config.php';
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
$campsite_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$output = $conn->prepare("SELECT campsite_id, name, type, options, price, availability, image_url FROM campsites WHERE campsite_id = ?");
$output->bind_param("i", $campsite_id);
$output->execute();
$result = $output->get_result();
if ($result->num_rows > 0) {
    $campsite = $result->fetch_assoc();
    // Decode options JSON if present
    $options = [];
    if (!empty($campsite['options'])) {
        $decoded = json_decode($campsite['options'], true);
        if (is_array($decoded)) {
            $options = $decoded;
        }
    }
} else {
    die('Campsite not found.');
}

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
        <h2 class="text-center"><?php echo htmlspecialchars($campsite['name']); ?></h2>
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo "assets/images/" . htmlspecialchars($campsite['image_url']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($campsite['name']); ?>">
            </div>
            <div class="col-md-6">
                <h4>Type: <?php echo htmlspecialchars($campsite['type']); ?></h4>
                <p><strong>Price:</strong> $<?php echo number_format($campsite['price'], 2); ?> / night</p>
                <p><strong>Type:</strong> $<?php echo htmlspecialchars($campsite['type']); ?> </p>
                <p><strong>Availability:</strong> <?php echo htmlspecialchars($campsite['availability']); ?></p>
                <p><strong>Options:</strong></p>
                <ul>
                    <?php if ($options && is_array($options)): ?>
                        <?php foreach ($options as $key => $value): ?>
                            <li><?php echo htmlspecialchars("$key"); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No options available.</li>
                    <?php endif; ?>
                </ul>                
                <p><strong>Description:</strong> <?php echo htmlspecialchars($campsite['description'] ?? 'No description available.'); ?></p>
                <a href="booking_form.php?campsite_id=<?php echo $campsite['campsite_id']; ?>" class="btn btn-primary">Book Now</a>
            </div>
        </div>
    </section>  

<?php include 'includes/footer.php'; ?>
</body>
</html>