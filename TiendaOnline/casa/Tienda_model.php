<?php
//extendemos CI_Model
class Tienda_model extends CI_Model{
    public function __construct() {
        //llamamos al constructor de la clase padre
        parent::__construct();
         
        //cargamos la base de datos
        $this->load->database();
    }
	//funcion para añadir articulo nuevo
	public function addArt($nombre,$tipo,$precio,$franquicia,$descripcion,$cantidad,$imagen){
			
				$consulta=$this->db->query("INSERT INTO articulo VALUES(NULL,'$nombre','$tipo','$precio','$franquicia','$descripcion,$cantidad,$imagen');");
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
}
?>
