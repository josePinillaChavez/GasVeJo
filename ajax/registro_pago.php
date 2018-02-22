<?php 
require_once "../modelos/Registro_pago.php";

$registro_pago = new Registro_pago();

$id_registro_pago = isset($_POST["id_registro_pago"])? limpiarCadena($_POST["id_registro_pago"]):"";
$comprobante_pago = isset($_POST["comprobante_pago"])? limpiarCadena($_POST["comprobante_pago"]):"";
$num_comprobante = isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$pedido_id_pedido = isset($_POST["pedido_id_pedido"])? limpiarCadena($_POST["pedido_id_pedido"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if(!file_exists($_FILES['comprobante_pago']['tmp_name'])|| !is_uploaded_file($_FILES['comprobante_pago']['tmp_name'])){
		$comprobante_pago ="";

	}else{
		$ext = explode(".", $_FILES["comprobante_pago"]["name"]);
		if ($_FILES['comprobante_pago']['type'] == "comprobante_pago/jpg"|| $_FILES['comprobante_pago']['type'] == "comprobante_pago/jpeg" || $_FILES['comprobante_pago']['type'] == "comprobante_pago/png") {
			$comprobante_pago = round(microtime(true)) . '.'. end($ext);
			move_uploaded_file($_FILES["comprobante_pago"]["tmp_name"], "../files/registrosPagos/" . $comprobante_pago);
		}
	}

		if (empty($id_registro_pago)) {
			$respuesta = $registro_pago->insertarRegistroPago($comprobante_pago, $num_comprobante, $pedido_id_pedido);
			echo $respuesta ? "Registro de pago registrado" : "Registro de pago no se pudo registrar";
		}else{
			$respuesta = $registro_pago->editarRegistroPago($id_registro_pago, $comprobante_pago, $num_comprobante, $pedido_id_pedido);
			echo $respuesta ? "Registro de pago actualizado" : "Registro de pago no se ha podido actualizar";
		}
		break;
	
	case 'mostrar':
		$respuesta=$registro_pago->mostrarRegistroPago($id_registro_pago);
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta=$registro_pago->listarRegistroPago();
		//array
		$data = Array();

		while ($reg=$respuesta->fetch_object()){
			$data[] = array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_registro_pago.')"><i class="fa fa-pencil"></i></button>',
				"1"=>"<img src='../files/registrosPagos/".$$reg->comprobante_pago."' height='50px' width='50px'>",
				"2"=>$reg->num_comprobante,
				"3"=>$reg->pedido_id_pedido
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