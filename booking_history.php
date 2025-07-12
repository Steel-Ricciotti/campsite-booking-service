<!-- This page displays a users booking history by querying the booking table based on the user id-->

 <?php
include 'includes/config.php';
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
//  booking history for the user
$stmt = $conn->prepare("SELECT b.booking_id, c.name AS campsite_name, b.checkin, b.checkout, b.tent_rental, b.camping_gear FROM booking b JOIN campsites c ON b.campsite_id = c.campsite_id WHERE b.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head> 
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <?php include 'includes/header.php'; ?>

    <section class="container my-5">
        <h2 class="text-center">Your Booking History</h2>
        <!-- Display error message if any -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success']); ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Campsite Name</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Tent Rental</th>
                    <th>Camping Gear</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['booking_id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['campsite_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['checkin']); ?></td>
                        <td><?php echo htmlspecialchars($booking['checkout']); ?></td>
                        <td><?php echo htmlspecialchars($booking['tent_rental'] ? 'Yes' : 'No'); ?></td>
                        <td><?php echo htmlspecialchars($booking['camping_gear'] ? 'Yes' : 'No'); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php if ($result->num_rows == 0): ?>
            <p class="text-center">No bookings found.</p>
        <?php endif; ?>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>