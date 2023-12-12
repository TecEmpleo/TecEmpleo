<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  $json = file_get_contents('php://input');
 
  $params = json_decode($json);
  
  require("conexion.php");
  $con = retornarConexion();
  
  mysqli_query($con, "INSERT INTO vacantes(Categoria_idCategoria, Empresa_idEmpresa, Descripcion_vac, Fecha_Publicacion, Fecha_Cierre, Estado) VALUES
                  ('$params->Categoria_idCategoria', '$params->Empresa_idEmpresa', '$params->Descripcion_vac', '$params->Fecha_Publicacion', '$params->Fecha_Cierre', '$params->Estado')");
    
  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'datos grabados';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>
