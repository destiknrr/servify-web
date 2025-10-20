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
            <div class="col-12">
                <div class="card-promotion text-center">
                    <h2 class="font-weight-bold">Laptop Bermasalah? Servify Siap Membantu!</h2>
                    <p class="lead">Jangan biarkan laptop rusak mengganggu aktivitas Anda. Tim profesional kami siap membantu untuk perbaikan cepat dan terpercaya.</p>
                    <a href="form_booking.php" class="btn btn-primary btn-lg cta-button">+ Ajukan Servis Sekarang</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <h2 class="card-title">Riwayat Servis Anda</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Booking</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Jadwal Kunjungan</th>
                                        <th>Deskripsi Kerusakan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($bookings)): ?>
                                        <?php foreach (array_reverse($bookings) as $booking): ?>
                                            <?php
                                                // Ekstrak tanggal dari ticket_number (format: LAPT-YYYYMMDDXXXX)
                                                $submissionDate = 'N/A';
                                                if (preg_match('/LAPT-(\d{4})(\d{2})(\d{2})/', $booking['ticket_number'], $matches)) {
                                                    $submissionDate = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
                                                }
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($booking['ticket_number']); ?></td>
                                                <td><?php echo $submissionDate; ?></td>
                                                <td><?php echo htmlspecialchars($booking['service_date'] . ' (' . $booking['visit_time'] . ')'); ?></td>
                                                <td><?php echo htmlspecialchars($booking['damage_description']); ?></td>
                                                <td><span class="badge badge-info"><?php echo htmlspecialchars($booking['status']); ?></span></td>
                                                <td>
                                                    <a href="status.php?ticket=<?php echo htmlspecialchars($booking['ticket_number']); ?>" class="btn btn-sm btn-info">Lihat Detail</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Anda belum pernah mengajukan servis.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
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
