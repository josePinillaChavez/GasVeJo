<?php
require "../config/Conexion.php";

Class Gas{
	public function __construct(){

	}

	public function insertarGas($descripcion_gas, $kilos, $valor,$imagen){
		$sql = "INSERT INTO gas (descripcion_gas,kilos,valor,imagen)
				VALUES ('$descripcion_gas','$kilos','$valor','$imagen')";
		return ejecutarConsulta($sql);
	}

	public function editarGas($id_gas,$descripcion_gas,$kilos,$valor,$imagen){
		   $sql = "UPDATE gas SET descripcion_gas='$id_gas',kilos='$kilos',valor='$valor',imagen='$imagen'
        WHERE id_gas='$id_gas'";
		return ejecutarConsulta($sql);
	}

	/*public function desactivarGas($id_gas){
		$sql = "UPDATE gas
				SET estado = 'DESHABILITADO'
				WHERE id_gas = '$id_gas'";
		return ejecutarConsulta($sql);
	}

	public function desactivarGas($id_gas){
		$sql = "UPDATE gas
				SET estado = 'HABILITADO'
				WHERE id_gas = '$id_gas'";
		return ejecutarConsulta($sql);
	}/*/

	public function mostrarGas($id_gas){
	$sql = "SELECT * FROM gas
			WHERE id_gas = '$id_gas'";
	return ejecutarConsultaSimpleFila($sql);
	}

	public function listarGas(){
	$sql = "SELECT * FROM gas";
			
	return ejecutarConsulta($sql);
	}

	public function select(){
	$sql = "SELECT * FROM gas";
			
	return ejecutarConsulta($sql);
	}




} 
?>