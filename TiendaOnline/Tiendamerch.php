<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiendamerch extends CI_Controller {

  function __construct(){
	 //llamamos al constructor de la clase padre
        parent::__construct();
        //llamo al helper url y al de form
        $this->load->helper("url"); 
         $this->load->helper("form"); 
        //llamo o incluyo el modelo
		$this->load->model("Tienda_model");
        //cargo la libreria de sesiones
        $this->load->library("session");
		// Load form validation library
		$this->load->library('form_validation');
		//load cookie library
		$this->load->helper('cookie');
		//load carrito library
		$this->load->library('cart');
  }
	public function index()
	{  
		$this->load->view('login');
	}
	//función para cargar la vista de registro 
	public function registro()
	{  
		$this->load->view('registro');
	}
	public function validaremail($str){
	  return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
	}
	//función para registrar un nuevo cliente
	public function registrar(){
		
		$fallo=false;
		//PRIMERO COMPROBAR TODOS LOS DATOS
		
		//recojo los datos
		$user=$this->input->post("usuario");
		$name=$this->input->post("nombre");
		$passw= $this->input->post("contrasena");
		$passw2=$this->input->post("contrasena2");
		$email=$this->input->post("correo");
		$email2=$this->input->post("correo2");
		
		//COMPROBACIÓN DE ERRORES EN LA INTRODUCCIÓN DE DATOS
		//compruebo que ningun campo este vacio
		if (empty($user) ||empty($name) ||empty($passw) ||empty($passw2) ||empty($email) ||empty($email2)){
				$fallo=true;
				$datos['errCamposVacios']='<h1>Porfavor rellene todos los campos </h1>';
		}else{//entonces si ningun campo esta vacio sigo con las comprobaciones
			//COMPRUEBO QUE EL Usuario EXISTA 
				$add=$this->Tienda_model->userExist($user);
				if($add==false){
					$fallo=true;
					$datos['errNomExist']=' El nombre de Usuario ya esta registrado';
				}
				//COMPRUEBO QUE EL CORREO EXISTA 
				$add=$this->Tienda_model->emailExist($email);
				if($add==false){
					$fallo=true;
					$datos['errcorExist']=' El correo ya esta registrado';
				}
			if($passw!=$passw2){
				$datos['errpassw']="Las contraseñas no coinciden <br>";
				$fallo=true;
			}
			if($email!=$email2){
				$datos['errCorreoDif']="Los correos no coinciden <br>";
				$fallo=true;
			}
			if($this->validaremail($email)==false){
				$datos['errCorreoMal']="El correo no es valido <br>";
				$fallo=true;
			}
			if(strlen($passw)<6 || strlen($passw)>18){
				$datos['erropasswLong']="La longitud de la contraseña debe ser de 6 a 18 caracteres <br>";
				$fallo=true;
			}
			if(strlen($user)<3 || strlen($user)>18){
				$datos['erruserLong']="La longitud del usuario debe ser de 3 a 18 caracteres <br>";
				$fallo=true;
			}
			if(strlen($name)<3 || strlen($name)>50){
				$datos['errNameLong']="La longitud del nombre debe ser de 3 a 50 caracteres <br>";
				$fallo=true;
			}
			 if ($this->caracpermi($name)==false) { 
				$datos['errNombMal']="El nombre solo puede contener letras <br>";
				$fallo=true;
			}
			 if ($this->caracpermi($user)==false) { 
				$datos['errornameC']="El usuario solo puede contener letras y numeros <br>";
				$fallo=true;
			}
			}
		if($fallo==false){//ENTRARA SI NO HAY FALLOS
			
			//llamo al metodo add
				$add=$this->Tienda_model->add(
						$user=$this->input->post("usuario"),
						$name=$this->input->post("nombre"),
						$passw= $this->input->post("contrasena"),
						$email=$this->input->post("correo")
						);
			//}
			 if($add==true){
				//Sesion de una sola ejecución
				$datos['correcto']="<script>launch_toast(); </script>";
				$this->load->view("login",$datos);
			}else{
				
			}
		}else{// en caso de fallos entrara aqui
		
			$datos['error2']='si';
				$datos['user']=array(
								'name'=>'usuario',
								'value'=>$user
					   );
				$datos['nombre']=array(
								'name'=>'nombre',
								'value'=>$name
					   );
				$datos['passw']=array(
								'name'=>'contrasena',
								'value'=>$passw
					   );
				$datos['passw2']=array(
								'name'=>'contrasena2',
								'value'=>$passw2
					   );
				$datos['correo']=array(
								'name'=>'correo',
								'value'=>$email
					   );
				$datos['correo2']=array(
								'name'=>'correo2',
								'value'=>$email2
					   );
				$this->load->view("registro",$datos);
		}
		
	}
	
	//COMPROBAR LA SESION
	public function userLogin() {
		
		//compruebo si ya tiene la sesión iniciada
			if(isset($this->session->userdata['logged_in'])){
				 $add=$this->Tienda_model->tipousuario($this->session->userdata['logged_in']['usuario']);
				 if($add==true){
					 $datos['tabla']=$this->cargarTienda();
					 $this->load->view('inicio',$datos);
				 }else{
					$datos['tabla']=$this->cargarArt();
					$datos['tablaart']=$this->Tienda_model->tablaArt();
				$this->load->view('admin',$datos);
				 }
			}
			//entrara cuando le de el a logear
		if($this->input->post("submit")){
			  $usuario=$this->input->post("usuario");
			  $add=$this->Tienda_model->login(
                $usuario,
                $this->input->post("contrasena")
                );
			if ($add == TRUE) {
				//compruebo si esta su usuario validado
				$add=$this->Tienda_model->validado($usuario);
				if($add==true){
					
					$datos['username']=$usuario;
					$session_data = array(
					'usuario' => $usuario
					);
					// Add user data in session
					$this->session->set_userdata('logged_in', $session_data);
					//compruebo el tipo de usuario
			         $add=$this->Tienda_model->tipousuario($usuario);
					 if($add==true){
						  $datos['tabla']=$this->cargarTienda();
						 $this->load->view('inicio',$datos);
					 }else{
						 $datos['tabla']=$this->cargarArt();
						 $datos['tablaart']=$this->Tienda_model->tablaArt();
						$this->load->view('admin',$datos);
					 }
				}else{
					$datos['loginIncorrec']='El administrador todavía no ha validado su cuenta, por favor intentelo mas tarde';
					$this->load->view('login',$datos);
				}
			} else {
				$datos['loginIncorrec']='Usuario o contraseña incorrectos';
				$this->load->view('login',$datos);
			}
		}
	}
	
	
	// CERRAR SESIÓN
		public function logout() {

		// Removing session data
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->load->view('login');
		}
		
		//funcion para comprobar si tiene los caracteres permitidos
		public function caracpermi($str){
		   //compruebo que los caracteres sean los permitidos 
		   $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789-_ "; 
		   for ($i=0; $i<strlen($str); $i++){ 
			  if (strpos($permitidos, substr($str,$i,1))===false){ 
				 return false; 
			  } 
			} 
			return true; 
		}
		
		//funcion que añade nuevos artiuclos
		public function addArt(){
			$fallo=false;
			
			$nombre=$this->input->post("nombre");
			$tipo=$this->input->post("tipo");
			$precio= $this->input->post("precio");
			$franquicia=$this->input->post("franquicia");
			$descripcion=$this->input->post("descripcion");
			$cantidad=$this->input->post("cantidad");
			$nombrefoto=$nombre.".jpg";
			
			
	
			//COMPROBACION DE  FALLOS
			
			//COMPRUEBA QUE NO HAYA NINGUN CAMPO VACIO
			if (empty($nombre) ||empty($tipo) ||empty($precio) ||empty($franquicia) ||empty($descripcion) ||empty($cantidad) ||empty($nombrefoto)){
				$fallo=true;
				$datos['errCamposVacios']='<h1>Porfavor rellene todos los campos </h1>';
			}else{
				//COMPRUEBO QUE EL NOMBRE EXISTA 
				$add=$this->Tienda_model->artexist($nombre);
				if($add==false){
					$fallo=true;
					$datos['errNomExist']=' El nombre del articulo ya esta registrado';
				}
				//COMPRUEBO LA LONGITUD DEL NOMBRE
				 if (strlen($nombre)<3 || strlen($nombre)>100){ 
					$fallo=true;
					$datos['errNomLong']=' La longitud del nombre debe ser de 3 a 100 caracteres';
				} 
				//COMPRUEBO LA LONGITUD DE LA DESCRIPCIÓN
				 if (strlen($descripcion)<10 || strlen($descripcion)>500){ 
					$fallo=true;
					$datos['errDescLong']=' La longitud de la descripción debe ser de 10 a 500 caracteres';
				} 
				//COMPRUEBO QUE EL NOMBRE NO CONTENGA NINGUN CARACTER NO PERMITIDO
				if($this->caracpermi($nombre)==false){
					$fallo=true;
					$datos['errNomCarac']=' El nombre del articulo Contiene caracteres no permitidos. <br> Solo se puede introducir letras, numeros y -_ <br>';
				}
				//COMPRUEBO QUE LA FRANQUICIA NO CONTENGA NINGUN CARACTER NO PERMITIDO
				if($this->caracpermi($franquicia)==false){
					$fallo=true;
					$datos['errFranq']=' El nombre del la FRANQUICIA Contiene caracteres no permitidos. <br> Solo se puede introducir letras, numeros y -_ <br>';
				}
				//comprobar si ha introducido mal el precio
				$precio=(float)$precio;
				if(!is_float($precio)) {
					$fallo=true;
					$datos['errPrec']='Formato o caracter no valido, Ejemplo: 7.00';
				}
				$cantidad=(int)$cantidad;
				//compruebo si la cantidad es correcta
				if(!is_int($cantidad)) {
					$fallo=true;
					$datos['errCant']='Formato o caracter no valido, Ejemplo: 7';
				}
			}
			//entrara si hay un error y pasa los datos a un array para que el usuario no los pierda y pasarselos a la vista
			if($fallo==true){
				$datos['error']='si';
				$datos['nombre']=array(
								'name'=>'nombre',
								'value'=>$nombre
					   );
				$datos['tipo']=array(
								'name'=>'tipo',
								'value'=>$tipo
					   );
				$datos['precio']=array(
								'name'=>'precio',
								'value'=>$precio
					   );
				$datos['franquicia']=array(
								'name'=>'franquicia',
								'value'=>$franquicia
					   );
				$datos['descripcion']=array(
								'name'=>'descripcion',
								'value'=>$descripcion
					   );
				$datos['cantidad']=array(
								'name'=>'cantidad',
								'value'=>$cantidad
					   );
				$datos['tabla']=$this->cargarArt();
				$datos['tablaart']=$this->Tienda_model->tablaArt();
				$this->load->view("admin",$datos);
			}else{
				//entrara si no hay ningun fallo en la introduccion de datos para introducir los datos en la base de datos
					$nombrefoto = str_replace(' ', '', $nombrefoto);
					$aux = $_FILES["fichero_usuario"]['name'];
					
					$dir_subida = 'imagenes/';
					$_FILES['fichero_usuario']['name']=$nombrefoto;
					$fichero_subido = $dir_subida.basename($_FILES['fichero_usuario']['name']);	
					
					
					if (move_uploaded_file($_FILES["fichero_usuario"]['tmp_name'], $fichero_subido)) {
					$add=$this->Tienda_model->addArt($nombre,$tipo,$precio,$franquicia,$descripcion,$cantidad,$nombrefoto);
					if($add==true){
						//si la foto se ha subido y los datos guardado correctamnete volvemos a cargar la vista con el mensaje
						$datos['correcto']="<script>launch_toast(); </script>";
						$datos['tabla']=$this->cargarArt();
						$datos['tablaart']=$this->Tienda_model->tablaArt();
						$this->load->view('admin',$datos);
					}else{
						echo '<script>alert("Se ha producido un error") </script>';
					}
				}else{
					echo '<script>alert("Se ha producido un error al subir la imagen") </script>';
				}
			}
		
	}
	
	//funcion para cargar todos los clientes por validar
	public function cargarArt(){
		//recodo todos los articulos
			$articulos=$this->Tienda_model->viewArt();
			return $articulos;
			
	}
		//funcion para cargar todos los clientes por validar
	public function cargarTienda(){
		//recodo todos los articulos
			$articulos=$this->Tienda_model->viewTienda();
			return $articulos;
			
	}
	//para validar los clientes
	public function alta($id){
		$add=$this->Tienda_model->validar($id);
		$datos['tabla']=$this->cargarArt();
		$datos['tablaart']=$this->Tienda_model->tablaArt();
		$this->load->view('admin',$datos);
	}
	//funcion para añadir los articulos al carrito
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
	
	public function compra(){
		//recogo todos los datos necesarios para la creación de la factura
		$idArt="";$cantidad="";
		foreach ($this->cart->contents() as $items){
			$idArt.="/".$items['id'];
			$cantidad.="/".$items['qty'];
		}
		$preciototal=$this->cart->format_number($this->cart->total());
		 $date = date("Y/m/d");
		 
		 $IDcliente=$this->session->userdata['logged_in']['usuario'];
		
		$add=$this->Tienda_model->crearfactura($IDcliente,$idArt,$cantidad,$preciototal,$date);
		 
		//recorro todos los array para borrarlos
		foreach ($this->cart->contents() as $items){
			$data = array(
            'rowid'   => $items['rowid'],
            'qty'     => 0
        );
        $this->cart->update($data);
		}
		
		
		$datos['tabla']=$this->cargarTienda();
		$datos['correcto']="<script>launch_toast2(); </script>";
		$this->load->view('inicio',$datos);
	}
	//cargar el historial de pedidos
	public function pedidos(){
		$usuario=$this->session->userdata['logged_in']['usuario'];
		$datos['tabla']=$this->Tienda_model->pedidos($usuario);
		$this->load->view('historial',$datos);
		
	}
	//filtrar los articulos
	public function filtrar(){
			$nombre= $this->input->post("nombre");
		   $datos['tabla']=$this->Tienda_model->filtrar($nombre);
		   //cargamos la vista con los datos filtrados
		   $this->load->view('inicio',$datos);
	}
}

?>