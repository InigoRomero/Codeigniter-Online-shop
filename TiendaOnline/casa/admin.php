<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>ADMIN</title>
    </head>
    <body>
        <h2>Añadir Articulo</h2>
		<?php
		if(isset($correcto)) echo $correcto;
		if(isset($nombre)){
			if(isset($errCamposVacios)) echo $errCamposVacios;
		   echo form_open('Tiendamerch/addArt');
				echo form_label('Nombre', 'Nombre');
				echo form_input($nombre);echo '<br>';
				echo '<span class="error">';if(isset($errNomExist)) echo $errNomExist; if(isset($errNomCarac)) echo $errNomLong; echo '</span>';echo '<br>';//errores
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
					echo '<br>';
				echo form_submit('submit', 'Añadir');
				echo form_close();
		}else{
			$tipoArt = array('id' => 'tipo_id', 'name' => 'tipo');
			echo form_open('Tiendamerch/addArt');
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
				echo '<input name="fichero_usuario" size="40" type="file" /><br><br>';
				echo form_submit('submit', 'Añadir');
				echo form_close();
		}
		?>
    </body>
</html>
