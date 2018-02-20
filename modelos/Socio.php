<?php
require "../config/Conexion.php";


class Socio
{
    public function __construct(){

    }

    public function insertarSocio($rut_soc,$dv_soc,$nombre,$fechaIngreso,$region,$telefono,$estado,$user_type){

        $sql = "INSERT INTO socio (rut_soc,dv_soc,nombre,fechaIngreso,region,telefono,estado,user_type)
        VALUES ('$rut_soc','$dv_soc','$nombre','$fechaIngreso','$region','$telefono','$estado','$user_type')";
        return ejecutarConsulta($sql);
    }
    public function editarSocio($rut_soc,$dv_soc,$nombre,$fechaIngreso,$region,$telefono,$estado,$user_type){
        $sql = "UPDATE socio SET rut_soc='$rut_soc',dv_soc='$dv_soc',nombre='$nombre',fechaIngreso='$fechaIngreso',region='$region',telefono='$telefono',estado='$estado',user_type='$user_type'
        WHERE rut_soc='$rut_soc'";

        return ejecutarConsulta($sql);
    }

    public function desactivarSocio($rut_soc){
        $sql="UPDATE socio SET estado='0' WHERE rut_soc='$rut_soc'";

        
        return ejecutarConsulta($sql);
    }
   
    public function activarSocio($rut_soc){
        $sql="UPDATE socio SET estado='1' WHERE rut_soc='$rut_soc'";

        
        return ejecutarConsulta($sql);
    }
    public function jubilarSocio($rut_soc){
        $sql="UPDATE socio SET estado='JUBILADO' WHERE rut_soc='$rut_soc'";

        
        return ejecutarConsulta($sql);
    }

    public function mostrarSocio($rut_soc){
      $sql="SELECT * FROM socio WHERE rut_soc='$rut_soc'";
      return ejecutarConsultaSimpleFila($sql);
    }

    public function listarSocio(){
        $sql="SELECT * FROM socio";
        return ejecutarConsulta($sql);
    }


}

?>