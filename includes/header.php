<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php">Campbook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>campsites.php">Campsites</a>
                    </li>
                    <?php if (!isset($_SESSION['role'])): // Not logged in ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>register.php">Register</a>
                        </li>
                  <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>wiki/index.php">Help</a>
                    </li>                        
                    <?php elseif ($_SESSION['role'] === 'user'): // Logged in as user ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>booking_form.php">Book Now</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>booking_history.php">Booking History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>manage_settings.php">Settings</a>
                        </li>                          
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>logout.php">Logout</a>
                        </li>
                    <?php elseif ($_SESSION['role'] === 'admin'): // admin ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>manage_campsites.php">Manage Campsites</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>manage_users.php">Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>manage_settings.php">Settings</a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>logout.php">Logout</a>
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