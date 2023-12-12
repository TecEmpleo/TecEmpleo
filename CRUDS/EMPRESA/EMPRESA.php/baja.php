<?php 
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");
$con = retornarConexion();


$id_empresa = $_GET['codigo']; 

$query = "DELETE FROM empresa WHERE id_empresa = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id_empresa);

if ($stmt->execute()) {
    class Result {}
    $response = new Result();
    $response->resultado = 'OK';
    $response->mensaje = 'Empresa eliminada';
} else {
    class Result {}
    $response = new Result();
    $response->resultado = 'Error';
    $response->mensaje = 'Error al eliminar la empresa';
}

$stmt->close();
$con->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
