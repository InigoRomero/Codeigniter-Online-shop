<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Ejercicio21</title>
</head>
<body>
<p><a href="../CarreraBehobia">Home</a>---><a>Socios</a> </p>
<!--------------------------------------------------------------Introducción de datos---------------->
<div id="introCorredor">
  <?php
   echo form_open_multipart('Subirfoto/introfoto');
        echo '<input name="fichero_usuario" size="40" type="file" /><br>';
		echo '<input type="submit" value="Upload" />';
        echo form_close();
		?>
	
		
		<!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
		<!--Enviar este fichero: <input name="fichero_usuario" type="file" />
		<input type="submit" value="Enviar fichero" /-->
</form>
		</div>
  
</body>
</html>