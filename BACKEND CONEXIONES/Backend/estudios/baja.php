<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");
$con = retornarConexion();

$idEstudios = $_GET['idEstudios'];

mysqli_query($con, "DELETE FROM estudios WHERE idEstudios=$idEstudios");

class Result {}

$response = new Result();
$response->resultado = 'OK';
$response->mensaje = 'estudios borrado';

header('Content-Type: application/json');
echo json_encode($response);
?>
