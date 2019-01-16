<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>ADMIN</title>
		<link rel="stylesheet" type="text/css" href="<?=base_url("/Tienda/estilos.css")?>">
    </head>
    <body>
			<div id="btnVolver">
			<a href="<?=base_url("index.php/Tiendamerch")?>"><button type="button">Volver</button></a>
			</div>
		<!--Boton cerrar sesion-->
			<div id="btnCerrar">
			<a href="<?=base_url("index.php/Tiendamerch/logout")?>"><button type="button">Cerrar Sesión</button></a>
			</div>
		<center><img  src="<?=base_url("Tienda/merch.png")?>"/>
		
	
			<h2>Hisotorial de pedidos</h2>
	
				<?php echo $tabla; ?>
	
			</center>
    </body>
</html>