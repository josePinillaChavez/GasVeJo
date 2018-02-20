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
          # code...
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
          $imagen="";
        }
        else{
          $ext = explode(".", $_FILES["imagen"]["name"]);
          if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png") {
            $imagen = round(microtime(true)) . '.' . end($ext0);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], "..files/gas/".$imagen);
          }
        }
        if (empty($id_gas)) {
          # code...
           $respuesta=$gas->insertarGas($descripcion_gas,$kilos,$valor,$imagen);
            echo $respuesta ? "Gas registrado":"no se pudo registrar";
        }
        else{
           $respuesta=$gas->editarGas($id_gas,$descripcion_gas,$kilos,$valor,$imagen);
            echo $respuesta ? "editado con exito":"no se pudo editar";

        } 
  
    case 'mostrar':        
            $respuesta=$gas->mostrarGas($id_gas);
            echo json_encode($respuesta);
        break;
    case 'listar':
            $respuesta=$gas->listarGas();
            $data= Array();
            while ($reg=$respuesta->fetch_object()) {
               $data[]=array(                                
                   "0"=>$reg->descripcion_gas,
                   "1"=>$reg->kilos,
                   "2"=>$reg->valor,
                   "3"=>"<img src='../files/gas/".$reg->imagen."' height='50px' width='50px'>"
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