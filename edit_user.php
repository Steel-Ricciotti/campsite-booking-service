<?php

include 'includes/config.php';
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : '';
// Fetch user details for editing
if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $stmt = $conn->prepare("SELECT user_id, username, email, role FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $_SESSION['error'] = "User not found.";
        header("Location: manage_users.php");
        exit();
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Invalid user ID.";
    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Campbook - Edit User">
    <meta name="description" content="Edit user details at Campsite-Booking-Service.">
    <meta name="keywords" content="camping, campground booking, user management, campsite booking">
    <title>Campbook - Edit User</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">
    <?php include 'includes/header.php'; ?>

    <section class="container my-5">
        <h2 class="text-center">Edit User</h2>



        <form action="process_edit_user.php" method="POST" class="p-4 border rounded">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <!-- Checkbox that allows a user to select either user or admin -->
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                    <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>      
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>