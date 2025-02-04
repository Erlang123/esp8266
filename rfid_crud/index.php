<?php
include('includes/header.php');
include('db_connect.php');
include('UIDContainer.php'); // Including UIDContainer.php to retrieve $UIDresult

// Retrieve UID from POST request or fallback to UIDContainer
$UIDresult = $_POST['UID'] ?? $UIDresult ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        html {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        td.lf {
            padding: 12px 15px;
        }
    </style>
    <script>
        function updateData() {
            fetch('index.php')
                .then(response => response.text())
                .then(data => {
                    document.documentElement.innerHTML = data;
                });
        }
        setInterval(updateData, 2000); // Update every 2 seconds
    </script>
</head>
<body>
    <h1 class="text-center">RFID CRUD Management</h1>

    <p class="text-center">
        UID: <?= !empty($UIDresult) ? htmlspecialchars($UIDresult) : 'No UID data available.' ?>
    </p>

    <div class="d-flex justify-content-center mb-3">
        <a href="index.php" class="btn btn-primary me-2">Home</a>
        <a href="create.php" class="btn btn-primary me-2">Add New Entry</a>
        <a href="view_all.php" class="btn btn-primary me-2">All User Data</a>
    </div>

    <div id="show_user_data">
        <table width="652" border="1" bordercolor="#10a0c5" align="center" cellpadding="0" cellspacing="1" bgcolor="#000" style="padding: 2px">
            <tr>
                <td height="40" align="center" bgcolor="#10a0c5">
                    <font color="#FFFFFF"><b>Scanned RFID Data</b></font>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f9f9f9">
                    <table width="652" border="0" align="center" cellpadding="5" cellspacing="0">
                        <tr>
                            <td class="lf">Card UID</td>
                            <td><b>:</b></td>
                            <td><?= htmlspecialchars($UIDresult); ?></td>
                        </tr>
                        <?php
                        if (!empty($UIDresult)) {
                            $pdo = Database::connect();
                            $query = "SELECT * FROM rfid_data WHERE card_uid = :card_uid";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':card_uid', $UIDresult, PDO::PARAM_STR);
                            $stmt->execute();
                            $matchedData = $stmt->fetch(PDO::FETCH_ASSOC);
                            Database::disconnect();
                        ?>
                        <?php if ($matchedData): ?>
                            <tr bgcolor="#f2f2f2">
                                <td class="lf">Name</td>
                                <td><b>:</b></td>
                                <td><?= htmlspecialchars($matchedData['name'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td class="lf">Age</td>
                                <td><b>:</b></td>
                                <td><?= htmlspecialchars($matchedData['age'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td class="lf">Designation</td>
                                <td><b>:</b></td>
                                <td><?= htmlspecialchars($matchedData['designation'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td class="lf">Location</td>
                                <td><b>:</b></td>
                                <td><?= htmlspecialchars($matchedData['location'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td class="lf">Item Code</td>
                                <td><b>:</b></td>
                                <td><?= htmlspecialchars($matchedData['item_code'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td class="lf">Item Name</td>
                                <td><b>:</b></td>
                                <td><?= htmlspecialchars($matchedData['item_name'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td class="lf">Quantity</td>
                                <td><b>:</b></td>
                                <td><?= htmlspecialchars($matchedData['quantity'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td class="lf">Unit</td>
                                <td><b>:</b></td>
                                <td><?= htmlspecialchars($matchedData['unit'] ?? 'N/A'); ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" align="center">No matching data found in database.</td>
                            </tr>
                        <?php endif; ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="3" align="center">No RFID scan detected.</td>
                        </tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
