<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Campbook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="campsites.php">Campsites</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li> -->
                    <?php if (!isset($_SESSION['role'])): // Not logged in ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php elseif ($_SESSION['role'] === 'user'): // Logged in as user ?>
                        <li class="nav-item">
                            <a class="nav-link" href="booking_form.php">Book Now</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="booking_history.php">Booking History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_settings.php">Settings</a>
                        </li>                          
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php elseif ($_SESSION['role'] === 'admin'): // Logged in as admin ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_dashboard.php">Admin Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_campsites.php">Manage Campsites</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_users.php">Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_settings.php">Settings</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php endif; ?>    
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="alert alert-info text-center" role="alert">
            Welcome to Campbook! Plan your perfect camping adventure with us.
        </div>

</header>