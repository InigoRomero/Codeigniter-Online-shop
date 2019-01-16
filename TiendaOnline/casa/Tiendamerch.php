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
		
  }
	public function index()
	{  
		$this->load->view('login');
	}
		//funcion para comprobar si tiene los caracteres permitidos
		public function caracpermi($str){
		   //compruebo que los caracteres sean los permitidos 
		   $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789-_"; 
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
			$add=$this->Tiendamerch->artexist($nombre);
			if($add==true){
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
			if(artexist($nombre)==true){
				$fallo=true;
				$datos['errNomCarac']=' El nombre del articulo Contiene caracteres no permitidos. <br> Solo se puede introducir letras, numeros y -_ <br>';
			}
			//COMPRUEBO QUE LA FRANQUICIA NO CONTENGA NINGUN CARACTER NO PERMITIDO
			if(artexist($nombre)==true){
				$fallo=true;
				$datos['errFranq']=' El nombre del articulo ya esta registrado';
			}
			//comprobar si ha introducido mal el precio
			if(!is_float($precio)) {
				$fallo=true;
				$datos['errPrec']='Formato o caracter no valido, Ejemplo: 7.20';
			}
			//compruebo si la cantidad es correcta
			if(!is_int($cantidad)) {
				$fallo=true;
				$datos['errCant']='Formato o caracter no valido, Ejemplo: 7';
			}
		}
		//entrara si hay un error y pasa los datos a un array para que el usuario no los pierda y pasarselos a la vista
		if($fallo=true){
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
				   
			$this->load->view("admin",$datos);
		}else{
			//entrara si no hay ningun fallo en la introduccion de datos para introducir los datos en la base de datos
			
			$dir_subida = 'Tienda/articulos/';
			$fichero_subido = $dir_subida.basename($_FILES['fichero_usuario']['name']);
			//subir la foto
			if (move_uploaded_file($_FILES["fichero_usuario"][$nombrefoto], $fichero_subido)) {
				$add=$this->Tiendamerch->addArt($nombre,$tipo,$precio,$franquicia,$descripcion,$cantidad,$nombrefoto);
				if($add==true){
					//si la foto se ha subido y los datos guardado correctamnete volvemos a cargar la vista con el mensaje
					$datos['correcto']='confirm("Articulo añadido correctamnete!")';
					$this->load->view('admin',$datos);
				}else{
					echo '<script>alert("Se ha producido un error") </script>';
				}
			}else{
				echo '<script>alert("Se ha producido un error al subir la imagen") </script>';
			}
		}
		
	}
	
}

?>