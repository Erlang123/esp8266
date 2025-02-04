<?php
// Masukkan file header dan koneksi ke database
include('includes/header.php');
include('db_connect.php');

// Pastikan ID diterima melalui URL
if (!isset($_GET['id'])) {
    echo '<div class="alert alert-danger">ID tidak ditemukan!</div>';
    exit();
}

$id = $_GET['id']; // ID yang diterima melalui URL

// Ambil koneksi dari Database class
$pdo = Database::connect();

// Ambil data dari database berdasarkan ID
try {
    $stmt = $pdo->prepare("SELECT * FROM rfid_data WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo '<div class="alert alert-danger">Data tidak ditemukan!</div>';
        exit();
    }
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    exit();
}

// Proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data baru dari form
    $timestamp = date('Y-m-d H:i:s');
    $card_uid = $_POST['card_uid'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $designation = $_POST['designation'];
    $location = $_POST['location'];
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unit = $_POST['unit'];

    // Update data di database
    try {
        $stmt = $pdo->prepare("UPDATE rfid_data SET 
            timestamp = ?, 
            card_uid = ?, 
            name = ?, 
            age = ?, 
            designation = ?, 
            location = ?, 
            item_code = ?, 
            item_name = ?, 
            quantity = ?, 
            unit = ? 
            WHERE id = ?");
        $stmt->execute([$timestamp, $card_uid, $name, $age, $designation, $location, $item_code, $item_name, $quantity, $unit, $id]);

        // Redirect ke halaman utama setelah berhasil update
        header('Location: view_all.php');
        exit();
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update RFID Entry</title>
    <!-- Tambahkan CSS untuk styling (gunakan Bootstrap jika perlu) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center">Update RFID Entry</h1>

        <!-- Form untuk edit data -->
        <form method="POST">
            <div class="mb-3">
                <label for="card_uid" class="form-label">Scan RFID Card</label>
                <input type="text" name="card_uid" class="form-control" value="<?= htmlspecialchars($data['card_uid']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" name="age" class="form-control" value="<?= htmlspecialchars($data['age']) ?>">
            </div>
            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" name="designation" class="form-control" value="<?= htmlspecialchars($data['designation']) ?>">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($data['location']) ?>">
            </div>
            <div class="mb-3">
                <label for="item_code" class="form-label">Item Code</label>
                <input type="text" name="item_code" class="form-control" value="<?= htmlspecialchars($data['item_code']) ?>">
            </div>
            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" name="item_name" class="form-control" value="<?= htmlspecialchars($data['item_name']) ?>">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" name="quantity" class="form-control" value="<?= htmlspecialchars($data['quantity']) ?>">
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <input type="text" name="unit" class="form-control" value="<?= htmlspecialchars($data['unit']) ?>">
            </div>

            <!-- Tombol submit -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
