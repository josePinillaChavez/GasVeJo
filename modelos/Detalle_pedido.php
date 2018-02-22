<?php
require "../config/Conexion.php";

Class Detalle_pedido{
	public function __construct(){

	}

	public function insertarDetallePedido($cantidad, $precio_total_pedido, $pedido_id_pedido, $gas_id_gas){
		$sql = "INSERT INTO detalle_pedido (cantidad, precio_total_pedido, pedido_id_pedido, gas_id_gas)
				VALUES ('$cantidad', '$cantidad', '$precio_total_pedido', '$pedido_id_pedido', '$gas_id_gas')";
		return ejecutarConsulta($sql);
	}

	public function editarDetallePedido($id_detalle_pedido, $cantidad, $precio_total_pedido, $pedido_id_pedido, $gas_id_gas){
		$sql = "UPDATE detalle_pedido
				SET cantidad = '$cantidad', precio_total_pedido = '$precio_total_pedido', pedido_id_pedido = '$pedido_id_pedido', gas_id_gas = '$gas_id_gas'
				WHERE id_detalle_pedido = '$id_detalle_pedido'";
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

	public function mostrarPedido($id_detalle_pedido){
	$sql = "SELECT * FROM detalle_pedido
			WHERE id_detalle_pedido = '$id_detalle_pedido'";
	return ejecutarConsultaSimpleFila($sql);
	}

	public function listarGas(){
	$sql = "SELECT d.id_detalle_pedido, d.cantidad, d.precio_total_pedido, d.pedido_id_pedido, d.gas_id_gas 
			FROM detalle_pedido d 
			INNER JOIN pedido p 
			ON d.pedido_id_pedido = p.pedido_id_pedido
			INNER JOIN gas g 
			ON d.gas_id_gas = g.id_gas ";
			
	return ejecutarConsulta($sql);
	}




} 
?>