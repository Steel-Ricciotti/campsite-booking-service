<?php
include 'includes/config.php';
session_start();
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'summer';
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
//This file is used to allow an admin to manage users, including viewing, editing, and deleting user accounts.
//It will display a list of users and provide options for each user to edit or delete their
//account. The admin can also add new users.
//The admin can also change the theme of the application.   

    // Query all users from the database
    $stmt = $conn->prepare("SELECT user_id, username, role FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();



?>
<!-- this file is used to allow an admin to manage users, including viewing, editing, and deleting user accounts. -->

<!DOCTYPE html>
<html lang="en">   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Campbook- Manage Users">
    <meta name="description" content="Admin panel to manage user accounts at Campsite-Booking-Service.">
    <meta name="keywords" content="admin, user management, campsite booking, campground booking">
    <title>Campbook - Manage Users</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>-theme">

    <?php include 'includes/header.php'; ?>

    <section class="container my-5">
        <h2 class="text-center">Manage Users</h2>

        <!-- Display error message if any -->
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td>
                            <!-- Edit and Delete actions -->
                            <a href="edit_user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Button to add new user -->
        <a href="create_user.php" class="btn btn-primary">Add New User</a>

    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>

