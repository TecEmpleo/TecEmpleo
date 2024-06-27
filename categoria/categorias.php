<?php
include 'conexion.php';

$nombreCategoriaErr = "";
$descripcionErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crear"])) {
        $nombreCategoria = test_input($_POST["nombreCategoria"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$nombreCategoria)) {
            $nombreCategoriaErr = "Solo se permiten letras y espacios en blanco";
        }

        $descripcion = test_input($_POST["descripcion"]);
        
        if (empty($nombreCategoriaErr) && empty($descripcionErr)) {
            $sql = "INSERT INTO categorias (Nombre_Cat, Descripcion) VALUES ('$nombreCategoria', '$descripcion')";
            if ($conn->query($sql) === TRUE) {
                header("Location: categorias.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$sql = "SELECT * FROM categorias"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categorías Administración</title>
    <link rel="stylesheet" href="../cssPanel/categoria1.css">
    <link rel="shortcut icon" href="emp.png">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../cssPanel/panel.css">
    <script>
        $(document).ready(function(){
            $('#agregarCategoriaModal').on('show.bs.modal', function (e) {
                $('#nombreCategoriaError').text('');
            });
        });
    </script>
</head>
<body>
<div class="menu-btn" onclick="toggleNav()">&#9776;</div>
<div id="myMenu" class="menu">
<div class="search-container">
    <form id="searchForm">
        <i class="ri-search-line"></i>
        <input type="text" id="searchInput" placeholder="Buscar...">
        <button type="button" onclick="searchFolders()">Buscar</button>
    </form>
</div>
<center>
    <a href="javascript:void(0)" class="close-btn" onclick="toggleNav()">&times;</a>
    <a href="../Administrador.php"><i class="ri-home-2-fill"></i>TecEmpleo</a>
</div>
    <br><br>
    <div class="container">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#agregarCategoriaModal">
            Crear Categoría
        </button>

        <center><h1>Lista de Categorías</h1></center>
        <br>  
        <form method="get" action="">
            <table>
            <tr>
            <td>
                <div class="form-group">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre de categoria">
                </div>
            </td>
             <td>

               <button type="submit" class="btn btn-primary mb-3">
                Buscar
               </button>
               
               <input type="hidden" name="search" value="1"> <!-- Campo oculto para indicar que se está realizando una búsqueda -->
               
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
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_categoria"] . "</td>";
                    echo "<td>" . $row["Nombre_Cat"] . "</td>";
                    echo "<td>" . $row["Descripcion"] . "</td>";
                    echo "<td><a href='editar.php?id=" . $row["id_categoria"] . "'>Editar</a> | 
                          <a href='eliminar.php?id=" . $row["id_categoria"] . "'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron categorías.</td></tr>";
            }
            ?>
        </table>
    </div>

    <div class="modal fade" id="agregarCategoriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="crearCategoriaForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="nombreCategoria">Nombre:</label>
                            <input type="text" name="nombreCategoria" class="form-control" required>
                            <span id="nombreCategoriaError" class="error"><?php echo $nombreCategoriaErr;?></span>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" class="form-control" required></textarea>
                            <span class="error"><?php echo $descripcionErr;?></span>
                        </div>
                        <button type="submit" name="crear" class="btn btn-primary btn-crear">Crear Categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="../javascript/menu.js"></script>
<script src="../javascript/categoria.js"></script>
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
