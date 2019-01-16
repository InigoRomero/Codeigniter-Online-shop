<?php
public function carrito($id){
		
		//llamo a una funcion que me devuelva los datos del articulo y los introduzco
		$articulo=$this->Tienda_model->Darticulo($id);
		$nombre=$articulo[0];
		$precio=$articulo[1];
		$imagen=$articulo[2];
		
	$data = array(
        'id'      => $id,
        'qty'     => 1,
        'price'   => $precio,
        'name'    => $nombre,
        'options' => array('Size' => $imagen)
		);
	$this->cart->insert($data);
		$datos['tabla']=$this->cargarTienda();
		$datos['correcto']="<script>launch_toast(); </script>";
		$this->load->view('inicio',$datos);
	}
	//carga el carrito con los articulos que ha añadido
	public function loadCarrito(){
		//recorro todos  los objetos del carrito
	$this->load->view('carrito');
	}
	//vaciar objeto del carrito
	function removeCartItem($rowid) {   
        $data = array(
            'rowid'   => $rowid,
            'qty'     => 0
        );
        $this->cart->update($data);
		$this->load->view('carrito');
	}
	?>