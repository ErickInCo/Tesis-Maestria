<?php
include 'php/conexion.php';
	$msj="Bienvenido! Erick I";
	$b=0;
	session_start();

	function cerrarS(){
		session_unset();
		session_destroy();
	}
?>

<html>
<head>
    <meta charset="utf-8"/>
    <link href="css/Tec.css" rel="stylesheet" type="text/css">
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
  
.img {
	display: none;
 }

</style>
<body>
	<ul>
	<li class="dropdown">
		<a><?php echo $msj; ?></a>
		<div class="dropdown-content">
      		<a href="php/login.php" onClick="<?php if($b==0){cerrarS();}  ?>">Cerrar Sesion </a>
     	</div>
	</li>
	</ul>

	<div class="grid-container">
		<div class="grid-item">
			<h4 align="center">Mapa FIWARE</h4>
			<iframe id="iframe" src="\ProyectoLuz\mapaFW.php" style="border:none;height:850px; width: 100%" ></iframe>
		</div>
		<div class="grid-item" style="height:auto;">
			<h4 align="center">Alerta FIWARE</h4>
			<iframe id="iframe2" src="\ProyectoLuz\alertaFW.php" style="border:none;height:850px; width: 100%" ></iframe>
		</div>
		<div class="grid-item">
			<h4 align="center">Mapa DeviceHive</h4>
			<iframe id="iframe3" src="\ProyectoLuz\mapaDH.php" style="border:none;height:850px; width: 100%" ></iframe>
		</div>
		<div class="grid-item" style="height:auto;">
			<h4 align="center">Alerta DeviceHive</h4>
			<iframe id="iframe4" src="\ProyectoLuz\alertaDH.php" style="border:none;height:100%; width: 100%" ></iframe>
		</div>
	</div>
	
	

	<script>
        window.setInterval(function() {
            reloadIFrame()
        }, 1000);

        function reloadIFrame() {
            console.log('reloading..');
            document.getElementById('iframe').contentWindow.location.reload();
            document.getElementById('iframe2').contentWindow.location.reload();
			document.getElementById('iframe3').contentWindow.location.reload();
			document.getElementById('iframe4').contentWindow.location.reload();
        }
    </script>
</body>
</html>

<?php

?>