<?php
include 'conexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_vacante = $_GET['id'];
    
    if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
        $sql = "DELETE FROM vacantes WHERE idVacantes = $id_vacante"; 
        if ($conn->query($sql) === TRUE) {
            header("Location: vacante.php");
            exit;
        } else {
            echo "Error al eliminar la vacante: " . $conn->error;
        }
    }
} else {
    echo "ID de vacante no válido.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Vacante</title>
    <link rel="stylesheet" href="../cssPanel/vacante.css">
</head>
<body>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="container">
        <h1>Eliminar Vacante</h1>
        <p>¿Seguro que desea eliminar esta vacante?</p>
        <p><a href="vacante.php">Cancelar</a> | <a href="eliminarc.php?id=<?php echo $id_vacante; ?>&confirm=1">Confirmar</a></p>
    </div>
</body>
</html>
