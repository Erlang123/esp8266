<?php

	// Cek status session
	if(session_status() == PHP_SESSION_DISABLED){
		// Kalau session belum aktif, maka mulai session baru
		session_start();
	}

	$_SESSION['UIDresult'] = null;


	function function_ntahlah() : object{

		$file = fopen('storage.json', 'r');
	
		// Check ketersediaan file json
		if(!$file){

			// Kalau nggak tersedia, eksekusi block ini

			die("Path not isn't valid");
			fclose($file);

		}
	
	
		// Extract file json
		$json;
		while(!feof($file)) {

			$json = json_decode(fgets($file));

		}

		fclose($file);

		// return object JSON
		return $json;
	}


	$_SESSION['UIDresult'] = function_ntahlah()->UIDresult;


	// Cek req_code dari AJAX
	if(isset($_GET['req_code'])){

		// Memilah block yang cocok dengan req_code AJAX
		switch ($_GET['req_code']) {

			case 0: // Get UIDresult
				echo $_SESSION['UIDresult'];
				break;
			
			default:
				echo "Error";
				break;
		}
	}
?>