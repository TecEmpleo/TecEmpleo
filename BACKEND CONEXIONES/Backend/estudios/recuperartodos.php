<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");
$con = retornarConexion();

$registros = mysqli_query($con, "SELECT idEstudios, Estudios_universitarios, Estudios_Primaria, Estudios_Segundaria, Otros_Estudios FROM estudios");
$vec = [];

while ($reg = mysqli_fetch_array($registros)) {
    $vec[] = $reg;
}

$cad = json_encode($vec);
header('Content-Type: application/json');
echo $cad;
?>
