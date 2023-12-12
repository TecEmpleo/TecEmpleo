<?php 
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");
$con = retornarConexion();

$idVacantes = $_GET['idVacantes']; // Asegúrate de que 'idVacantes' sea el nombre correcto

$query = "DELETE FROM vacantes WHERE idVacantes = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $idVacantes);

if ($stmt->execute()) {
    class Result {}
    $response = new Result();
    $response->resultado = 'OK';
    $response->mensaje = 'Vacante eliminada';
} else {
    class Result {}
    $response = new Result();
    $response->resultado = 'Error';
    $response->mensaje = 'Error al eliminar la vacante';
}

$stmt->close();
$con->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
