<?php
require 'db_connect.php'; // Ensure database connection file is included

$id = null;

// Retrieve 'id' from GET request
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if ($id !== null) {
    try {
        $pdo = Database::connect();
        
        // Query to get user data based on card UID (id)
        $sql = "SELECT * FROM rfid_data";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        
        // Check if data was found
        if ($data) {
            // If card_uid is null, set fallback values
            if (empty($data['card_uid'])) {
                $msg = "The ID of your Card / KeyChain is not registered !!!";
                $data['card_uid'] = "--------";
                $data['name'] = "--------";
                $data['age'] = "--------";
                $data['designation'] = "--------";
                $data['location'] = "--------";
                $data['item_code'] = "--------";
                $data['item_name'] = "--------";
                $data['quantity'] = "--------";
                $data['unit'] = "--------";
            } else {
                $msg = null; // No message if data is found
            }
        } else {
            // Handle case when no data is returned for the given ID
            $msg = "No user found with the given ID!";
            $data['card_uid'] = "--------";
            $data['name'] = "--------";
            $data['age'] = "--------";
            $data['designation'] = "--------";
            $data['location'] = "--------";
            $data['item_code'] = "--------";
            $data['item_name'] = "--------";
            $data['quantity'] = "--------";
            $data['unit'] = "--------";
        }

        Database::disconnect(); // Close database connection
    } catch (PDOException $e) {
        $msg = "Database error: " . $e->getMessage();
    }
} else {
    $msg = "No ID provided!";
    // Fallback to default values when no ID is passed
    $data['card_uid'] = "--------";
    $data['name'] = "--------";
    $data['age'] = "--------";
    $data['designation'] = "--------";
    $data['location'] = "--------";
    $data['item_code'] = "--------";
    $data['item_name'] = "--------";
    $data['quantity'] = "--------";
    $data['unit'] = "--------";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style>
        td.lf {
            padding-left: 15px;
            padding-top: 12px;
            padding-bottom: 12px;
        }
    </style>
</head>

<body>
    <div>
        <form>
            <table width="452" border="1" bordercolor="#10a0c5" align="center" cellpadding="0" cellspacing="1" bgcolor="#000" style="padding: 2px">
                <tr>
                    <td height="40" align="center" bgcolor="#10a0c5"><font color="#FFFFFF"><b>User Data</b></font></td>
                </tr>
                <tr>
                    <td bgcolor="#f9f9f9">
                        <table width="452" border="0" align="center" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="113" align="left" class="lf">Card UID</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['card_uid']; ?></td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td align="left" class="lf">Name</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['name']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">Age</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['age']; ?></td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td align="left" class="lf">Designation</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['designation']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">Location</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['location']; ?></td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td align="left" class="lf">Item Code</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['item_code']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">Item Name</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['item_name']; ?></td>
                            </tr>
                            <tr bgcolor="#f2f2f2">
                                <td align="left" class="lf">Quantity</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['quantity']; ?></td>
                            </tr>
                            <tr>
                                <td align="left" class="lf">Unit</td>
                                <td style="font-weight:bold">:</td>
                                <td align="left"><?php echo $data['unit']; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Display any error message -->
    <?php if ($msg): ?>
        <p style="color:red;"><?php echo $msg; ?></p>
    <?php endif; ?>

</body>
</html>
