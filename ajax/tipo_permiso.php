<?php 
require_once "../modelos/Tipo_permiso.php";

$tipo_permiso = new Tipo_permiso();

switch ($_GET["op"]) {
	
	case 'listar':
		$respuesta=$tipo_permiso->listarTipoPermiso();
		//array
		$data = Array();

		while ($reg=$respuesta->fetch_object()){
			$data[] = array(
				"0"=>$reg->nombre
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