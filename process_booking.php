<?php
session_start();
include 'includes/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campsite_id = isset($_POST['campsite_id']) ? intval($_POST['campsite_id']) : 0;
    $start_date = isset($_POST['start_date']) ? mysqli_real_escape_string($conn, $_POST['start_date']) : '';
    $end_date = isset($_POST['end_date']) ? mysqli_real_escape_string($conn, $_POST['end_date']) : '';
    $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
    $tent = isset($_POST['tent']) ? 1 : 0;
    $gear = isset($_POST['gear']) ? 1 : 0;

    if ($campsite_id > 0 && !empty($start_date) && !empty($end_date) && $user_id > 0) {
        // Insert booking into the database
        $stmt = $conn->prepare("INSERT INTO booking (campsite_id, user_id, checkin, checkout, tent_rental,camping_gear) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiss", $campsite_id, $user_id, $start_date, $end_date, $tent, $gear);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Booking successful!";
            header("Location: booking_history.php");
            exit();
        } else {
            $_SESSION['error'] = "Booking failed: " . $conn->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid booking details.";
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
}
$conn->close();
header("Location: booking_form.php?error=" . urlencode($_SESSION['error']));    
// Redirect back to booking form with error message
exit();

?>