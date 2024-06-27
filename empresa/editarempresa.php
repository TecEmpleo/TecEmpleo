<?php
include 'conexionempresa.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idEmpresa = $_GET['id'];
    
    // Utilizar sentencias preparadas para evitar la inyección de SQL
    $sql = "SELECT * FROM empresa WHERE id_empresa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idEmpresa);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validar y limpiar los datos recibidos
            $ciudad = htmlspecialchars($_POST["ciudad"]);
            $direccion = htmlspecialchars($_POST["direccion"]);
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            $telefono = htmlspecialchars($_POST["telefono"]);
            $nombreEmpresa = htmlspecialchars($_POST["nombreEmpresa"]);
            
            // Utilizar sentencias preparadas para evitar la inyección de SQL
            $sql = "UPDATE empresa SET Ciudad_emp = ?, Direccion_emp = ?, Email_emp = ?, Telefono_emp = ?, Nombre_emp = ? WHERE id_empresa = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $ciudad, $direccion, $email, $telefono, $nombreEmpresa, $idEmpresa);
            if ($stmt->execute()) {
                header("Location: empresa.php");
                exit;
            } else {
                echo "Error al actualizar la empresa: " . $conn->error;
            }
        }
    } else {
        echo "Empresa no encontrada.";
    }
} else {
    echo "ID de empresa no válido.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Empresa</title>
    <link rel="stylesheet" href="../cssPanel/empresa.css">
</head>
<body>
    <br><br><br><br><br><br><br><br>
    <div class="container">
        <h1>Editar Empresa</h1>
        <a href="empresa.php">Volver a la Lista de Empresas</a>
        <?php if (isset($row)) { ?>
        <form method="post" action="">
            <label for="ciudad">Ciudad:</label>
            <input type="text" name="ciudad" value="<?php echo htmlspecialchars($row['Ciudad_emp']); ?>" required>
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" value="<?php echo htmlspecialchars($row['Direccion_emp']); ?>" required>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($row['Email_emp']); ?>" required>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" value="<?php echo htmlspecialchars($row['Telefono_emp']); ?>" required>
            <label for="nombreEmpresa">Nombre de la Empresa:</label>
            <input type="text" name="nombreEmpresa" value="<?php echo htmlspecialchars($row['Nombre_emp']); ?>" required>
            <input type="submit" value="Guardar Cambios">
        </form>
        <?php } ?>
    </div>
</body>
</html>
