<!DOCTYPE html>
<html lang="es">
<?php
if (isset($this->session->userdata['logged_in'])) {
	echo '<script>alert("hola"); </script>';
header("location:" .base_url()."index.php/Tiendamerch/userLogin");

}
 ?>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?=base_url("/Tienda/estilos.css")?>">
		<title>Login</title>
	<script>
		function launch_toast() {
			var x = document.getElementById("toast")
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
		}

	</script>
	</head>
	<body>
	<div id="toast"><div id="img">Correcto</div><div id="desc">Compruebe el correo!</div></div>
	
	<center><h1> Merch Romero </h1>
		 <h4> Bienvenido a la mejor página de merchandising!</h4>
		 <p> Para poder acceder a la tienda inicie sesión. Si no dispone de cuenta registrese <a href="<?=base_url("index.php/Tiendamerch/registro")?>">aquí</a>
		 <table>
		 <tr>
			<?php
			if(isset($correcto)) echo $correcto;
			   echo form_open('Tiendamerch/userLogin');
					echo '<td>';
					echo form_label('Usuario', 'usuariob');
					echo '</td>';echo '<td>';
					echo form_label('Contraseña', 'Contrasena');
					echo '</td>';echo '</tr>';echo '<tr>';echo '<td>';
					echo form_input('usuario');
					echo '</td>';echo '<td>';
					echo form_password('contrasena');
					echo '</td>';echo '<td>';
					echo form_submit('submit', 'INICIAR SESIÓN');
					echo '</td>';
					echo form_close();
			?>
			</tr>
			<tr>
			</tr>
			</table>
			<br>
			<?php echo '<span class="error">';if(isset($loginIncorrec)) echo $loginIncorrec;echo '</span>'; echo '<br>';//errores ?> 
			<br>
			<img src="<?=base_url("Tienda/merch.png")?>"/>
			</center>
	</body>
</html>