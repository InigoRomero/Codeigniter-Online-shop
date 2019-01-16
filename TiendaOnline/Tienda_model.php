<?php
//extendemos CI_Model
class Tienda_model extends CI_Model{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //cargamos la base de datos
        $this->load->database();
    }
	//Iniciar sesion usuario
     public function login($usuario,$contrasena){
		 $consulta=$this->db->query("SELECT contrasena FROM Usuarios WHERE contrasena LIKE '$contrasena' AND ID LIKE (SELECT ID FROM Usuarios WHERE usuario LIKE '$usuario')");
		 if($consulta->num_rows()!=0){
			 return true;
		 }else{
			 return false;
		 }
	 }
	 //añadir usuario
	  public function add($usuario,$nombre,$contrasena,$correo){
            $consulta=$this->db->query("INSERT INTO Cliente VALUES(NULL,'$nombre','$correo','0',DEFAULT);");
			$consulta2=$this->db->query("INSERT INTO Usuarios VALUES(NULL,'$usuario','$contrasena','0');");
            if($consulta==true && $consulta2==true){
              return true;
            }else{
                return false;
            }

    }
	//devuelve el tipo de usuario
	public function tipousuario($usuario){
		$consulta=$this->db->query("SELECT usuario FROM Usuarios WHERE usuario LIKE '$usuario' AND admin LIKE 0");
		 if($consulta->num_rows()!=0){
			 return true;
		 }else{
			 return false;
		 }
	}
		//funcion para añadir articulo nuevo
	public function addArt($nombre,$tipo,$precio,$franquicia,$descripcion,$cantidad,$imagen){
			
				$consulta=$this->db->query("INSERT INTO articulo VALUES(NULL,'$nombre','$tipo','$precio','$franquicia','$descripcion','$cantidad','$imagen');");
				if($consulta==true){
				  return true;
				}else{
					return false;
				}
			
	}
	//funcion para comprobar si el articulo que se va a añadir existe o no
	public function artexist($nombre){
		 $consulta=$this->db->query("SELECT nombre FROM articulo WHERE nombre LIKE '$nombre'");
			if($consulta->num_rows()==0){
				return true;
			}else{
				return false;
			}
	}
		//funcion para comprobar si el usuario que se va a añadir existe o no
	public function userExist($usuario){
		 $consulta=$this->db->query("SELECT usuario FROM Usuarios WHERE usuario LIKE '$usuario'");
			if($consulta->num_rows()==0){
				return true;
			}else{
				return false;
			}
	}
		//funcion para comprobar si el correo que se va a añadir existe o no
	public function emailExist($correo){
		 $consulta=$this->db->query("SELECT correo FROM Cliente WHERE correo LIKE '$correo'");
			if($consulta->num_rows()==0){
				return true;
			}else{
				return false;
			}
	}
	//DEVUELVE TODOS LOS USUARIOS SIN VALIDAR
	public function viewArt(){
		
		$strTabla= "<table border='1' id='customers'><tr> <th>ID</th><th>Nombre </th><th>correo</th><th>saldo </th><th>Dar de alta </th></tr>";
			$articulos = $this->db->query("select * from Cliente WHERE alta like '0';");
			//recorro los arituclos y los introduzco en la tabla
			foreach ($articulos->result() as $row)
			{
				$strTabla.= "<tr><td>". $row->ID ."</td>  <td>". $row->nombre ."</td>  <td>". $row->correo ."</td> <td>". $row->saldo ."</td> <td><a href=". base_url("index.php/Tiendamerch/alta/". $row->ID ."") .">DAR DE ALTA</a></td> </tr>";
			}
			$strTabla.= "</table>";
		return $strTabla;
		
	}
		public function viewTienda(){
		
		$strTabla= "";
		$contador=0;
		$articulostotal=0;
			$articulos = $this->db->query("select * from articulo;");
			//recorro los arituclos para tener una cuenta de ellos y saber como ponerlos
			
			foreach ($articulos->result() as $row)
			{
				$articulostotal++;
			}
			//recorro cada articulo y lo introduzco dentro del div
			foreach ($articulos->result() as $row)
			{
				if($contador==0) {
					$strTabla.="<div class='grid-container'>";
					$id=$row->ID;
					$strTabla.="<div><a href=". base_url("index.php/Tiendamerch/carrito/". $id ."")."><button type='button'>Añadir al carrito</button></a></div>";
					if(($id+1)<=$articulostotal){
					$strTabla.="<div><a href=". base_url("index.php/Tiendamerch/carrito/". ($id+1) ."")."><button type='button'>Añadir al carrito</button></a></div>";}else{$strTabla.="<div></div>"; }
					if(($id+2)<=$articulostotal){
					$strTabla.="<div><a href=". base_url("index.php/Tiendamerch/carrito/". ($id+2) ."")."><button type='button'>Añadir al carrito</button></a></div>";}else{$strTabla.="<div></div>"; }
				}
				$contador++;
				$strTabla.= "<div>". $row->nombre ."-". $row->tipo ."<br><img  width='150px' height='150px' src=". base_url("imagenes/". $row->imagen ."")."   /><br>$". $row->precio ." -". $row->franquicia ."<br>". $row->descripcion ."</div>";
				if($contador==3){
					$strTabla.="</div><br><br><br><br><br><br><br>";
					$contador=0;
				}
			}
			$strTabla.= "</table>";
		return $strTabla;
		
	}
	
			public function tablaArt(){
		
		$strTabla= "";
		$contador=0;
		$articulostotal=0;
			$articulos = $this->db->query("select * from articulo;");
			//recorro los arituclos para tener una cuenta de ellos y saber como ponerlos
			
			foreach ($articulos->result() as $row)
			{
				$articulostotal++;
			}
			//recorro cada articulo y lo introduzco dentro del div
			foreach ($articulos->result() as $row)
			{
				if($contador==0) {
					$strTabla.="<div class='grid-container'>";
					$id=$row->ID;
					$strTabla.="<div>ARTICULO</div>";
					if(($id+1)<=$articulostotal){
					$strTabla.="<div>ARTICULO</div>";}else{$strTabla.="<div></div>"; }
					if(($id+2)<=$articulostotal){
					$strTabla.="<div>ARTICULO</a></div>";}else{$strTabla.="<div></div>"; }
				}
				$contador++;
				$strTabla.= "<div>". $row->nombre ."-". $row->tipo ."<br><img  width='150px' height='150px' src=". base_url("imagenes/". $row->imagen ."")."   /><br>$". $row->precio ." -". $row->franquicia ."<br>". $row->descripcion ."</div>";
				if($contador==3){
					$strTabla.="</div><br><br><br><br><br><br><br>";
					$contador=0;
				}
			}
			$strTabla.= "</table>";
		return $strTabla;
		
	}
	//VALIDA LOS CLIENTES
	public function validar($id){
		$consulta=$this->db->query("UPDATE Cliente SET alta='1' WHERE ID LIKE '$id'");
		return true;
	}
	//COMPROBAR SI ESTA VALIDADO EL CLIENTE
	public function validado($usuario){
		$consulta=$this->db->query("SELECT * FROM Usuarios WHERE usuario LIKE '$usuario'");
		foreach ($consulta->result() as $row)
			{
				$id=$row->ID;
			}
		$consulta=$this->db->query("SELECT ID FROM Cliente WHERE alta LIKE '1' AND ID LIKE '$id'");
		 if($consulta->num_rows()!=0){
			 return true;
		 }else{
			 return false;
		 }
	}
	
	//devolver datos del articulo
	public function Darticulo($id){
		$consulta=$this->db->query("SELECT * FROM articulo WHERE ID LIKE '$id'");
		foreach ($consulta->result() as $row)
			{
				$articulo[0]=$row->nombre;
				$articulo[1]=$row->precio;
				$articulo[2]=$row->imagen;
			}
		return $articulo;
	}
	//CREAR FACTURA
	public function crearfactura($idcliente,$idArt,$cantidad,$coste,$date){
		$consulta=$this->db->query("INSERT INTO factura VALUES(NULL,'$idcliente','$idArt','$cantidad','$coste','$date');");
				if($consulta==true){
				  return true;
				}else{
					return false;
				}
	}
	public function pedidos($usuario){
			$strTabla= "<table border='1' id='customers'><tr> <th>ID Pedido</th><th>ID Articulo </th><th>cantidad</th></tr>";
			$articulos = $this->db->query("select * from factura WHERE Usuario like '$usuario';");
			//recorro los arituclos y los introduzco en la tabla
			foreach ($articulos->result() as $row)
			{
				$ids=$row->ID_ARTICULO;
				$ids = str_replace('/', '<br>', $ids);
				$cantidades=$row->cantidad;
				$cantidades = str_replace('/', '<br>', $cantidades);
				
				$strTabla.= "<tr><td>".$row->ID ."</td><td>".$ids."</td><td>".$cantidades."</td></tr>";
				$strTabla.= "<tr><td colspan='2'> Fecha: ". $row->fecha ."</td><td>Coste total $".$row->Costetotal."</td></tr>";
			}
			$strTabla.= "</table>";
		return $strTabla;
	}
	
	public function filtrar($nombre){
		   //Hacemos una consulta
         $strTabla= "";
		$contador=0;
		$articulostotal=0;
			$articulos = $this->db->query("SELECT * FROM articulo WHERE nombre like '%".$nombre."%'");
			//recorro los arituclos para tener una cuenta de ellos y saber como ponerlos
			
			foreach ($articulos->result() as $row)
			{
				$articulostotal++;
			}
			//recorro cada articulo y lo introduzco dentro del div
			foreach ($articulos->result() as $row)
			{
				if($contador==0) {
					$strTabla.="<div class='grid-container'>";
					$id=$row->ID;
					$strTabla.="<div><a href=". base_url("index.php/Tiendamerch/carrito/". $id ."")."><button type='button'>Añadir al carrito</button></a></div>";
					if(($id+1)<=$articulostotal){
					$strTabla.="<div><a href=". base_url("index.php/Tiendamerch/carrito/". ($id+1) ."")."><button type='button'>Añadir al carrito</button></a></div>";}else{$strTabla.="<div></div>"; }
					if(($id+2)<=$articulostotal){
					$strTabla.="<div><a href=". base_url("index.php/Tiendamerch/carrito/". ($id+2) ."")."><button type='button'>Añadir al carrito</button></a></div>";}else{$strTabla.="<div></div>"; }
				}
				$contador++;
				$strTabla.= "<div>". $row->nombre ."-". $row->tipo ."<br><img  width='150px' height='150px' src=". base_url("imagenes/". $row->imagen ."")."   /><br>$". $row->precio ." -". $row->franquicia ."<br>". $row->descripcion ."</div>";
				if($contador==3){
					$strTabla.="</div><br><br><br><br><br><br><br>";
					$contador=0;
				}
			}
			$strTabla.= "</table>";
		return $strTabla;

	}
}
?>
