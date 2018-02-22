<?php 
require_once "../modelos/Usuario_permiso.php";

$usuario_permiso = new Usuario_permiso();

$id_permiso = isset($_POST["id_permiso"])? limpiarCadena($_POST["id_permiso"]):"";
$permiso_id_permiso = isset($_POST["permiso_id_permiso"])? limpiarCadena($_POST["permiso_id_permiso"]):"";
$usuario_id_usuario = isset($_POST["usuario_id_usuario"])? limpiarCadena($_POST["usuario_id_usuario"]):"";



switch ($_GET["op"]) {
		
	case 'mostrar':
		$respuesta=$tipo_permiso->mostrarTipoPermiso($id_permiso);
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta=$gas->listarPermiso();
		//array
		$data = Array();

		while ($reg=$respuesta->fetch_object()){
			$data[] = array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_permiso.')"><i class="fa fa-pencil"></i></button>',
				"1"=>$reg->permiso_id_permiso,
				"2"=>$reg->usuario_id_usuario
				
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