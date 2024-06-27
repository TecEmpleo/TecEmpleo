<?php
include 'db.php';

if (isset($_GET['nombreCategoria'])) {
    $nombreCategoria = $_GET['nombreCategoria'];
    $sql = "SELECT V.* 
            FROM VACANTES V
            JOIN CATEGORIAS C ON V.Categoria_idCategoria = C.id_categoria
            WHERE C.Nombre_Cat = '$nombreCategoria'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container text-center mt-5 mx-auto max-width-xxl"><h1 class="mb-4">Vacantes Disponibles</h1>';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="vacante-card mb-3"><h3 class="vacante-title">ID Vacante: ' . $row['idVacantes'] . '</h3>';


            echo '<p class="vacante-info">Descripción de la vacante: ' . $row['Descripcion_vac'] . '</p>';
            echo '<button class="btn btn-postular">Postular</button></div>';
        }
        echo '</div>';
    } else {
        echo '<p class="text-danger text-center mt-5">No se encontraron vacantes para la categoría \'' . $nombreCategoria . '\'.</p>';
    }
    } else {
        echo '<p class="text-danger text-center mt-5">Se requiere un nombre de categoría para realizar la búsqueda.</p>';
    }
    

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacantes Disponibles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css" integrity="sha384-b1vbLQXJHv0hBLW1gI+5kGQOFLJf5fuTtcBHTOKjQcPD6JbqFq2bTtr1o5iq2DkT" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-F4gtAIBk6L4LZG4znqcu5feS1k8sYkV5iFfyo2CpfUpLjS+Q/K64cuol2ZLe9twA" crossorigin="anonymous"></script> -->
</body>
</html>
