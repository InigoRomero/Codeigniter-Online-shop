<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subirfoto extends CI_Controller {

  function __construct(){
	  parent::__construct();
	  $this->load->helper('form');
  }
	public function index()
	{  
		$this->load->view('subfoto');
		
	}

	/*******************************************************INTRODUCIR CORREDORES*/
	public function introfoto(){

					$aux = $_FILES["fichero_usuario"]['name'];
					
					$dir_subida = 'imagenes/';
					
					$fichero_subido = $dir_subida.basename($_FILES['fichero_usuario']['name']); 	
					
					
					if (move_uploaded_file($_FILES["fichero_usuario"]['tmp_name'], $fichero_subido)) {
						echo "The file ". basename( $_FILES["fichero_usuario"]["name"]). " has been uploaded.";
					} else {
						echo "Sorry, there was an error uploading your file.";
					}	
					
	}
}




?>