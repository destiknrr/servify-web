<?php
$bookings = [];
if (file_exists('data/bookings.json')) {
    $bookings = json_decode(file_get_contents('data/bookings.json'), true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Servify</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title">Dashboard</h2>
                        <a href="index.php" class="btn btn-primary mb-3">Tambah Booking Baru</a>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Ticket Number</th>
                                    <th>Customer Name</th>
                                    <th>Laptop Brand</th>
                                    <th>Service Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bookings)): ?>
                                    <?php foreach (array_reverse($bookings) as $booking): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($booking['ticket_number']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['laptop_brand']); ?></td>
                                            <td><?php echo htmlspecialchars($booking['service_date']); ?></td>
                                            <td><span class="badge badge-info"><?php echo htmlspecialchars($booking['status']); ?></span></td>
                                            <td>
                                                <a href="status.php?ticket=<?php echo htmlspecialchars($booking['ticket_number']); ?>" class="btn btn-sm btn-info">View</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No bookings found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
