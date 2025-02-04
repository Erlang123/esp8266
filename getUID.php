<?php
// Mendapatkan nilai UIDresult yang dikirimkan melalui metode POST
$UIDresult = $_POST["UIDresult"];

// Menulis kode PHP ke dalam file UIDContainer.php
$Write = "<?php \$UIDresult = '" . $UIDresult . "'; ?>";

// Menulis kode PHP ke dalam file UIDContainer.php
file_put_contents('UIDContainer.php', $Write);

// Memberikan pesan konfirmasi
echo "UID has been saved to UIDContainer.php";
?>
