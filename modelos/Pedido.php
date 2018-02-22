<?php
require "../config/Conexion.php";

Class Pedido{
	public function __construct(){

	}

	public function insertarPedido($cantidad, $total_pedido, $total_kilos_pedidos, $estado, $usuario_id_usuario, $gas_id_gas){
		$sql = "INSERT INTO pedido (cantidad, total_pedido, total_kilos_pedidos, estado, usuario_id_usuario, gas_id_gas )
				VALUES ('$cantidad', '$total_pedido', '$total_kilos_pedidos', '1', '$usuario_id_usuario','$gas_id_gas')";
		return ejecutarConsulta($sql);
	}

	public function editarPedido($id_pedido, $cantidad, $total_pedido, $total_kilos_pedidos, $estado, $usuario_id_usuario, $gas_id_gas){
		$sql = "UPDATE pedido
				SET cantidad = '$cantidad', total_pedido = '$total_pedido', total_kilos_pedidos = '$total_kilos_pedidos', estado = '$estado', usuario_id_usuario = '$usuario_id_usuario', gas_id_gas = '$gas_id_gas' 
				WHERE id_pedido = '$id_pedido'";
		return ejecutarConsulta($sql);
	}

	public function desactivarPedido($id_pedido){
		$sql = "UPDATE pedido
				SET estado = '0'
				WHERE id_pedido = '$id_pedido'";
		return ejecutarConsulta($sql);
	}

	public function activarPedido($id_pedido){
		$sql = "UPDATE pedido
				SET estado = '1'
				WHERE id_pedido = '$id_pedido'";
		return ejecutarConsulta($sql);
	}

	public function mostrarPedido($id_pedido){
	$sql = "SELECT * FROM pedido
			WHERE id_pedido = '$id_pedido'";
	return ejecutarConsultaSimpleFila($sql);
	}

	public function listarPedido(){
	$sql = "SELECT p.id_pedido, p.cantidad, p.total_pedido, p.total_kilos_pedidos, p.estado, p.usuario_id_usuario, p.gas_id_gas
			FROM pedido p 
			INNER JOIN usuario u 
			ON p.usuario_id_usuario = u.id_usuario
			INNER JOIN gas g 
			ON g.id_gas = p.gas_id_gas";
			
	return ejecutarConsulta($sql);
	}

	




} 
?>