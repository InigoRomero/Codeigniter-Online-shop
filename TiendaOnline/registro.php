<!DOCTYPE html>
	<html lang="es">
		<head>
			<meta charset="utf-8">
			<title>Registro</title>
			<link rel="stylesheet" type="text/css" href="<?=base_url("/Tienda/estilos.css")?>">

		</head>
		<body>
			<center>
			<h3> Registrarse</h3>
			<img src="<?=base_url("Tienda/merch.png")?>"/>
			<p>¿Ya tiene cuenta? Inicie sesión <a href="<?=base_url("index.php/Tiendamerch")?>">aquí</a><br>
			<span class="error"><?php if(empty($errCamposVacios)){echo 'Todos los campos son obligatorios';}else{echo 'Porfavor rellene todos los campos'; }?></span>
				<table>
					<?php
					
					if(isset($error2)){
						echo form_open('Tiendamerch/registrar');		
							echo '<tr>';echo '<td>';
							echo form_label('Usuario', 'usuario'); ;echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_input($user);echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr><td colspan="2"><span class="error">';if(isset($errornameC)) echo $errornameC; if(isset($erruserLong)) echo $erruserLong; if(isset($errNomExist)) echo $errNomExist; echo '</span></td></tr><br>'; //errores
							echo '<tr>';echo '<td>';
							echo form_label('Nombre', 'nombre');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_input($nombre);echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr><td colspan="2"><span class="error">';if(isset($errNombMal)) echo $errNombMal; if(isset($errNameLong)) echo $errNameLong; echo '</span></td></tr><br>'; //errores
							echo '<tr>';echo '<td>';
							echo form_label('Contraseña', 'Contrasena');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_password($passw);echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr><td colspan="2"><span class="error">';if(isset($erropasswLong)) echo $erropasswLong;  echo '</span></td></tr><br>'; //errores
							echo '<tr>';echo '<td>';
							echo form_label('Confirmar Contraseña', 'Contrasena2');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_password($passw2);echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr><td colspan="2"><span class="error">';if(isset($errpassw)) echo $errpassw;  echo '</span></td></tr><br>'; //errores
							echo '<tr>';echo '<td>';
							echo form_label('Correo', 'correo');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_input($correo);echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr><td colspan="2"><span class="error">';if(isset($errCorreoMal)) echo $errCorreoMal; if(isset($errcorExist)) echo $errcorExist; echo '</span></td></tr><br>'; //errores
							echo '<tr>';echo '<td>';
							echo form_label('Confirmar Correo', 'correo');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_input($correo2);echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr><td colspan="2"><span class="error">';if(isset($errCorreoDif)) echo $errCorreoDif;  echo '</span></td></tr><br>'; //errores
							echo '<tr>';echo '<td>';
							//echo form_submit('submit', '',"class='btnestilo'");
							echo form_submit('submit', 'REGISTRARSE');
							
							echo form_close();
					}else{
					   echo form_open('Tiendamerch/registrar');		
							echo '<tr>';echo '<td>';
							echo form_label('Usuario', 'usuario'); ;echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_input('usuario');echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr>';echo '<td>';
							echo form_label('Nombre', 'nombre');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_input('nombre');echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr>';echo '<td>';
							echo form_label('Contraseña', 'Contrasena');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_password('contrasena');echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr>';echo '<td>';
							echo form_label('Confirmar Contraseña', 'Contrasena2');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_password('contrasena2');echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr>';echo '<td>';
							echo form_label('Correo', 'correo');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_input('correo');echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr>';echo '<td>';
							echo form_label('Confirmar Correo', 'correo');echo '<br>';
							echo '</td>';
							echo '<td>';
							echo form_input('correo2');echo '<br>';
							echo '</td>';echo '</tr>';
							echo '<tr>';echo '<td>';
							//echo form_submit('submit', '',"class='btnestilo'");
							echo form_submit('submit', 'REGISTRARSE');
							
							echo form_close();
							
					}
					?>

					</td></tr>
			</table>
			
			</center>
	  
	</body>
</html>