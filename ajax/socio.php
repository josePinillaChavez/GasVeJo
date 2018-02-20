<?php

require_once "../modelos/Socio.php";
$socio = new Socio();

$rut_soc = isset($_POST["rut_soc"])? limpiarCadena($_POST["rut_soc"]):"";
$dv_soc = isset($_POST["dv_soc"])? limpiarCadena($_POST["dv_soc"]):"";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$fechaIngreso = isset($_POST["fechaIngreso"])? limpiarCadena($_POST["fechaIngreso"]):"";
$region = isset($_POST["region"])? limpiarCadena($_POST["region"]):"";
$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$estado = isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$user_type = isset($_POST["user_type"])? limpiarCadena($_POST["user_type"]):"";

switch ($_GET["op"]) {
        case 'guardar':
          # code...
            $respuesta=$socio->insertarSocio($rut_soc,$dv_soc,$nombre,$fechaIngreso,$region,$telefono,$estado,$user_type);
            echo $respuesta ? "socio registrado":"no se pudo registrar";
          break;
    case 'editar':

            $respuesta=$socio->editarSocio($rut_soc,$dv_soc,$nombre,$fechaIngreso,$region,$telefono,$estado,$user_type);
            echo $respuesta ? "editado con exito":"no se pudo editar";
        
        break;
    case 'desactivar':
            $respuesta=$socio->desactivarSocio($rut_soc);
            echo $respuesta ? "desactivado con exito":"no se pudo descativar";  

        break;
    case 'activar':
            $respuesta=$socio->activarSocio($rut_soc);
            echo $respuesta ? "activado con exito":"no se pudo activar";
        break;
    case 'mostrar':        
            $respuesta=$socio->mostrarSocio($rut_soc);
            echo json_encode($respuesta);
        break;
    case 'listar':
            $respuesta=$socio->listarSocio();
            $data= Array();
            while ($reg=$respuesta->fetch_object()) {
               $data[]=array(
                   "0"=>($reg->estado)?'<butonn class="btn btn-warning" onclick="mostrar('.$reg->rut_soc.')"><i class="fa fa-pencil"></i></butonn>'.
                    ' <butonn class="btn btn-danger" onclick="desactivar('.$reg->rut_soc.')"><i class="fa fa-close"></i></butonn>':
                    '<butonn class="btn btn-warning" onclick="mostrar('.$reg->rut_soc.')"><i class="fa fa-pencil"></i></butonn>'.
                    ' <butonn class="btn btn-info" onclick="ativar('.$reg->rut_soc.')"><i class="fa fa-check"></i></butonn>',
                   "1"=>$reg->dv_soc,
                   "2"=>$reg->nombre,
                   "3"=>$reg->fechaIngreso,
                   "4"=>$reg->region,
                   "5"=>$reg->telefono,
                   "6"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
                   '<span class="label bg-red">desactivado</span>',
                   "7"=>$reg->user_type
               );
            }
           $resultados = array(
               "sEcho"=>1,
               "iTotalRecords"=>count($data),
               "iTotalDisplayRecords"=>count($data),
               "aaData"=>$data);

               echo json_encode($resultados);
        break;
  
}

?>