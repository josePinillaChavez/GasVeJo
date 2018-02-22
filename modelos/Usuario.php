<?php
require "../config/Conexion.php";

Class Usuario{
	public function __construct(){

	}

	public function insertarUsuario($login, $clave, $imagen, $condicion){
		$sql = "INSERT INTO usuario (login, clave, imagen, condicion)
				VALUES ('$login', '$clave', '$imagen', '1')";
		return ejecutarConsulta($sql);
	}

	public function editarUsuario($id_usuario, $login, $clave, $imagen, $condicion){
		$sql = "UPDATE usuario
				SET login = '$login', clave = '$clave', imagen = '$imagen', condicion = '$condicion'
				WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql);
	}

	public function desactivarUsuario($id_usuario){
		$sql = "UPDATE usuario
				SET condicion = '0'
				WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql);
	}

	public function activarUsuario($id_usuario){
		$sql = "UPDATE usuario
				SET condicion = '1'
				WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql);
	}

	public function mostrarUsuario($id_usuario){
	$sql = "SELECT * FROM usuario
			WHERE id_usuario = '$id_usuario'";
	return ejecutarConsultaSimpleFila($sql);
	}

	public function listarUsuario(){
	$sql = "SELECT * FROM usuario";
			
	return ejecutarConsulta($sql);
	}
	




} 
?>