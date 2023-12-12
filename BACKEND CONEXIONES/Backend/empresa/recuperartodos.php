<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");
$con = retornarConexion();

$registros = mysqli_query($con, "SELECT id_empresa, Ciudad_emp, Direccion_emp, Email_emp, Telefono_emp, Nom_emp FROM empresa");

$vec = [];
while ($reg = mysqli_fetch_array($registros)) {
    $vec[] = $reg;
}

$cad = json_encode($vec);
header('Content-Type: application/json');
echo $cad;
?>
