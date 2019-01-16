<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?=base_url("/Tienda/estilos.css")?>">
		<title>Inicio</title>
	
	</head>
	
	<body>
	<div id="toast"><div id="img"></div><div id="desc">Articulo Añadido al carrito</div></div>
	<div id="toast2"><div id="img">Correcto</div><div id="desc">Compra hecha</div></div>
		<script>
	function launch_toast() {
    var x = document.getElementById("toast")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 4000);
	}
	function launch_toast2() {
			var x = document.getElementById("toast2")
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
	}
	</script>
	<?php if(isset($correcto)) echo $correcto; ?>
	<!--Carrito-->
			<div id="carrito">
			<a href="<?=base_url("index.php/Tiendamerch/loadCarrito")?>"><img src="<?=base_url("/Tienda/carrito.png")?>" style="width:60%; height:60%;"/> </a>
			</div>
	<!--Boton cerrar sesion-->
			<div id="btnCerrar">
			<a href="<?=base_url("index.php/Tiendamerch/logout")?>"><button type="button">Cerrar Sesión</button></a>
			</div>
	<center><h1> Bienvenido </h1>
			<?php
				echo form_open('Tiendamerch/filtrar');
				echo form_input('nombre');  		
				echo form_submit('submit', 'Buscar');
				echo form_close();
				?>
	<a href="<?=base_url("index.php/Tiendamerch/pedidos")?>"><button type="button">Pedidos</button></a>
	</center>
	
		
			
		<center>
		<?php echo $tabla; ?>
		</center>
	</body>
</html>