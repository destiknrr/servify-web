<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servify - Booking Service Laptop</title>
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
                        <h2 class="card-title text-center">Pesan Jadwal Servis Laptop Anda</h2>
                        <form id="booking-form" action="booking.php" method="post" enctype="multipart/form-data">
                            <!-- Step 1: Jadwal Kunjungan -->
                            <div id="step-1" class="form-step">
                                <h4>Langkah 1 dari 4: Pilih Jadwal Kunjungan</h4>
                                <div class="form-group">
                                    <label for="service-date">Pilih Tanggal Servis</label>
                                    <input type="date" class="form-control" id="service-date" name="service_date" required>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Estimasi Waktu Kunjungan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="visit_time" id="time-pagi" value="09:00-12:00" required>
                                        <label class="form-check-label" for="time-pagi">Pagi (09:00-12:00)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="visit_time" id="time-siang" value="13:00-16:00">
                                        <label class="form-check-label" for="time-siang">Siang (13:00-16:00)</label>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary next-step">Lanjut ke Detail Kerusakan</button>
                            </div>

                            <!-- Step 2: Detail Laptop & Kerusakan -->
                            <div id="step-2" class="form-step" style="display: none;">
                                <h4>Langkah 2 dari 4: Detail Laptop & Kerusakan</h4>
                                <div class="form-group">
                                    <label for="laptop-brand">Merk & Model Laptop</label>
                                    <input type="text" class="form-control" id="laptop-brand" name="laptop_brand" required>
                                </div>
                                <div class="form-group">
                                    <label for="damage-description">Deskripsi Kerusakan Singkat</label>
                                    <textarea class="form-control" id="damage-description" name="damage_description" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="laptop-photos">Unggah Foto Laptop yang Rusak (Maks. 3)</label>
                                    <input type="file" class="form-control-file" id="laptop-photos" name="laptop_photos[]" multiple accept="image/*">
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Kembali</button>
                                <button type="button" class="btn btn-primary next-step">Lanjut ke Data Kontak</button>
                            </div>

                            <!-- Step 3: Data Kontak Pelanggan -->
                            <div id="step-3" class="form-step" style="display: none;">
                                <h4>Langkah 3 dari 4: Data Kontak Pelanggan</h4>
                                <div class="form-group">
                                    <label for="customer-name">Nama Lengkap Pelanggan</label>
                                    <input type="text" class="form-control" id="customer-name" name="customer_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer-phone">Nomor HP (WhatsApp Aktif)</label>
                                    <input type="tel" class="form-control" id="customer-phone" name="customer_phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer-address">Alamat Lengkap</label>
                                    <textarea class="form-control" id="customer-address" name="customer_address" rows="3" required></textarea>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Kembali</button>
                                <button type="button" class="btn btn-primary next-step">Lanjut ke Konfirmasi Akhir</button>
                            </div>

                            <!-- Step 4: Ringkasan & Ajukan Booking -->
                            <div id="step-4" class="form-step" style="display: none;">
                                <h4>Langkah 4 dari 4: Ringkasan & Ajukan Booking</h4>
                                <div id="summary"></div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">Saya menyetujui Syarat dan Ketentuan Servis</label>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Kembali</button>
                                <button type="submit" class="btn btn-success">Ajukan Booking Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>