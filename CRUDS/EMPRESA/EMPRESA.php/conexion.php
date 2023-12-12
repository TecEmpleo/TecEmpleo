<?php
function retornarConexion() {
  $con=mysqli_connect("localhost","root","","empresa_crud");
  return $con;
}
?>
