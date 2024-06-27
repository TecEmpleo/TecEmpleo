<?php
include 'conexion.php';

$descripcionErr = "";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_categorias = "SELECT * FROM categorias";
$result_categorias = $conn->query($sql_categorias);

$sql_empresas = "SELECT * FROM empresa";
$result_empresas = $conn->query($sql_empresas);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crear"])) {
        $descripcion = test_input($_POST["descripcion"]);
        $categoria_id = test_input($_POST["categoria_id"]);
        $empresa_id = test_input($_POST["empresa_id"]);
        $fecha_cierre = test_input($_POST["fecha_cierre"]); 

        $fecha_publicacion = date("Y-m-d");
        $estado = "activo";

        if (empty($descripcion)) {
            $descripcionErr = "La descripción es requerida";
        }

        if (empty($descripcionErr)) {
            $descripcion = mysqli_real_escape_string($conn, $descripcion);
            $categoria_id = mysqli_real_escape_string($conn, $categoria_id);
            $empresa_id = mysqli_real_escape_string($conn, $empresa_id);
            $fecha_cierre = mysqli_real_escape_string($conn, $fecha_cierre);

            $sql = "INSERT INTO vacantes (Categoria_idCategoria, Empresa_id_empresa, Descripcion_vac, Fecha_Publicacion, Fecha_Cierre, Estado) 
                    VALUES ('$categoria_id', '$empresa_id', '$descripcion', '$fecha_publicacion', '$fecha_cierre', '$estado')";
            if ($conn->query($sql) === TRUE) {
                header("Location: vacante.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Vacantes Administración</title>
    <link rel="stylesheet" href="../cssRecursos_Humanos/vacante.css">
    <link rel="shortcut icon" href="../imgPanel/emp.png">
    <link rel="shortcut icon" href="../imgPanel/favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../cssRecursos_Humanos/CssRRHH.css">
    <link rel="icon" href="../IMGRecursosHumanos/Logo.png">
    <script>
        $(document).ready(function(){
            $('#agregarVacanteModal').on('show.bs.modal', function (e) {
                $('#descripcionError').text('');
            });
        });
    </script>
</head>
<body>
<div class="menu-btn" onclick="toggleNav()" id="menuBtn">&#9776;</div>
<div id="myMenu" class="menu">
<div class="search-container">
</div>
<center>
    <a href="javascript:void(0)" class="close-btn" onclick="toggleNav()">&times;</a>
    <br>
    <a href="../PanelRRHH.php"><i class="ri-home-6-line"></i>inicio</a>
    <a href="../empresa/empresa.php"><i class="ri-loop-left-fill"></i>Empresa</a>
    <a href="../categoria/categorias.php"><i class="ri-account-pin-box-fill"></i>Categoria</a>

    <br>
    <br>
    <a href="../salarios.php"><i class="ri-currency-line"></i>Salarios</a>
    <a href=""><i class="ri-notification-fill"></i></i>Notificaciones</a>
    <br>
    <li>
    <a href="../inicio/cerrar_sesion.php"><i class="ri-logout-box-line" style="color: #ffffff;"></i>Cerrar Sesión</a>
    </li>
</div>
    <br>
    <div class="container">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#agregarVacanteModal">
            Crear Vacante
        </button>

        <center><h1>Lista de Vacantes</h1></center>
        <br>  
        <form method="get" action="">
            <table>
            <tr>
            <td>
                <div class="form-group">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre de vacante">
                </div>
            </td>
             <td>

               <button type="submit" class="btn btn-primary mb-3">
                Buscar
               </button>
               
               <input type="hidden" name="search" value="1"> 
               
               <button type="button" class="btn btn-primary mb-3" onclick="window.history.back();">
                Volver
               </button>
            </td>
            </tr>
        </form>
        </table>
        <br>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Categoría</th>
                <th>Empresa</th>
                <th>Descripción</th>
                <th>Fecha Publicación</th>
                <th>Fecha Cierre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php
            $sql_vacantes = "SELECT * FROM vacantes";
            $result_vacantes = $conn->query($sql_vacantes);
            if ($result_vacantes->num_rows > 0) {
                while ($row = $result_vacantes->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idVacantes"] . "</td>";
                    echo "<td>" . $row["Categoria_idCategoria"] . "</td>";
                    echo "<td>" . $row["Empresa_id_empresa"] . "</td>";
                    echo "<td>" . $row["Descripcion_vac"] . "</td>";
                    echo "<td>" . $row["Fecha_Publicacion"] . "</td>";
                    echo "<td>" . $row["Fecha_Cierre"] . "</td>";
                    echo "<td>" . $row["Estado"] . "</td>";
                    echo "<td><a href='editarc.php?id=" . $row["idVacantes"] . "'>Editar</a> | 
                          <a href='eliminarc.php?id=" . $row["idVacantes"] . "'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No se encontraron vacantes.</td></tr>";
            }
            ?>
        </table>
    </div>
    <div class="modal fade" id="agregarVacanteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Vacante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="crearVacanteForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="categoria_id">Categoría:</label>
                            <select name="categoria_id" class="form-control" required>
                                <option value="">Selecciona una categoría</option>
                                <?php
                                if ($result_categorias->num_rows > 0) {
                                    while ($row_categoria = $result_categorias->fetch_assoc()) {
                                        echo "<option value='" . $row_categoria["id_categoria"] . "'>" . $row_categoria["Nombre_Cat"] . "</option>";
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
                                        echo "<option value='" . $row_empresa["id_empresa"] . "'>" . $row_empresa["Nombre_emp"] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No hay empresas disponibles</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" class="form-control" required></textarea>
                            <span class="error"><?php echo $descripcionErr;?></span>
                        </div>
                        <div class="form-group">
                            <label for="fecha_cierre">Fecha de Cierre:</label>
                            <input type="date" name="fecha_cierre" class="form-control" required>
                        </div>
                        <button type="submit" name="crear" class="btn btn-primary btn-crear">Crear Vacante</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../JavascriptRRHH/menu.js"></script>

<script src="../JavascriptRRHH/vacante.js"></script>

</body>
</html>

<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
