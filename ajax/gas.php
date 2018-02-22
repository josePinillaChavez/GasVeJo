<?php 
require_once "../modelos/Gas.php";

$gas = new Gas();

$id_gas = isset($_POST["id_gas"])? limpiarCadena($_POST["id_gas"]):"";
$descripcion_gas = isset($_POST["descripcion_gas"])? limpiarCadena($_POST["descripcion_gas"]):"";
$kilos = isset($_POST["kilos"])? limpiarCadena($_POST["kilos"]):"";
$valor = isset($_POST["valor"])? limpiarCadena($_POST["valor"]):"";
$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";


switch ($_GET["op"]) {
	case 'guardaryeditar':
	  if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
          $imagen=$_POST["imagenactual"];
        }
        else{
          $ext = explode(".", $_FILES["imagen"]["name"]);
          if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png") {
            $imagen = round(microtime(true)) . '.' . end($ext);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/gas/".$imagen);
          }
        }

		if (empty($id_gas)) {
			$respuesta = $gas->insertarGas($descripcion_gas, $kilos, $valor);
			echo $respuesta ? "Gas registrado" : "Gas no se pudo registrar";
		}else{
			$respuesta = $gas->editarGas($id_gas, $descripcion_gas, $kilos, $valor);
			echo $respuesta ? "Gas actualizado" : "Gas no se ha podido actualizar";
		}
		break;
	
	case 'mostrar':
		$respuesta=$gas->mostrarGas($id_gas);
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta=$gas->listarGas();
		//array
		$data = Array();

		while ($reg=$respuesta->fetch_object()){
			$data[] = array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_gas.')"><i class="fa fa-pencil"></i></button>',
				"1"=>$reg->descripcion_gas,
				"2"=>$reg->kilos,
				"3"=>$reg->valor,
				"4"=>"<img src='../files/gas/".$reg->imagen."' height='50px' width='50px'>"
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