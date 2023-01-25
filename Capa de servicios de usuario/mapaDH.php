<?php

// $ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://playground.devicehive.com:443/api/rest/device');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


// $headers = array();
// $headers[] = 'Accept: application/json';
// $headers[] = 'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJwYXlsb2FkIjp7ImEiOlsyLDMsNCw1LDYsNyw4LDksMTAsMTEsMTIsMTUsMTYsMTddLCJlIjoxNzA0MDg4ODAwMDAwLCJ0IjoxLCJ1Ijo3NTM0LCJuIjpbIjc0MzgiXSwiZHQiOlsiKiJdfX0.lwF2Z-8dYwofoqNt8V78gX5xO7WF0OFecbGp18Ni-co';
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// $response = curl_exec($ch);
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// }
// curl_close($ch);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://playground.devicehive.com:443/api/rest/device',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_HTTPHEADER => array(
	'Accept: application/json',
    'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJwYXlsb2FkIjp7ImEiOlsyLDMsNCw1LDYsNyw4LDksMTAsMTEsMTIsMTUsMTYsMTddLCJlIjoxNzM1NzExMjAwMDAwLCJ0IjoxLCJ1Ijo3NTM0LCJuIjpbIjc0MzgiXSwiZHQiOlsiKiJdfX0.iQmv2EIYaOQU0l5NNFe9FGtWkoS1QrLhrJXBnUOL_2Q'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;

$responseA = json_decode($response, true,10);
$limpiar = array('"', "[", "]","{","}");
$rlimpio = str_replace($limpiar, "", $response);
$myArray = explode(',', $rlimpio);

$p=0;
for ($i = 0; $i < count($myArray); $i=$i+18) {

    $id[$p] = str_replace("id:", "", $myArray[$i]);
    $name[$p] = str_replace("name:", "", $myArray[$i+1]);
    $pb[$p] = 100 * (float)str_replace("batteryLevel:value:", "", $myArray[$i+5]);
	$prsi[$p] = 100 * (float)str_replace("rssi:value:", "", $myArray[$i+9]);
	$ip[$p] = str_replace("ipAddress:value:", "", $myArray[$i+10]);
	$px[$p] = 300 + (float)str_replace("value:", "", $myArray[$i+13]);
	$py[$p] = 300 - (float)str_replace("value:", "", $myArray[$i+14]);
	$p=$p+1;
}

?>

<html>
<head>
    <meta charset="utf-8"/>
    <link href="css/Tec.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Home</title>
</head>
<style>

.grid-container {
  display: grid;
  grid-template-columns: auto auto;
  padding: 10px;
}
.grid-item {
  padding: 20px;
  font-size: 30px;
  text-align: justify;
}

img {
  display: none;
}
</style>
<body>
	<img id="m" width="700" height="400"
	src="\ProyectoLuz\img\MapaV2.jpg" >
	<img id="p" width="500" height="400"
	src="\ProyectoLuz\img\punto.png" >

	<div class="grid-container">
		<div class="grid-item">
			<canvas align="top" id="myCanvas" width="900" height="800"
			style="border:1px solid #d3d3d3;">
			Your browser does not support the HTML5 canvas tag.
			</canvas>
		</div>
		<div class="grid-item">

		</div>
	</div>

	
	<script type="text/javascript">
	window.onload = function() {
		
	    var canvas = document.getElementById("myCanvas");
	    var ctx = canvas.getContext("2d");
	    var img = document.getElementById("m");
	    var img2 = document.getElementById("p");
		ctx.drawImage(img, 0, 0);
	   	<?php
	   		$p=0;
			for ($i = 0; $i < count($myArray); $i=$i+18) {
			    echo "ctx.drawImage(img2,".$px[$p].",".$py[$p].", 30, 30);";
				$p=$p+1;
			}	
	   		
	   	?>

	};
	</script>

</body>
</html>

