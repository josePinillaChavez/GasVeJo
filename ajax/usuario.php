<?php 
require_once "../modelos/Usuario.php";

$usuario = new Usuario();

$id_usuario = isset($_POST["id_usuario"])? limpiarCadena($_POST["id_usuario"]):"";
$login = isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave = isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$condicion = isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";



switch ($_GET["op"]) {
	case 'guardaryeditar':
	if(!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name'])){
		$imagen ="";

	}else{
		$ext = explode(".", $_FILES["imagen"]["name"]);
		if ($_FILES['imagen']['type'] == "image/jpg"|| $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
			$imagen = round(microtime(true)) . '.'. end($ext);
			move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
		}
	}
		if (empty($id_usuario)) {
			$respuesta = $usuario->insertarUsuario($login, $clave, $imagen, $condicion);
			echo $respuesta ? "Usuario registrado" : "Usuario no se pudo registrar";
		}else{
			$respuesta = $usuario->editarUsuario($id_usuario, $login, $clave, $imagen, $condicion);
			echo $respuesta ? "Usuario actualizado" : "Usuario no se ha podido actualizar";
		}
		break;
	
	case 'mostrar':
		$respuesta=$usuario->mostrarUsuario($id_usuario);
		echo json_encode($respuesta);
		break;

		  case 'desactivar':
            $respuesta=$usuario->desactivarUsuario($id_usuario);
            echo $respuesta ? "desactivado con exito":"no se pudo descativar";  

        break;
    case 'activar':
            $respuesta=$usuario->activarUsuario($id_usuario);
            echo $respuesta ? "Usuario con exito":"no se pudo activar";
        break;

	case 'listar':
		$respuesta=$usuario->listarUsuario();
		//array
		$data = Array();

		while ($reg=$respuesta->fetch_object()){
			$data[] = array(
				  "0"=>($reg->condicion)?'<butonn class="btn btn-warning" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i></butonn>'.
                    ' <butonn class="btn btn-danger" onclick="desactivar('.$reg->id_usuario.')"><i class="fa fa-close"></i></butonn>':
                    '<butonn class="btn btn-warning" onclick="mostrar('.$reg->id_usuario.')"><i class="fa fa-pencil"></i></butonn>'.
                    ' <butonn class="btn btn-info" onclick="ativar('.$reg->id_usuario.')"><i class="fa fa-check"></i></butonn>',
				"1"=>$reg->login,
				"2"=>$reg->clave,
				"3"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
				"4"=>$reg->condicion,
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