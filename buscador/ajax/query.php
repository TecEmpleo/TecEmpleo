<?php
include '../db.php';

class searchInfo {

    public function getVacantes($nombreCategoria, $conn) {
        $sql = "SELECT V.* ,C.*, E.*
            FROM VACANTES V
            JOIN CATEGORIAS C ON V.Categoria_idCategoria = C.id_categoria
            INNER JOIN empresa E ON E.id_empresa = V.Empresa_id_empresa
            WHERE C.Nombre_Cat = '$nombreCategoria'";
        $result = $conn->query($sql);

        // Verificar si hay filas en el resultado
        if ($result->num_rows > 0) {
            $data = array();
            
            // Iterar sobre las filas y agregarlas al array
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            return $data;
        } else {
            return array(); // Devolver un array vacío si no hay filas
        }
    }  
}

// Crear una instancia de la clase
$searchInfo = new searchInfo();

$infoInput = $_POST['infoInput']; // Asegúrate de que el nombre coincida con los datos que estás enviando
/* $conn = new mysqli("localhost", "usuario", "contraseña", "basededatos"); */
$resultado = $searchInfo->getVacantes($infoInput, $conn);
echo json_encode($resultado);

$conn->close();
?>
