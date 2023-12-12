<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  $json = file_get_contents('php://input');
 
  $params = json_decode($json);
  
  require("conexion.php");
  $con = retornarConexion();
  

  mysqli_query($con, "UPDATE vacantes SET Categoria_idCategoria='$params->Categoria_idCategoria',
                                          Empresa_idEmpresa='$params->Empresa_idEmpresa',
                                          Descripcion_vac='$params->Descripcion_vac',
                                          Fecha_Publicacion='$params->Fecha_Publicacion',
                                          Fecha_Cierre='$params->Fecha_Cierre',
                                          Estado='$params->Estado'
                                          WHERE idVacantes=$params->idVacantes");
    
  
  class Result {}

  $response = new Result();
  $response->resultado = 'OK';
  $response->mensaje = 'datos modificados';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>