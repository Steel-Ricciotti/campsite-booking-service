<?php
include 'includes/config.php';
session_start();

$query = "SELECT campsite_id, name, type, price FROM campsites";
$result = mysqli_query($conn, $query);
$campsites = mysqli_fetch_all($result, MYSQLI_ASSOC);
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
$campsite_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
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
        <h2 class="text-center">Book Your Campsite</h2>
        <form id="bookingForm" action="process_booking.php" method="POST" class="p-4 border rounded">
            <div class="mb-3">
                <label for="campsite" class="form-label">Select Campsite</label>
                <select class="form-select" id="campsite" name="campsite_id" required>
                    <option value="">Choose a campsite</option>
                    <?php 
                    // Parse campsite ID from URL
                    $campsite_id = isset($_GET['campsite_id']) ? (int)$_GET['campsite_id'] : 0;
                    foreach ($campsites as $campsite): ?>
                        <option value="<?php echo $campsite['campsite_id']; ?>" 
                                data-price="<?php echo $campsite['price']; ?>" 
                                <?php echo $campsite['campsite_id'] == $campsite_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($campsite['campsite_id'] . $campsite['name'] . ' (' . $campsite['type'] . ') - $' . number_format($campsite['price'], 2)); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="checkin" class="form-label">Check-in Date</label>
                <input type="date" class="form-control" id="checkin" name="checkin" required>
            </div>
            <div class="mb-3">
                <label for="checkout" class="form-label">Check-out Date</label>
                <input type="date" class="form-control" id="checkout" name="checkout" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Additional Options</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="tent" name="options[]" value="tent" data-price="20">
                    <label class="form-check-label" for="tent">Tent Rental ($20)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gear" name="options[]" value="gear" data-price="15">
                    <label class="form-check-label" for="gear">Camping Gear ($15)</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Total Price: <span id="totalPrice">$0.00</span></label>
            </div>
            <button type="submit" class="btn btn-primary">Submit Booking</button>
        </form>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script>
        document.getElementById('bookingForm').addEventListener('change', function() {
            const campsiteSelect = document.getElementById('campsite');
            const checkin = document.getElementById('checkin').value;
            const checkout = document.getElementById('checkout').value;
            const options = document.querySelectorAll('input[name="options[]"]:checked');
            let total = 0;

            // Base campsite price
            const selectedOption = campsiteSelect.options[campsiteSelect.selectedIndex];
            if (selectedOption) {
                total += parseFloat(selectedOption.getAttribute('data-price') || 0);
            }

            // Additional options
            options.forEach(option => {
                total += parseFloat(option.getAttribute('data-price') || 0);
            });

            // Calculate days
            if (checkin && checkout) {
                const checkinDate = new Date(checkin);
                const checkoutDate = new Date(checkout);
                const days = (checkoutDate - checkinDate) / (1000 * 60 * 60 * 24);
                if (days > 0) total *= days;
            }

            document.getElementById('totalPrice').textContent = '$' + total.toFixed(2);
        });
    </script>
</body>
</html>