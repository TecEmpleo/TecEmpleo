<?php
include 'conexion.php';

$descripcionErr = "";
$insertionError = "";

// Verificar la conexión a la base de datos
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener las categorías y empresas para mostrar en el formulario
$sql_categorias = "SELECT * FROM categorias";
$result_categorias = $conn->query($sql_categorias);

$sql_empresas = "SELECT * FROM empresa";
$result_empresas = $conn->query($sql_empresas);

// Verificar si se ha proporcionado un ID válido en la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idVacante = $_GET['id']; // Obtener el ID de la vacante a editar

    // Debug: Verificar si se está capturando correctamente el ID de la vacante desde la URL
    echo "ID de vacante capturado desde la URL: " . $idVacante . "<br>";

    // Obtener los detalles de la vacante a editar
    $sql_vacante = "SELECT * FROM vacantes WHERE idVacantes = $idVacante";
    $result_vacante = $conn->query($sql_vacante);

    if ($result_vacante && $result_vacante->num_rows > 0) {
        $row_vacante = $result_vacante->fetch_assoc();
    } else {
        echo "No se encontró la vacante a editar.";
        exit();
    }
} else {
    echo "ID de vacante no proporcionado.";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Vacante</title>
    <link rel="stylesheet" href="../cssPanel/vacante.css">
    <link rel="shortcut icon" href="emp.png">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../panel.css">
</head>
<body>
    <div class="container">
        <h1>Editar Vacante</h1>
        <form id="editarVacanteForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="idVacante" value="<?php echo $idVacante; ?>">
            <div class="form-group">
                <label for="categoria_id">Categoría:</label>
                <select name="categoria_id" class="form-control" required>
                    <option value="">Selecciona una categoría</option>
                    <?php
                    if ($result_categorias->num_rows > 0) {
                        while ($row_categoria = $result_categorias->fetch_assoc()) {
                            $selected = ($row_categoria["id_categoria"] == $row_vacante["Categoria_idCategoria"]) ? "selected" : "";
                            echo "<option value='" . $row_categoria["id_categoria"] . "' $selected>" . $row_categoria["Nombre_Cat"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay categorías disponibles</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="empresa_id">Empresa:</label>
                <select name="empresa_id" class="form-control" required>
                    <option value="">Selecciona una empresa</option>
                    <?php
                    if ($result_empresas->num_rows > 0) {
                        while ($row_empresa = $result_empresas->fetch_assoc()) {
                            $selected = ($row_empresa["id_empresa"] == $row_vacante["Empresa_id_empresa"]) ? "selected" : "";
                            echo "<option value='" . $row_empresa["id_empresa"] . "' $selected>" . $row_empresa["Nombre_emp"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay empresas disponibles</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" class="form-control" required><?php echo $row_vacante["Descripcion_vac"]; ?></textarea>
                <span class="error"><?php echo $descripcionErr;?></span>
            </div>
            <div class="form-group">
                <label for="fecha_cierre">Fecha de Cierre:</label>
                <input type="date" name="fecha_cierre" class="form-control" value="<?php echo $row_vacante["Fecha_Cierre"]; ?>" required>
            </div>
            <button type="submit" name="editar" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar"])) {
    $descripcion = test_input($_POST["descripcion"]);
    $categoria_id = test_input($_POST["categoria_id"]);
    $empresa_id = test_input($_POST["empresa_id"]);
    $fecha_cierre = test_input($_POST["fecha_cierre"]); // Validar campo de fecha de cierre

    // Debug: Verificar si se está capturando correctamente el ID de la vacante desde el formulario
    echo "ID de vacante capturado desde el formulario: " . $_POST["idVacante"] . "<br>";

    // Validar el campo de descripción
    if (empty($descripcion)) {
        $descripcionErr = "La descripción es requerida";
    }

    if (empty($descripcionErr)) {
        // Sanitizar datos antes de insertar en la base de datos
        $descripcion = mysqli_real_escape_string($conn, $descripcion);
        $categoria_id = mysqli_real_escape_string($conn, $categoria_id);
        $empresa_id = mysqli_real_escape_string($conn, $empresa_id);
        $fecha_cierre = mysqli_real_escape_string($conn, $fecha_cierre);

        // Actualizar vacante en la base de datos
        $sql = "UPDATE vacantes SET Categoria_idCategoria='$categoria_id', Empresa_id_empresa='$empresa_id', Descripcion_vac='$descripcion', Fecha_Cierre='$fecha_cierre' WHERE idVacantes='$idVacante'";
        if ($conn->query($sql) === TRUE) {
            // Redirigir o mostrar un mensaje de éxito después de la actualización
            header("Location: vacante.php");
            exit();
        } else {
            $insertionError = "Error al actualizar los datos: " . $conn->error;
        }
    }
}

// Función para limpiar los datos de entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
