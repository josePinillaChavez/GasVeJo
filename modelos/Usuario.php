<?php
require "../config/Conexion.php";

Class Usuario{
	public function __construct(){

	}

	public function insertarUsuario($login, $clave, $imagen, $condicion,$permisos){
		$sql = "INSERT INTO usuario (login, clave, imagen, condicion)
				VALUES ('$login', '$clave', '$imagen', '1')";
		
		ejecutarConsulta_retornarID($sql);
		$idusuarionew =ejecutarConsulta_retornarID($sql);
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos)) {
			$sql_detalle = "INSERT INTO usuario_permiso (permiso_id_permiso, usuario_id_usuario)
				VALUES ('$permisos[$num_elementos]','$idusuarionew')";
				ejecutarConsulta($sql_detalle) or $sw =false;
			$num_elementos=$num_elementos+1;
		}
				//return ejecutarConsulta($sql);
		return $sw;
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
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuario_permiso WHERE usuario_id_usuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	public function verificar($login,$clave){
		$sql = "SELECT id_usuario,rut_soc,clave , condicion , nombre , imagen , telefono
                FROM usuario u 
                inner join socio s 
                on u.id_usuario = s.usuario_id_usuario
                where login='$login' and clave='$clave'";
				
		return ejecutarConsulta($sql);
		}

} 
?>