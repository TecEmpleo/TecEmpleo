<?php 
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input');
$params = json_decode($json, true);

if (
    isset($params['id_empresa']) &&
    isset($params['Ciudad_emp']) &&
    isset($params['Direccion_emp']) &&
    isset($params['Telefono_emp']) &&
    isset($params['Email_emp'])
) {
    require("conexion.php");
    $conn = retornarConexion();

    if ($conn) {
        $stmt = $conn->prepare("INSERT INTO empresa (id_empresa, Ciudad_emp, Direccion_emp, Email_emp, Telefono_emp, Nom_emp) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $params['id_empresa'], $params['Ciudad_emp'], $params['Direccion_emp'], $params['Email_emp'], $params['Telefono_emp'], $params['Nom_emp']);
        
        if ($stmt->execute()) {
            class Result {}
            $response = new Result();
            $response->resultado = 'OK';
            $response->mensaje = 'datos grabados';

            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
           
        }

        $conn->close();
    } else {
       
    }
} else {
 
}
?>
