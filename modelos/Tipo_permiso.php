<?php
require "../config/Conexion.php";

Class Tipo_permiso{
	public function __construct(){

	}

	

	public function listarTipoPermiso(){
	$sql = "SELECT *
			FROM tipo_permiso";
			
	return ejecutarConsulta($sql);
	}




} 
?>