<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?=base_url("/Tienda/estilos.css")?>">
		<title>carrito</title>
	</head>
	<body>
	<div id="toast"><div id="img">Correcto</div><div id="desc">Compra</div></div>

	<?php if(isset($correcto)) echo $correcto; ?>
				<div id="btnVolver">
			<a href="<?=base_url("index.php/Tiendamerch")?>"><button type="button">Volver</button></a>
			</div>
				<!--Boton cerrar sesion-->
			<div id="btnCerrar">
			<a href="<?=base_url("index.php/Tiendamerch/logout")?>"><button type="button">Cerrar Sesión</button></a>
			</div>
<?php echo form_open('Tiendamerch/compra'); ?>
<center>
<center><img  src="<?=base_url("Tienda/merch.png")?>"/></center><br><br>

<table cellpadding="6" cellspacing="1" style="width:80%" border="0" id="customers">

<tr>
        <th>Cantidad</th>
        <th>Articulo</th>
        <th style="text-align:right">Precio</th>
        <th style="text-align:right">Precio Total</th>
		<th colspan="1"> </th>
</tr>

<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>

        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

        <tr>
                <td><?php echo $items['qty']; ?></td>
                <td>

                        <?php echo $items['name']; ?>

                        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                <p>
                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                <?php echo "<img  width='150px' height='150px' src='". base_url("imagenes/". $option_value ."")."'/>";?>

                                        <?php endforeach; ?>
                                </p>

                        <?php endif; ?>

                </td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
				<td style="text-align:right"><a href="<?=base_url("index.php/Tiendamerch/removeCartItem/".$items['rowid'] ."")?>">Quitar </a></td>
        </tr>

<?php $i++; ?>

<?php endforeach; ?>

<tr>
        <td colspan="2"> </td>
        <td class="right"><strong>Total</strong></td>
        <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
		<td colspan="1"> </td>
</tr>

</table>

<a href="<?=base_url("index.php/Tiendamerch/compra")?>"><button type="button">Comprar</button></a>
</center>
	</body>
</html>