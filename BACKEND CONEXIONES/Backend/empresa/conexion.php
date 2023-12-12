<?php
function retornarConexion() {
  $con=mysqli_connect("localhost","root","","tecempleo");
  return $con;
}
?>
