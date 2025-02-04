<?php

	// Menangkap data yang dikirim HTTP
	$catch_data = $_GET['UIDresult'];


	// Menulis data sementara ke file json
	$file = fopen('storage.json', 'w');
	fwrite($file, json_encode(array('UIDresult'=>$catch_data)));
	fclose($file);


	// Extract file json
	$file = fopen('storage.json', 'r');
	
	$json;
	
	while(!feof($file)) {

		$json = json_decode(fgets($file));

	}


	echo "Data berhasil disimpan ke file JSON<br>";

	foreach($json as $key => $value) {
		echo $key . " => " . $value . "<br>";
	}
	fclose($file);

?>
