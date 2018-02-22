<?php 
require_once "../modelos/Pedido.php";

$pedido = new Pedido();

$id_pedido = isset($_POST["id_pedido"])? limpiarCadena($_POST["id_pedido"]):"";
$cantidad = isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$total_pedido = isset($_POST["total_pedido"])? limpiarCadena($_POST["total_pedido"]):"";
$total_kilos_pedidos = isset($_POST["total_kilos_pedidos"])? limpiarCadena($_POST["total_kilos_pedidos"]):"";
$estado = isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$usuario_id_usuario = isset($_POST["usuario_id_usuario"])? limpiarCadena($_POST["usuario_id_usuario"]):"";
$gas_id_gas = isset($_POST["gas_id_gas"])? limpiarCadena($_POST["gas_id_gas"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($id_pedido)) {
			$respuesta = $pedido->insertarPedido($cantidad, $total_pedido, $total_kilos_pedidos, $estado, $usuario_id_usuario, $gas_id_gas);
			echo $respuesta ? "Pedido registrado" : "El pedido no se pudo registrar";
		}else{
			$respuesta = $pedido->editarPedido($id_pedido, $cantidad, $total_pedido, $total_kilos_pedidos, $estado, $usuario_id_usuario, $gas_id_gas);
			echo $respuesta ? "Pedido actualizado" : "El pedido no se ha podido actualizar";
		}
		break;
	
	case 'mostrar':
		$respuesta=$pedido->mostrarPedido($id_pedido);
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta=$pedido->listarPedido();
		//array
		$data = Array();

		while ($reg=$respuesta->fetch_object()){
			$data[] = array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_pedido.')"><i class="fa fa-pencil"></i></button>',
				"1"=>$reg->cantidad,
				"2"=>$reg->total_pedido,
				"3"=>$reg->total_kilos_pedidos,
				"4"=>$reg->estado,
				"5"=>$reg->usuario_id_usuario,
				"6"=>$reg->gas_id_gas

			);
		}
		
		$resultados = array(
			"sEcho"=>1,//informacion para el datatable
			"iTotalRecords"=>count($data),//enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=> $data);
		echo json_encode($resultados);
		break;

		case "selectGas":
		require_once "../modelos/Gas.php";
		$gas = new Gas();
		$respuesta = $gas->select();

		while($reg = $respuesta->fetch_object()){
			echo '<option value=' . $reg->id_gas . '>' . $reg->descripcion_gas . '</option>';
		}


	
}

 ?>