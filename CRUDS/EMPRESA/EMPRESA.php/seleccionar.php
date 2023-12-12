<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $con = retornarConexion();

  $id_empresa = $_GET['id_empresa']; 

  $registros = mysqli_query($con, "SELECT * FROM empresa WHERE id_empresa=$id_empresa");
  
  $vec = [];  
  if ($reg = mysqli_fetch_array($registros))  
  {
    $empresa = array(
      'id_empresa' => $reg['id_empresa'],
      'Ciudad_emp' => $reg['Ciudad_emp'],
      'Direccion_emp' => $reg['Direccion_emp'],
      'Email_emp' => $reg['Email_emp'],
      'Telefono_emp' => $reg['Telefono_emp'],
      'Nom_emp' => $reg['Nom_emp']
    );
    
    $vec[] = $empresa;
  }
  
  $cad = json_encode($vec);
  header('Content-Type: application/json');
  echo $cad;
?>
