<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: rgba(101, 0, 37, 0.9);">
    <a class="navbar-brand" href="dashboard.php">Servify</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item <?php echo ($current_page == 'form_booking.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="form_booking.php">Booking</a>
            </li>
        </ul>
    </div>
</nav>
<style>
    body {
        margin-top: 70px;
    }
</style>
