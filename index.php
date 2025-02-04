
<?php 
	include 'db_connection.php';
	include 'uid_container.php';

	$uid = $_GET['uid'];
	$apakah_terdaftar_di_database = $_GET['is_on_database'];

?>










<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form>
		<input type="text" name="uid" onchange="cek_apa_data_terdaftar_ke_database('uid.php?cek_id_didatabase='.concat(this.value), this.value)" value="<?php echo $uid;?>">
	</form>
	
	<h5>UID: </h5><span id="uid_output"></span>
	<h5>Terdaftar di database: </h5><span id="apakah_terdaftar"></span>

</body>




<script type="text/javascript">
	// url = "uid_container.php"; nggak dipakai 

	// setInterval(updateEverySecond, 1000); nggak dipakai
	
	async function cek_apa_data_terdaftar_ke_database(url, id) {
	  let http_request = await fetch(url);
	  let request_result = await http_request.text();



	  if(request_result == true){
	  	// console.log(String(request_result));


	  	document.getElementById('uid_output').innerHTML=String(id);
	  	document.getElementById('apakah_terdaftar').innerHTML=request_result;

	  }
	  else{
	  	console.log(String(request_result));
	  }



	  // console.log(request_result);

	  // ... lanjutan scriptnya
	}




</script>





</html>