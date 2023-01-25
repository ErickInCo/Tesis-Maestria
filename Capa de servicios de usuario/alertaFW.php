<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://192.168.1.95:1026/v2/entities/?options=values&attrs=batteryLevel,rssi,ipAddress,location,owner");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

$response = curl_exec($ch);
curl_close($ch);

$responseA = json_decode($response, true);
$limpiar = array('"', "[", "]");
$rlimpio = str_replace($limpiar, "", $response);
$myArray = explode(',', $rlimpio);

$p=0;
for ($i = 0; $i < count($myArray); $i=$i+6) {
    $pb[$p] = 100 * (float)$myArray[$i];
	$prsi[$p] = 100 * (float)$myArray[$i+1];
	$ip[$p] = $myArray[$i+2];
	$px[$p] = 300 + (float)$myArray[$i+3];
	$py[$p] = 300 - (float)$myArray[$i+4];
	$ot[$p] = $myArray[$i+5];
	$p=$p+1;
}


?>

<html>
<head>
    <meta charset="utf-8"/>
    <link href="css/Tec.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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


	<div class="grid-container">

		<div class="grid-item">
		  	<?php
		  		$p=0;
				for ($i = 0; $i < count($myArray); $i=$i+6) {
				    if ($px[$p]<=0 or $px[$p]>=600 or $py[$p]<=0 or $py[$p]>=600){
		  				echo "<div class='alert alert-danger'>";
					}
					else{
						echo "<div class='alert alert-info'>";
					}
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

