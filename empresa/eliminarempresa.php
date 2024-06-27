<?php
include 'conexionempresa.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_empresa = $_GET['id'];
    
    if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
        $sql = "DELETE FROM empresa WHERE id_empresa = $id_empresa"; 
        if ($conn->query($sql) === TRUE) {
            header("Location: empresa.php");
            exit;
        } else {
            echo "Error al eliminar la empresa: " . $conn->error;
        }
    }
} else {
    echo "ID de empresa no válido.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Empresa</title>
    <link rel="stylesheet" href="../cssPanel/empresa.css">
</head>
<body>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="container">
        <h1>Eliminar Empresa</h1>
        <p>¿Seguro que desea eliminar esta empresa?</p>
        <p><a href="empresa.php">Cancelar</a> | <a href="eliminarempresa.php?id=<?php echo $id_empresa; ?>&confirm=1">Confirmar</a></p> 
</body>
</html>
