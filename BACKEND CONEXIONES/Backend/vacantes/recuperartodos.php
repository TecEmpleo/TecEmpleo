<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $con = retornarConexion();

  $registros = mysqli_query($con, "SELECT idVacantes, Categoria_idCategoria, Empresa_idEmpresa, Descripcion_vac, Fecha_Publicacion, Fecha_Cierre, Estado FROM vacantes");
  
  $vec = [];  
  while ($reg = mysqli_fetch_array($registros))  
  {
    $vec[] = $reg;
  }
  
  $cad = json_encode($vec);
  header('Content-Type: application/json');
  echo $cad;
?>
