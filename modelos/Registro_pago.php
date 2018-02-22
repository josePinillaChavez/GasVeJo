<?php
require "../config/Conexion.php";

Class Registro_pago{
	public function __construct(){

	}

	public function insertarRegistroPago($comprobante_pago, $num_comprobante, $pedido_id_pedido){
		$sql = "INSERT INTO registro_pago (comprobante_pago, num_comprobante, pedido_id_pedido)
				VALUES ('$comprobante_pago', '$num_comprobante', '$pedido_id_pedido')";
		return ejecutarConsulta($sql);
	}

	public function editarRegistroPago($id_registro_pago, $comprobante_pago, $num_comprobante, $pedido_id_pedido){
		$sql = "UPDATE registro_pago
				SET comprobante_pago = '$comprobante_pago', num_comprobante = '$num_comprobante', pedido_id_pedido = '$pedido_id_pedido'
				WHERE id_registro_pago = '$id_registro_pago'";
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

	public function mostrarRegistroPago($id_registro_pago){
	$sql = "SELECT * FROM registro_pago
			WHERE id_registro_pago = '$id_registro_pago'";
	return ejecutarConsultaSimpleFila($sql);
	}

	public function listarRegistroPago(){
	$sql = "SELECT r.id_registro_pago, r.comprobante_pago, r.num_comprobante, r.pedido_id_pedido
			FROM registro_pago r
			INNER JOIN pedido p 
			ON r.pedido_id_pedido = p.id_pedido";
			
	return ejecutarConsulta($sql);
	}




} 
?>