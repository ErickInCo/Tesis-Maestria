<?php

$curl = curl_init();

curl_setopt_array($curl, array(
	
	CURLOPT_URL => 'https://playground.devicehive.com:443/api/rest/device/',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST => 'GET',
	CURLOPT_RETURNTRANSFER => 'TRUE',
	CURLOPT_SSL_VERIFYHOST => false,
  	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_HTTPHEADER => array(
	  'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJwYXlsb2FkIjp7ImEiOlsyLDMsNCw1LDYsNyw4LDksMTAsMTEsMTIsMTUsMTYsMTddLCJlIjoxNzM1NzExMjAwMDAwLCJ0IjoxLCJ1Ijo3NTM0LCJuIjpbIjc0MzgiXSwiZHQiOlsiKiJdfX0.iQmv2EIYaOQU0l5NNFe9FGtWkoS1QrLhrJXBnUOL_2Q'
	),
));
$response = curl_exec($curl);
curl_close($curl);

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
	<img id="m" width="500" height="400"
	src="\ProyectoLuz\img\mapa.png" >
	<img id="p" width="500" height="400"
	src="\ProyectoLuz\img\punto.png" >

	<div class="grid-container">

		<div class="grid-item">
		  	<?php
		  		$p=0;
				for ($i = 0; $i < count($myArray); $i=$i+18) {
				    if ($px[$p]<=0 or $px[$p]>=600 or $py[$p]<=0 or $py[$p]>=600){
		  				echo "<div class='alert alert-danger'>";
					}
					else{
						echo "<div class='alert alert-info'>";
					}
					echo "ID: ".$id[$p]."<br>";
					echo "Nombre: ".$name[$p]."<br>";
			   		echo "Porcentaje de batería: ".$pb[$p]."%<br>";
			   		echo "Intensidad RSSI: ".$prsi[$p]."%<br>";
			   		echo "Dirección IP: ".$ip[$p]."<br>";
			   		echo "Posición: ".$px[$p].",".$py[$p]."<br>";
			   		echo "</div>";
					$p=$p+1;
				}
	   			
	   		?>
		</div>
	</div>

		
	
</body>
</html>

