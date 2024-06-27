<?php
include 'conexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_categoria = $_GET['id'];
    
    // Utilizar sentencias preparadas para evitar la inyección de SQL
    $sql = "SELECT * FROM categorias WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validar y limpiar los datos recibidos
            $nombreCategoria = htmlspecialchars($_POST["nombreCategoria"]);
            $descripcion = htmlspecialchars($_POST["descripcion"]);
            
            // Utilizar sentencias preparadas para evitar la inyección de SQL
            $sql = "UPDATE categorias SET Nombre_Cat = ?, Descripcion = ? WHERE id_categoria = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $nombreCategoria, $descripcion, $id_categoria);
            if ($stmt->execute()) {
                header("Location: categorias.php");
                exit;
            } else {
                echo "Error al actualizar la categoría: " . $conn->error;
            }
        }
    } else {
        echo "Categoría no encontrada.";
    }
} else {
    echo "ID de categoría no válido.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="../cssPanel/categoria1.css">
</head>
<body>
    <br><br><br><br><br><br><br><br>
    <div class="container">
        <h1>Editar Categoría</h1>
        <a href="categorias.php">Volver a la Lista de Categorías</a>
        <?php if (isset($row)) { ?>
        <form method="post" action="">
            <label for="nombreCategoria">Nombre:</label>
            <input type="text" name="nombreCategoria" value="<?php echo htmlspecialchars($row['Nombre_Cat']); ?>" required>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required><?php echo htmlspecialchars($row['Descripcion']); ?></textarea>
            <input type="submit" value="Guardar Cambios">
        </form>
        <?php } ?>
    </div>
</body>
</html>
