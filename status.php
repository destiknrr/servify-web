<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket_number = isset($_POST['ticket']) ? $_POST['ticket'] : '';
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if (!empty($ticket_number) && !empty($action) && file_exists('data/bookings.json')) {
        $bookings = json_decode(file_get_contents('data/bookings.json'), true);
        foreach ($bookings as &$booking) {
            if ($booking['ticket_number'] === $ticket_number) {
                if ($action === 'approve') {
                    $booking['status'] = 'Proses Pengerjaan';
                } elseif ($action === 'reject') {
                    $booking['status'] = 'Dibatalkan';
                }
                break;
            }
        }
        file_put_contents('data/bookings.json', json_encode($bookings, JSON_PRETTY_PRINT));
        header('Location: status.php?ticket=' . $ticket_number);
        exit;
    }
}

$ticket_number = isset($_GET['ticket']) ? $_GET['ticket'] : '';
$booking_data = null;

if (!empty($ticket_number) && file_exists('data/bookings.json')) {
    $bookings = json_decode(file_get_contents('data/bookings.json'), true);
    foreach ($bookings as $booking) {
        if ($booking['ticket_number'] === $ticket_number) {
            $booking_data = $booking;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Servis Laptop Anda</title>
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
            <div class="col-md-8 offset-md-2">
                <div class="card mt-5">
                    <div class="card-body">
                        <?php if ($booking_data): ?>
                            <h2 class="card-title text-center">Status Servis Laptop Anda</h2>
                            <p class="text-center">Nomor Tiket: <strong><?php echo htmlspecialchars($booking_data['ticket_number']); ?></strong></p>

                            <div class="progress my-4">
                                <?php
                                $statuses = ['Booking Diajukan', 'Sedang Dicek Teknisi', 'Menunggu Persetujuan Harga', 'Proses Pengerjaan', 'Siap Diambil'];
                                $current_status_index = array_search($booking_data['status'], $statuses);
                                $progress_percentage = ($current_status_index + 1) / count($statuses) * 100;
                                ?>
                                <div class="progress-bar" role="progressbar" style="width: <?php echo $progress_percentage; ?>%;" aria-valuenow="<?php echo $progress_percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo htmlspecialchars($booking_data['status']); ?></div>
                            </div>

                            <hr>
                            <h5>Ringkasan Pengajuan Anda</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nama Pelanggan:</strong><br><?php echo htmlspecialchars($booking_data['customer_name']); ?></p>
                                    <p><strong>Nomor HP:</strong><br><?php echo htmlspecialchars($booking_data['customer_phone']); ?></p>
                                    <p><strong>Alamat:</strong><br><?php echo htmlspecialchars($booking_data['customer_address']); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Merk & Model Laptop:</strong><br><?php echo htmlspecialchars($booking_data['laptop_brand']); ?></p>
                                    <p><strong>Deskripsi Kerusakan:</strong><br><?php echo htmlspecialchars($booking_data['damage_description']); ?></p>
                                    <p><strong>Jadwal Kunjungan:</strong><br><?php echo htmlspecialchars($booking_data['service_date']); ?> (<?php echo htmlspecialchars($booking_data['visit_time']); ?>)</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Detail Diagnosis Teknisi</h5>
                                    <p><?php echo !empty($booking_data['diagnosis']) ? htmlspecialchars($booking_data['diagnosis']) : '-'; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h5>Estimasi Waktu Selesai</h5>
                                    <p><?php echo !empty($booking_data['estimated_completion']) ? htmlspecialchars($booking_data['estimated_completion']) : '-'; ?></p>
                                </div>
                            </div>

                            <hr>

                            <h5>Rincian Biaya Servis</h5>
                            <p><?php echo !empty($booking_data['service_cost']) ? htmlspecialchars($booking_data['service_cost']) : '-'; ?></p>

                            <hr>

                            <h4 class="text-right">TOTAL HARGA: <?php echo !empty($booking_data['total_price']) ? htmlspecialchars($booking_data['total_price']) : '-'; ?></h4>

                            <div class="mt-4 text-center">
                                <form method="POST" action="status.php">
                                    <input type="hidden" name="ticket" value="<?php echo htmlspecialchars($booking_data['ticket_number']); ?>">
                                    <button type="submit" name="action" value="approve" class="btn btn-success my-2">SAYA SETUJU & LANJUTKAN PROSES SERVIS</button>
                                    <button type="submit" name="action" value="reject" class="btn btn-danger my-2">TOLAK & AMBIL KEMBALI LAPTOP</button>
                                </form>
                            </div> 

                        <?php else: ?>
                            <h2 class="card-title text-center">Tiket Tidak Ditemukan</h2>
                            <p class="text-center">Maaf, nomor tiket yang Anda masukkan tidak valid.</p>
                        <?php endif; ?>
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
