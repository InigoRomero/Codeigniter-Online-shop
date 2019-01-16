<?php
//basicamente al boton de añadir al carrito le añades el enlace que llamen a la funcion carrito del controlador con el id y se añade el objeto al carro
$strTabla.="<div><a href=". base_url("index.php/Tiendamerch/carrito/". $id ."")."><button type='button'>Añadir al carrito</button></a></div>";
?>