<?php
// Include file koneksi database
include('db_connect.php');

// Get the database connection
$pdo = Database::connect();  // Get the PDO instance

// Proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $timestamp = date('Y-m-d H:i:s');
    $card_uid = $_POST['card_uid'];
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $location = $_POST['location'] ?? '';
    $item_code = $_POST['item_code'] ?? '';
    $item_name = $_POST['item_name'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $unit = $_POST['unit'] ?? '';

    // Masukkan data ke database
    try {
        $stmt = $pdo->prepare("INSERT INTO rfid_data (timestamp, card_uid, name, age, designation, location, item_code, item_name, quantity, unit) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$timestamp, $card_uid, $name, $age, $designation, $location, $item_code, $item_name, $quantity, $unit]);

        // Redirect ke halaman utama setelah berhasil
        header('Location: view_all.php');
        exit();
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New RFID Entry</title>
    <!-- Tambahkan CSS untuk styling (gunakan Bootstrap jika perlu) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center">Add New RFID Entry</h1>

        <!-- Form untuk input data -->
        <form method="POST">
            <div class="mb-3">
                <label for="card_uid" class="form-label">Scan RFID Card</label>
                <input type="text" name="card_uid" class="form-control" placeholder="Scan your card here..." autofocus required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter name">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" name="age" class="form-control" placeholder="Enter age">
            </div>
            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" name="designation" class="form-control" placeholder="Enter designation">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control" placeholder="Enter location">
            </div>
            <div class="mb-3">
                <label for="item_code" class="form-label">Item Code</label>
                <input type="text" name="item_code" class="form-control" placeholder="Enter item code">
            </div>
            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" name="item_name" class="form-control" placeholder="Enter item name">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" name="quantity" class="form-control" placeholder="Enter quantity">
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <input type="text" name="unit" class="form-control" placeholder="Enter unit">
            </div>

            <!-- Tombol submit -->
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
