<?php 
	include 'db_connection.php';
	include 'uid_container.php';
	
	
	
	// Script yang digunakan untuk menangkap request HTTP dari ESP8266
	// $uid = $_GET['UID'];
	// ...
	// ...
	// ...
	
	
	
	// Cek apa 'uid' terdaftar di database
	
	$sql = "SELECT id FROM table_the_iot_projects WHERE id='".$_GET['UID']."'";
	$result = mysqli_query($conn,$sql);
	
	if (mysqli_num_rows($result) > 0) {

	  // output data of each row
	  // berarti data terdaftar di database


		$apakah_terdaftar_di_database = true;
		while ($row = mysqli_fetch_assoc($result)) {
			$uid = $row["id"];
		}
		// $conn->close();
		header("Location:index.php?uid=".((string) $uid)."&is_on_database=".((string) $apakah_terdaftar_di_database));
	}
	else{

		// data tidak tersedia di database
		
		$apakah_terdaftar_di_database = false;
		$uid = null;
		// $conn->close();
		header("Location:index.php?uid=".((string) $uid)."&is_on_database=".((string) $apakah_terdaftar_di_database));
	}



?>