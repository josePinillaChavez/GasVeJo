<?php 
require_once "../modelos/Tipo_permiso.php";

$tipo_permiso = new Tipo_permiso();

$id_tipo_permiso = isset($_POST["id_tipo_permiso"])? limpiarCadena($_POST["id_tipo_permiso"]):"";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($id_tipo_permiso)) {
			$respuesta = $tipo_permiso->insertarTipoPermiso($descripcion_gas, $nombre);
			echo $respuesta ? "Tipo de permiso registrado" : "Tipo de permiso  no se pudo registrar";
		}else{
			$respuesta = $tipo_permiso->editarTipoPermiso($id_tipo_permiso, $nombre);
			echo $respuesta ? "Tipo de permiso actualizado" : "Tipo de permiso no se ha podido actualizar";
		}
		break;
	
	case 'mostrar':
		$respuesta=$tipo_permiso->mostrarTipoPermiso($id_tipo_permiso);
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta=$tipo_permiso->listarTipoPermiso();
		//array
		$data = Array();

		while ($reg=$respuesta->fetch_object()){
			$data[] = array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_tipo_permiso.')"><i class="fa fa-pencil"></i></button>',
				"1"=>$reg->nombre
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