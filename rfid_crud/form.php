<?php
include('../includes/google_client.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $spreadsheetId = '1BQyx3TAUw_y3wRgetxGx7_V4_LJZqaCGvZLGb5CJDLE'; // Ganti dengan Spreadsheet ID Anda
    $range = 'RFID_Data!A1'; // Ganti dengan sheet dan range
    $service = getSpreadsheetService();

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

    $data = [
        [$timestamp, $card_uid, $name, $age, $designation, $location, $item_code, $item_name, $quantity, $unit]
    ];

    $body = new Google_Service_Sheets_ValueRange(['values' => $data]);

    try {
        $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            ['valueInputOption' => 'RAW']
        );
        header('Location: index.php');
        exit();
    } catch (Exception $e) {
        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}
?>

<h1 class="text-center">Add New Entry</h1>
<form method="POST">
    <div class="mb-3">
        <label for="card_uid" class="form-label">Scan RFID Card</label>
        <input type="text" name="card_uid" class="form-control" placeholder="Scan your card here..." autofocus required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="text" id="age" name="age" class="form-control">
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" id="location" name="location" class="form-control">
    </div>
    <div class="mb-3">
        <label for="item_code" class="form-label">Item Code</label>
        <input type="text" id="item_code" name="item_code" class="form-control">
    </div>
    <div class="mb-3">
        <label for="item_name" class="form-label">Item Name</label>
        <input type="text" id="item_name" name="item_name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="text" id="quantity" name="quantity" class="form-control">
    </div>
    <div class="mb-3">
        <label for="unit" class="form-label">Unit</label>
        <input type="text" id="unit" name="unit" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
