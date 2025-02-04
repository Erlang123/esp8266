<?php
	include 'db_connection.php';
	include 'uid_container.php';
	// include 'get_uid.php';

	$uid_cek = $_GET['cek_id_didatabase'];
	// $apakah_terdaftar_di_database = ((bool) $_GET['bre']);
	
	function get_apakah_terdaftar_di_database($variable, $conn){

		$sql = "SELECT id FROM table_the_iot_projects WHERE id='".$variable."'";
		$result = mysqli_query($conn,$sql);
		
		if (mysqli_num_rows($result) > 0) {
	
		  // output data of each row
		  // berarti data terdaftar di database
	
	
			$apakah_terdaftar_di_database = true;
		}
		else{
	
			// data tidak tersedia di database
			
			$apakah_terdaftar_di_database = false;
		}

		return $apakah_terdaftar_di_database;
	}








	if($uid_cek != null){
		echo get_apakah_terdaftar_di_database($uid_cek, $conn);
	}
	else{
		echo "ERROR";
	}
?>