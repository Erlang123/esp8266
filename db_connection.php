<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "nodemcu_rfid_iot_projects";

	$conn = mysqli_connect($servername, $username, $password, $db);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}



	// $sql = "SELECT id FROM table_the_iot_projects";
	// $result = $conn->query($sql);


	// if ($result->num_rows > 0) {
	  // output data of each row
	  // berarti data terdaftar di database
	// }
	// else{/* data tidak tersedia di database*/}

	// $conn->close();
?>