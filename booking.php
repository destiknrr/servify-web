<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $service_date = $_POST['service_date'];
    $visit_time = $_POST['visit_time'];
    $laptop_brand = $_POST['laptop_brand'];
    $damage_description = $_POST['damage_description'];
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $customer_address = $_POST['customer_address'];
    $terms = isset($_POST['terms']);

    // Validate data (simple validation)
    if (empty($service_date) || empty($visit_time) || empty($laptop_brand) || empty($damage_description) || empty($customer_name) || empty($customer_phone) || empty($customer_address) || !$terms) {
        die('Please fill all required fields and accept the terms.');
    }

    // Handle file uploads
    $uploaded_files = [];
    if (isset($_FILES['laptop_photos'])) {
        $total_files = count($_FILES['laptop_photos']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            if ($_FILES['laptop_photos']['error'][$i] === UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['laptop_photos']['tmp_name'][$i];
                $name = basename($_FILES['laptop_photos']['name'][$i]);
                $target_file = 'uploads/' . uniqid() . '-' . $name;
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $uploaded_files[] = $target_file;
                }
            }
        }
    }

    // Generate ticket number
    $ticket_number = 'LAPT-' . date('Ymd') . uniqid();

    // Save booking data
    $booking_data = [
        'ticket_number' => $ticket_number,
        'service_date' => $service_date,
        'visit_time' => $visit_time,
        'laptop_brand' => $laptop_brand,
        'damage_description' => $damage_description,
        'customer_name' => $customer_name,
        'customer_phone' => $customer_phone,
        'customer_address' => $customer_address,
        'uploaded_files' => $uploaded_files,
        'status' => 'Booking Diajukan',
        'diagnosis' => '',
        'estimated_completion' => '',
        'service_cost' => '',
        'total_price' => ''
    ];

    $bookings = [];
    if (file_exists('data/bookings.json')) {
        $bookings = json_decode(file_get_contents('data/bookings.json'), true);
    }
    $bookings[] = $booking_data;
    file_put_contents('data/bookings.json', json_encode($bookings, JSON_PRETTY_PRINT));

    // Redirect to status page
    header('Location: status.php?ticket=' . $ticket_number);
    exit;
}
?>