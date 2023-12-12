<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  $json = file_get_contents('php://input');
  $params = json_decode($json);
  
  require("conexion.php");
  $con = retornarConexion();
  
  $sql = "UPDATE empresa SET Ciudad_emp=?, Direccion_emp=?, Email_emp=?, Telefono_emp=?, Nom_emp=? WHERE id_empresa=?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("sssssi", $params->Ciudad_emp, $params->Direccion_emp, $params->Email_emp, $params->Telefono_emp, $params->Nom_emp, $params->id_empresa);

  if ($stmt->execute()) {
    class Result {}
    $response = new Result();
    $response->resultado = 'OK';
    $response->mensaje = 'Datos modificados';
  } else {
    class Result {}
    $response = new Result();
    $response->resultado = 'Error';
    $response->mensaje = 'Error al modificar los datos: ' . $stmt->error;
  }

  $stmt->close();
  $con->close();

  header('Content-Type: application/json');
  echo json_encode($response);  
?>
