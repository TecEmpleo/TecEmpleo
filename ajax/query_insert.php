<?php
include '../buscador/db.php';
session_start();

class insertInfo {
    public function insertPostulation ($idVacante,$conn){
        $idUsuario = $_SESSION['id'];
  
        try {
            $verify = "SELECT * FROM postulacion WHERE usuarios_id = $idUsuario AND id_vacante =$idVacante";
           $ejex  = $conn->query($verify);
           $count = 0;
            foreach ($ejex as $key => $value) {
                $count++;
            }
            if($count > 0){
              return "Ya estas postulado en esta vacante";
            }
            $sqlInsert = "INSERT INTO postulacion (usuarios_id, id_vacante) VALUES ($idUsuario, $idVacante)";
            $result = $conn->query($sqlInsert);
            if($result){
                return true;
             } else {
                return "Hubo un error";
             }
     
        } catch (\Throwable $th) {
            return $th;
        }
    }

   
}

$insertInfo = new insertInfo();

$idVacante = $_POST['idVacante'];
$resultado = $insertInfo->insertPostulation($idVacante, $conn);
echo json_encode($resultado);

$conn->close();
?>
