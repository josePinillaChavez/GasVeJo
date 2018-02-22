<?php
require "../config/Conexion.php";

Class Gas{
	public function __construct(){

	}

	public function insertarTipoPermiso($nombre){
		$sql = "INSERT INTO tipo_permiso (nombre)
				VALUES ('$nombre')";
		return ejecutarConsulta($sql);
	}

	public function editarTipoPermiso($id_tipo_permiso,$nombre){
		$sql = "UPDATE tipo_permiso
				SET nombre = '$nombre'
				WHERE id_tipo_permiso = '$id_tipo_permiso'";
		return ejecutarConsulta($sql);
	}

	public function mostrarTipoPermiso($id_tipo_permiso){
	$sql = "SELECT * FROM tipo_permiso
			WHERE id_tipo_permiso = '$id_tipo_permiso'";
	return ejecutarConsultaSimpleFila($sql);
	}

	public function listarTipoPermiso(){
	$sql = "SELECT id_tipo_permiso, nombre
			FROM tipo_permiso";
			
	return ejecutarConsulta($sql);
	}




} 
?>