<?php 
require_once "../modelos/Detalle_pedido.php";

$detalle_pedido = new Detalle_pedido();

$id_detalle_pedido = isset($_POST["id_detalle_pedido"])? limpiarCadena($_POST["id_detalle_pedido"]):"";
$cantidad = isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$precio_total_pedido = isset($_POST["precio_total_pedido"])? limpiarCadena($_POST["precio_total_pedido"]):"";
$pedido_id_pedido = isset($_POST["pedido_id_pedido"])? limpiarCadena($_POST["pedido_id_pedido"]):"";
$gas_id_gas = isset($_POST["gas_id_gas"])? limpiarCadena($_POST["gas_id_gas"]):"";


switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($id_detalle_pedido)) {
			$respuesta = $detalle_pedido->insertarDetallePedido($cantidad, $precio_total_pedido, $pedido_id_pedido, $gas_id_gas);
			echo $respuesta ? "Detalle pedido registrado" : "Detalle pedido no se pudo registrar";
		}else{
			$respuesta = $gas->editarDetallePedido($id_detalle_pedido, $cantidad, $precio_total_pedido, $pedido_id_pedido, $gas_id_gas);
			echo $respuesta ? "Detalle pedido actualizado" : "Detalle pedido no se ha podido actualizar";
		}
		break;
	
	case 'mostrar':
		$respuesta=$detalle_pedido->mostrarGas($id_detalle_pedido);
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta=$detalle_pedido->listarDetallePedido();
		//array
		$data = Array();

		while ($reg=$respuesta->fetch_object()){
			$data[] = array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_detalle_pedido.')"><i class="fa fa-pencil"></i></button>',
				"1"=>$reg->cantidad,
				"2"=>$reg->precio_total_pedido,
				"3"=>$reg->pedido_id_pedido,
				"4"=>$reg->gas_id_gas
			);
		}
		$resultados = array(
			"sEcho"=>1,//informacion para el datatable
			"iTotalRecords"=>count($data),//enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=> $data);
		echo json_encode($resultados);
		break;

	
}

 ?>