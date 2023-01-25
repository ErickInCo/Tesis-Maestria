<?php
$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "http://159.203.168.204:1026/v2/entities/p10/?options=values&attrs=batteryLevel,rssi,ipAddress,location");
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
	src="\ProyectoLuz\img\mapaV2.jpg" >
	<img id="p" width="500" height="400"
	src="\ProyectoLuz\img\punto.png" >
	<img id="hom" width="500" height="400"
	src="\ProyectoLuz\img\h.png" >
	<img id="muj" width="500" height="400"
	src="\ProyectoLuz\img\m.png" >

	<div class="grid-container">
		<div class="grid-item">
			<canvas align="top" id="myCanvas" width="900" height="800"
			style="border:1px solid #d3d3d3;">
			Your browser does not support the HTML5 canvas tag.
			</canvas>
		</div>
		<div class="grid-item">
		  	<?php
		  	/*
		  		if ($px[0]<=0 or $px[0]>=600 or $py[0]<=0 or $py[0]>=600){
		  			echo "<div class='alert alert-danger'>";
				}
				else{
					echo "<div class='alert alert-info'>";
				}
				echo "ID: p10<br>";
		   		echo "Porcentaje de batería: ".$pb[0]."%<br>";
		   		echo "Intensidad RSSI: ".$prsi[0]."%<br>";
		   		echo "Dirección IP: ".$ip[0]."<br>";
		   		echo "Posición: ".$px[0].",".$py[0]."<br>";
		   		echo "</div>";

				if ($px[1]<=0 or $px[1]>=600 or $py[1]<=0 or $py[1]>=600){
					echo "<div class='alert alert-danger'>";
				}
				else{
					echo "<div class='alert alert-info'>";
				}
		   		echo "ID: p20<br>";
		   		echo "Porcentaje de batería: ".$pb[1]."%<br>";
		   		echo "Intensidad RSSI: ".$prsi[1]."%<br>";
		   		echo "Dirección IP: ".$ip[1]."<br>";
		   		echo "Posición: ".$px[1].",".$py[1]."<br>";
		   		echo "</div>";
		   	*/	
	   			
	   		?>
		</div>
	</div>
	

		
	
	
	<script type="text/javascript">
	window.onload = function() {
		
	    var canvas = document.getElementById("myCanvas");
	    var ctx = canvas.getContext("2d");
	    var img = document.getElementById("m");
	    var img2 = document.getElementById("p");
	    var img3 = document.getElementById("hom");
	    var img4 = document.getElementById("muj");
		ctx.drawImage(img, 0, 0);
		ctx.font = '20px arial';
	   	<?php
	   	
	   		$p=0;
			for ($i = 0; $i < count($myArray); $i=$i+6) {
				if ($ot[$p]==1){
					echo "ctx.drawImage(img3,".$px[$p].",".$py[$p].", 30, 50);";
				}
				else{
					echo "ctx.drawImage(img4,".$px[$p].",".$py[$p].", 55, 50);";
				}
			    //echo "ctx.drawImage(img2,".$px[$p].",".$py[$p].", 30, 30);";
			    echo "ctx.fillText('ID: p".(string)((int)$p+1)."0', ".$px[$p].", ".$py[$p].");";
				$p=$p+1;
			}	
	   		
	   	?>
	   	//setTimeout(recargar(){location.reload();}, 5000);
	   
	   // ctx.drawImage(img2,500,100, 30, 30);
	   // ctx.drawImage(img2,100,100, 30, 30);
	   // ctx.drawImage(img2,200,200, 30, 30);
	};
	</script>
		
		
	
</body>
</html>

