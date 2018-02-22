<?php
require "../config/Conexion.php";

Class Usuario_permiso{
	public function __construct(){

	}

	public function mostrarUsuarioPermiso($id_permiso){
	$sql = "SELECT * FROM usuario_permiso
			WHERE id_permiso = '$id_permiso'";
	return ejecutarConsultaSimpleFila($sql);
	}

	public function listarUsuarioPermiso(){
	$sql = "SELECT up.id_permiso, up.permiso_id_permiso, up.usuario_id_usuario 
			FROM usuario_permiso up 
			INNER JOIN tipo_permiso t
			ON t.id_tipo_permiso = up.permiso_id_permiso
			INNER JOIN usuario u 
			ON  u.id_usuario = up.usuario_id_usuario ";
			
	return ejecutarConsulta($sql);
	}




} 
?>