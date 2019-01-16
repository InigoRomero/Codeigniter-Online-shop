<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>ADMIN</title>
		<link rel="stylesheet" type="text/css" href="<?=base_url("/Tienda/estilos.css")?>">
    </head>
    <body>
	<div id="toast"><div id="img">Correcto</div><div id="desc">Se ha añadido el articulo</div></div>
	<script>
	function launch_toast() {
    var x = document.getElementById("toast")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
	}
	</script>
		<!--Boton cerrar sesion-->
			<div id="btnCerrar">
			<a href="<?=base_url("index.php/Tiendamerch/logout")?>"><button type="button">Cerrar Sesión</button></a>
			</div>
		<center><img  src="<?=base_url("Tienda/merch.png")?>"/></center>
		<center>
		<table id="admin">
		<tr>
		<td>
		<div id="addart">
		
			<h2>Añadir Articulo</h2>
			
			<?php
			if(isset($correcto)) echo $correcto;
			if(isset($error)){
				if(isset($errCamposVacios)) echo $errCamposVacios;
				$tipoArt = array('id' => 'tipo_id', 'name' => 'tipo');
			   echo form_open_multipart('Tiendamerch/addArt');
					echo form_label('Nombre', 'Nombre');
					echo form_input($nombre);echo '<br>';
					echo '<span class="error">';if(isset($errNomExist)) echo $errNomExist; if(isset($errNomCarac)) echo $errNomCarac;if(isset($errNomLong)) echo $errNomLong; echo '</span>';echo '<br>';//errores
					echo form_label('Tipo', 'Tipo');echo '<br>';
					echo form_radio($tipoArt,'taza');
					echo '<p">Taza</p>';
					echo '&nbsp;';
					echo form_radio($tipoArt,'ropa');
					echo '<p">Ropa</p>';
					echo '&nbsp;'; 
					echo form_radio($tipoArt,'figura');
					echo '<p">Figuras</p>';
					echo '&nbsp;';
					echo form_radio($tipoArt,'accesorio');
					echo '<p">Accesorio</p>';
					echo '&nbsp;';
					echo form_radio($tipoArt,'otro');
					echo '<p">Otro</p>';echo '<br><br>';
					echo form_label('Precio', 'Precio');
					echo form_input($precio);echo '<br>';  
					echo '<span class="error">';if(isset($errPrec)) echo $errPrec;echo '</span>'; echo '<br>';//errores
					echo form_label('Franquicia', 'Franquicia');
					echo form_input($franquicia);echo '<br>';
					echo '<span class="error">';if(isset($errFranq)) echo $errFranq;echo '</span>'; echo '<br>';//errores
					echo form_label('Descripción', 'Descripción');
					echo form_input($descripcion);echo '<br>';
					echo '<span class="error">';if(isset($errDescLong)) echo $errDescLong;echo '</span>';	echo '<br>';//errores
					echo form_label('Cantidad', 'Cantidad');
					echo form_input($cantidad);echo '<br>';
					echo '<span class="error">';if(isset($errCant)) echo $errCant;echo '</span>';	echo '<br>';//errores
					echo '<input name="fichero_usuario" size="40" type="file" /><br>';
					echo '<input type="submit" value="Upload" />';
					echo form_close();
			}else{
				$tipoArt = array('id' => 'tipo_id', 'name' => 'tipo');
				echo form_open_multipart('Tiendamerch/addArt');
					echo form_label('Nombre', 'Nombre');
					echo form_input('nombre');echo '<br><br>';
					echo form_label('Tipo', 'Tipo');
					echo form_radio($tipoArt,'taza');
					echo '<p">Taza</p>';
					echo '&nbsp;';
					echo form_radio($tipoArt,'ropa');
					echo '<p">Ropa</p>';
					echo '&nbsp;'; 
					echo form_radio($tipoArt,'figura');
					echo '<p">Figuras</p>';
					echo '&nbsp;';
					echo form_radio($tipoArt,'accesorio');
					echo '<p">Accesorio</p>';
					echo '&nbsp;';
					echo form_radio($tipoArt,'otro');
					echo '<p">Otro</p>';echo '<br><br>';
					echo form_label('Precio', 'Precio');
					echo form_input('precio');echo '<br><br>';   
					echo form_label('Franquicia', 'Franquicia');
					echo form_input('franquicia');echo '<br><br>';
					echo form_label('Descripción', 'Descripción');
					echo form_input('descripcion');echo '<br><br>';
					echo form_label('Cantidad', 'Cantidad');
					echo form_input('cantidad');echo '<br><br>';
					echo '<input name="fichero_usuario" size="40" type="file" /><br>';
					echo '<input type="submit" value="Upload" />';
					echo form_close();
			}
			?>
			</div>	
			</td>
			<td>
			<div id="Valuser">
				<h2>Validar cuentas</h2>
				<?php echo $tabla; ?>
			
			</div>
			</td>
			</tr>
			</table>
			<h2>Articulos</h2>
				<?php echo $tablaart; ?>
			</center>
    </body>
</html>
