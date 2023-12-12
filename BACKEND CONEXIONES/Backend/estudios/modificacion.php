<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

mysqli_query($con, "UPDATE estudios SET Estudios_universitarios='$params->Estudios_universitarios', Estudios_Primaria='$params->Estudios_Primaria', Estudios_Segundaria='$params->Estudios_Segundaria', Otros_Estudios='$params->Otros_Estudios' WHERE idEstudios=$params->idEstudios");

class Result {}

$response = new Result();
$response->resultado = 'OK';
$response->mensaje = 'datos modificados';

header('Content-Type: application/json');
echo json_encode($response);
?>
