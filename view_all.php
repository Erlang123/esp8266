<?php
include('includes/header.php');
include('db_connect.php'); // Ensure this includes the Database class

// Establish connection
$pdo = Database::connect();

if ($pdo) {
    // Query to get all records from the database
    try {
        $stmt = $pdo->query("SELECT * FROM rfid_data ORDER BY timestamp DESC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        $data = [];
    }

    // Disconnect after query execution
    Database::disconnect();
} else {
    echo "Failed to connect to the database.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-center">RFID CRUD Management</h1>

    <!-- Navigation buttons -->
    <div class="d-flex justify-content-center mb-3">
        <a href="index.php" class="btn btn-primary me-2">Home</a>
        <a href="create.php" class="btn btn-primary me-2">Add New Entry</a>
        <a href="view_all.php" class="btn btn-primary me-2">All User Data</a>
    </div>

    <div id="show_all_data">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Timestamp</th>
                    <th>Card UID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Designation</th>
                    <th>Location</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['timestamp']) ?></td>
                            <td><?= htmlspecialchars($row['card_uid']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['age']) ?></td>
                            <td><?= htmlspecialchars($row['designation']) ?></td>
                            <td><?= htmlspecialchars($row['location']) ?></td>
                            <td><?= htmlspecialchars($row['item_code']) ?></td>
                            <td><?= htmlspecialchars($row['item_name']) ?></td>
                            <td><?= htmlspecialchars($row['quantity']) ?></td>
                            <td><?= htmlspecialchars($row['unit']) ?></td>
                            <td>
                                <a href="update.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center">No data available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
include('includes/footer.php');
?>
