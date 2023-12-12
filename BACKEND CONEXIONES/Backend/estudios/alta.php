<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json);

require("conexion.php");
$con = retornarConexion();

mysqli_query($con, "INSERT INTO estudios (Estudios_universitarios, Estudios_Primaria, Estudios_Segundaria, Otros_Estudios) VALUES ('$params->Estudios_universitarios', '$params->Estudios_Primaria', '$params->Estudios_Segundaria', '$params->Otros_Estudios')");

class Result {}

$response = new Result();
$response->resultado = 'OK';
$response->mensaje = 'datos grabados';

header('Content-Type: application/json');
echo json_encode($response);
?>
