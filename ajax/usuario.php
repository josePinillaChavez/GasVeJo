<?php 
session_start();
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
	 $clavehash=hash("SHA256",$clave);
		if (empty($id_usuario)) {
			$respuesta = $usuario->insertarUsuario($login, $clavehash, $imagen, $condicion,$_POST['permiso']);
			echo $respuesta ? "Usuario registrado" : "Usuario no se pudo registrar";
		}else{
			$respuesta = $usuario->editarUsuario($id_usuario, $login, $clavehash, $imagen, $condicion);
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
		
		case 'permisos':
			require_once "../modelos/Tipo_Permiso.php";
			$permiso = new Tipo_Permiso(); 
			$rspta = $permiso->listarTipoPermiso();	

			while ($reg = $rspta->fetch_object()) {
					echo '<li> <input type="checkbox" name="permiso[] value="'.$reg->id_tipo_permiso.'">'.$reg->nombre.'</li>';
				}	
		break;

		case 'verificar':
			
			$logina=$_POST['logina'];
			$calvea=$_POST['clavea'];

			$clavehash = hash("SHA256",$calvea);

			$rspta=$usuario->verificar($logina,$clavehash);

			$fetsh=$rspta->fetch_object();
			if (isset($fetsh)) {

				$_SESSION['imagen']=$fetsh->imagen;
				$_SESSION['telefono']=$fetsh->telefono;
                $_SESSION['id_usuario']=$fetsh->id_usuario;
				$_SESSION['rut_soc']=$fetsh->rut_soc;
				$_SESSION['id_usuario']=$fetsh->id_usuario;
				$_SESSION['rut_soc']=$fetsh->rut_soc;
				$_SESSION['clave']=$fetsh->clave;
				$_SESSION['condicion']=$fetsh->condicion;
				$_SESSION['nombre']=$fetsh->nombre;

				$marcados = $usuario->listarmarcados($fetsh->id_usuario);
					
				$valores=Array();
				while ($per = $marcados->fetch_object()) {
					array_push($valores,$per->id_permiso);
				}
				in_array(7,$valores)?$_SESSION['ADMINISTRADO']=1:$_SESSION['ADMINISTRADO']=0;
				in_array(8,$valores)?$_SESSION['SOCIO']=1:$_SESSION['SOCIO']=0;
			}
			echo json_encode($fetsh);



		break;
	
}

 ?>