<?php
require_once "conexion.php";
$conexion = conexion();

$e=$_POST['estado'];
$ea=$_POST['estado_antiguo'];
$r=$_POST['rut'];
$fi=$_POST['fecha_inicio'];
$fia=$_POST['fechai_antigua'];
$ft=$_POST['fecha_termino'];
$obs=$_POST['obs'];

$sql = "UPDATE estado_persona set Cod_Estado = '$e',
                Rut_Persona = '$r',
                Fecha_Inicio_Estado_Persona = '$fi',
                Fecha_Termino_Estado = '$ft',
                Obs_Estado_Persona = '$obs'
      where Cod_Estado = '$ea'
        and Fecha_Inicio_Estado_Persona = '$fia'
        and Rut_Persona = '$r'";

echo $result=mysqli_query($conexion,$sql);
?>
