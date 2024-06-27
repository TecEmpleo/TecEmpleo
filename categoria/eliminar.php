<?php
include 'conexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_categoria = $_GET['id'];
    
    if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
        $sql = "DELETE FROM categorias WHERE id_categoria = $id_categoria"; 
        if ($conn->query($sql) === TRUE) {
            header("Location: categorias.php");
            exit;
        } else {
            echo "Error al eliminar la categoría: " . $conn->error;
        }
    }
} else {
    echo "ID de categoría no válido.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Categoría</title>
    <link rel="stylesheet" href="estilo2.css">
</head>
<body>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="container">
        <h1>Eliminar Categoría</h1>
        <p>¿Seguro que desea eliminar esta categoría?</p>
        <p><a href="categorias.php">Cancelar</a> | <a href="eliminar.php?id=<?php echo $id_categoria; ?>&confirm=1">Confirmar</a></p>
    </div>
</body>
</html>
