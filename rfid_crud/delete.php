<?php
// Include the db_connect.php file
include('db_connect.php');

// Connect to the database
$pdo = Database::connect();

$id = $_GET['id'];

try {
    // Prepare and execute the delete query
    $stmt = $pdo->prepare("DELETE FROM rfid_data WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect to index.php after successful deletion
    header('Location: index.php');
    exit();
} catch (Exception $e) {
    // Display error message if an exception occurs
    echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>
